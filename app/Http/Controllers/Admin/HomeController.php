<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PHPUnit\Exception;

class HomeController
{
    public function index()
    {

        $user_verified_account = User::where('verified', 1)->get();
        $user_not_verified_account = User::where('verified', 0)->get();
        $Municipalities = User::get();
        return view('home', compact('Municipalities', 'user_verified_account', 'user_not_verified_account'));
    }

}
