<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\AcceptInvitationNotification;
use App\Notifications\InviteNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    public function invite(Request $request , User $user)
    {
        dd($request->user());
        $user->notify(new InviteNotification());
    }

    public function accept(Request $request , User $user)
    {
        $user->notify(new AcceptInvitationNotification());
    }
}
