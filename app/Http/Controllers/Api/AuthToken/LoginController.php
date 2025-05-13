<?php

namespace App\Http\Controllers\Api\AuthToken;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'error' => 'The credentials do not match any of our record.',  
             ]);
        }
        if($user->email_verified_at === null ){
            return response()->json([
                'error' => 'Akun anda Belum Verifikasi, Silahkan Cek Email Anda untuk Verifikasi Akun Anda.',  
             ]);
        }
        return response()->json([
           'user' => $user,
           'message' => 'Logged in successfully.',
           'currentToken' => $user->createToken('yuktah_token')->plainTextToken,
        ]);
    }
}
