<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class UserVerificationController extends Controller
{

    public function approve($token)
    {

        $user = User::query()->where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('message', trans('global.emailVerificationSuccess'));
        }

        $user->verified = 1;
        $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $user->verification_token = null;
        $user->save();
        return redirect()->route('login')->with('message', trans('global.emailVerificationSuccess'));

    }

}
