<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index ()
    {
        $messages = ContactUs::query()->get();
        return view('admin.contactUS.index', compact('messages'));
    }
}
