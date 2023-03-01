<?php

namespace App\Services;


use App\Models\Package;
use App\Models\UserPackage;
use Carbon\Carbon;

class Subscription
{
    public static function CheckFreeSubscription($user)
    {
        $package = Package::query()->first();
        if (!checkUserHaveSubscription($user->id) && $package->price == 0) {
            UserPackage::query()->create([
                'package_id' => $package->id,
                'user_id' => $user->id,
                'price' => $package->price,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'status' => 1, //subscription is not active
                'is_free' => 1,
            ]);
        }
    }
}









