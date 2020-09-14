<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('email','password','name'));

        $token = $user->createToken($request->device_name);

        return [
            'data'=> [
                'user' => new UserResource($user),
                'token' => new TokenResource($token)
            ]
        ];
    }
}
