<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $uuid = Uuid::uuid4();
            
        $dataArray = []; 
        $dataArray = $request->toArray();
        $dataArray['uuid'] = $uuid; 
        $user = User::create($dataArray);

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Successfully Register',
            'user' => $dataArray, 
         ]);
    }

    public function emailVerify($user_id, Request $request){
        if(!$request->hasValidSignature()){
            return response()->json([
                'message' => 'Invalod or Expired verification code.'
            ],400);
        }

        $user = User::findOrFail($user_id);

        if(!$user){
            return response()->json([
                'message' => 'User not found.'
            ],400);
        }

        if(!$user->hasVerifiedEmail()){
            $user->markEmailAsVerified();
            return response()->json([
                'message' => 'Email Address successfully verified',
                'user' => $user
            ],400);
        }

        return response()->json([
            'message' => 'Email address already verified.'
        ],400);

    }

    public function resendEmailVerificationMail(Request $request){
        $user_id = $request->input('user_id');

        $user = User::findOrFail($user_id);

        if(!$user){
            return response()->json([
                'message' => 'User not found.'
            ],400);
        }

        if($user->hasVerifiedEmail()){
            return response()->json([
                'message' => 'Email Already verified',
                'user' => $user
            ],400);
        }

        $user->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Email verification link sent to your email address'
        ],400);
    }

    public function forgotPassword(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status === Password::RESET_LINK_SENT 
        ? response()->json([
            'message' => trans($status),
        ])
        : response()-> json([
            'message' => trans($status)
        ],400);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function(User $user, string $password){
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET 
        ? response()->json([
            'message' => trans($status),
        ])
        : response()-> json([
            'message' => trans($status)
        ],400);
    }

}
