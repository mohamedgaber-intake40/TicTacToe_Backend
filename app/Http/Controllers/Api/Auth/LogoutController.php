<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response([],204);
    }

    public function logoutAll()
    {
        Auth::user()->tokens()->delete();
        return response([],204);
    }
}
