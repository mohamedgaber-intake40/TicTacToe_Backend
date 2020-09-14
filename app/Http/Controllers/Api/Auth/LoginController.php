<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            throw ValidationException::withMessages([
                'message'=>'The provided credentials are incorrect.'
            ]);
        }
        $user= Auth::user();

        if($token = $user->tokens()->where('name',$request->device_name)->first())
            $token->delete();

        $token = $user->createToken($request->device_name);

        return [
            'data'=> [
                'user' => new UserResource($user),
                'token' => new TokenResource($token)
            ]
        ];

    }
}
