<?php

namespace App\Http\Controllers\Api\AuthToken;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

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
        $user->SendEmailVerificationNotification();
        return response()->json([
            'message' => 'Successfully Register',
            'user' => $dataArray, 
            '$email' => $user
         ]);
    }
}
