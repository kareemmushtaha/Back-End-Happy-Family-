<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ViewPersonalInformation;


class ViewPersonalInformationController extends Controller
{
    public function index()
    {
        $viewPersonalInformation = ViewPersonalInformation::query()->get();
        return view('admin.view-personal-information.index', compact('viewPersonalInformation'));
    }


    public function show(User $user)
    {

    }


}
