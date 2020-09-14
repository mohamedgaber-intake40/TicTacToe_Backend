<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\InviteNotification;
use App\User;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function invite(Request $request , User $user)
    {
        $user->notify(new InviteNotification());
    }
}
