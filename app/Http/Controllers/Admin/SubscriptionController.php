<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserPackage;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index ()
    {
        $subscriptions = UserPackage::query()->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
