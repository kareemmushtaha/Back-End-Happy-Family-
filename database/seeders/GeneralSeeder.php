<?php

namespace Database\Seeders;

use App\Models\Aria;
use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    // php artisan db:seed --class=GeneralSeeder

    public function run()
    {
        $country_info =
            [
                'ar' => [
                    'title' => "السعودية",
                ],
                'status' => 1,
            ];
        Country::query()->create($country_info);

        $country_info =
            [
                'ar' => [
                    'title' => "فلسطين",
                ],
                'status' => 1,
            ];
        $country = Country::query()->create($country_info);

        $aria_info =
            [
                'ar' => [
                    'title' => "منطقة جديدة",
                ],
                'country_id' => $country->id,
                'status' => 1,
            ];
        $aria = Aria::query()->create($aria_info);

        $city_info =
            [
                'ar' => [
                    'title' => "مدينة الرياض",
                ],
                'aria_id' => $aria->id,
                'status' => 1,
            ];
        City::query()->create($city_info);

        $package =
            [
                'ar' => [
                    'title' => " الذهبية",
                    'description' => "تفاصيل الباقة التي تمكنك من التعرف على شريك حياتك",
                    'subscription_features' => "<ul>
                    <li>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</li>
                    <li>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</li>
                </ul>",
                ],
                'status' => 1,
                'price' => 120,
            ];
        Package::query()->create($package);

    }
}
