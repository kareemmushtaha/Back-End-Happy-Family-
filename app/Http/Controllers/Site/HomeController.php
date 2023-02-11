<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Fqa;
use App\Models\Package;
use App\Models\SuccessStory;
use App\Models\User;
use App\Models\UserPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use function Webmozart\Assert\Tests\StaticAnalysis\null;
use function Webmozart\Assert\Tests\StaticAnalysis\true;


class HomeController extends Controller
{

    public $users_paginate;

    public function __construct(User $users_paginate)
    {
        $this->users_paginate = $users_paginate;
    }

    public function home(Request $request)
    {
        if (auth()->check()) {
            $user = User::query()->where('id', "!=", auth()->user()->id)->where('show_profile', 1)->whereIn('role_id', [2, 3, 4]);
            if (auth()->user()->getType() != 'mediator') {
                $gender = auth()->user()->gender == 'male' ? 'female' : 'male';
                $user->where('gender', $gender);
            }
            $user = $user->latest()->take(10)->paginate(6);
            $data['get_users'] = $user;
        } else {
            $data['get_users'] = User::query()->where('show_profile', 1)->whereIn('role_id', [2, 3,4])->latest()->take(10)->paginate(6);
        }

        $data['countries'] = Country::query()->get();
        $data['cities'] = City::query()->get();
        $data['users'] = \App\Http\Resources\ShowUserResource::collection($data['get_users']);

        if ($request->ajax()) {
            return view('site._userCardPaginate', $data);
        }
        return view('site.home', $data);


    }

    public function homeSearch(Request $request)
    {
        $gender = $request->gender;
        $country = $request->country;
        $area = $request->area;
        $city = $request->city;
        $from = $request->from;
        $to = $request->to;
//
        if ($request->gender) {
            $gender = $request->gender;
        } else {
            $gender = null;
        }


        if ($request->country) {
            $country = $request->country;
        } else {
            $country = null;
        }

        if ($request->area) {
            $area = $request->area;
        } else {
            $area = null;
        }

        if ($request->city) {
            $city = $request->city;
        } else {
            $city = null;
        }

        if ($request->from) {
            $from = $request->from;
        } else {
            $from = null;
        }

        if ($request->to) {
            $to = $request->to;
        } else {
            $to = null;
        }
        $data['get_users'] = User::query()->where('show_profile', 1);
        if (auth()->check()) {
            $data['get_users']->where('id', '!=', auth()->user()->id);
        }
        $data['get_users'] = $data['get_users']->when($gender != null, function ($query_1) use ($gender) {
            $query_1->where('gender', $gender);

        })->when($country != null, function ($query_2) use ($country) {
            $query_2->where('country_id', $country);

        })->when($area != null, function ($query_3) use ($area) {
            $query_3->where('aria_id', $area);

        })->when($city != null, function ($query_4) use ($city) {
            $query_4->where('city_id', $city);

        })->when($from != null && $to != null, function ($query_5) use ($from, $to) {

            $query_5->whereBetween('year', [$from, $to]);

        })->paginate(6);

        $data['users'] = \App\Http\Resources\ShowUserResource::collection($data['get_users']);

        if ($request->ajax()) {
            return view('site._userCardPaginate', $data);

        }
    }

    public function landing()
    {
        $data['success_stories'] = SuccessStory::query()->get();
        $data['package'] = Package::query()->first();
        $data['fqas'] = Fqa::query()->get();
        $data['countries'] = Country::query()->get();

        return view('site.landing', $data);
    }

    public function resultSearchLanding(Request $request)
    {
        $gender = $request->gender;
        $country = $request->country;
        $area = $request->area;
        $city = $request->city;
        $year_from = $request->year_from;
        $year_to = $request->year_to;

//

        if ($request->gender) {
            $gender = $request->gender;
        } else {
            $gender = null;
        }

        if ($request->country) {
            $country = $request->country;
        } else {
            $country = null;
        }

        if ($request->area) {
            $area = $request->area;
        } else {
            $area = null;
        }


        if ($request->city) {
            $city = $request->city;
        } else {
            $city = null;
        }

        if ($request->year_from) {
            $year_from = $request->year_from;
        } else {
            $year_from = null;
        }

        if ($request->year_to) {
            $year_to = $request->year_to;
        } else {
            $year_to = null;
        }

        $data['gender'] = $request->gender;
        $data['country'] = $request->country;
        $data['area'] = $request->area;
        $data['city'] = $request->city;
        $data['year_from'] = $request->year_from;
        $data['year_to'] = $request->year_to;

        $data['get_users'] = $this->users_paginate->query()->where('show_profile', 1)->when($gender != null, function ($query_1) use ($gender) {
            $query_1->where('gender', $gender);

        })->when($country != null, function ($query_1) use ($country) {
            $query_1->where('country_id', $country);

        })->when($area != null, function ($query_2) use ($area) {

            $query_2->where('aria_id', $area);

        })->when($city != null, function ($query_3) use ($city) {

            $query_3->where('city_id', $city);

        })->when($year_from != null && $year_to != null, function ($query_6) use ($year_from, $year_to) {
            $query_6->whereBetween('year', [$year_from, $year_to]);

        })->paginate(6);

        $data['users'] = \App\Http\Resources\ShowUserResource::collection($data['get_users']);

        if ($request->ajax()) {
            return view('site._resultAdvanceSearchPaginate', $data);
        } else {
            return view('site.result-search-landing', $data);

        }
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function questions_answer()
    {
        $data['fqas'] = Fqa::query()->get();
        return view('site.questions-answer', $data);
    }

    public function package_details($package_id)
    {
        //find $package_id
        if (auth()->check()) {
            $data['package'] = Package::query()->findOrFail($package_id);
            return view('site.package-details', $data);
        } else {
            return redirect()->route('login');
        }
    }


    public function sendContactUs(ContactUsRequest $request)
    {
        ContactUs::query()->create([
            'email' => $request->email,
            'title' => $request->title,
            'content_msg' => $request->content_msg,
        ]);
        toastr()->success(trans('تم الارسال بنجاح'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => false, 'msg' => 'send message successfully', 'redirect_url' => url('contact')]);
    }

    public function sendContactUsLanding(ContactUsRequest $request)
    {
        ContactUs::query()->create([
            'email' => $request->email,
            'title' => $request->title,
            'content_msg' => $request->content_msg,
        ]);
        toastr()->success(trans('تم الارسال بنجاح'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => false, 'msg' => 'send message successfully', 'redirect_url' => url('landing')]);
    }

    public function store(StoreUserRequest $request)
    {


    }

    public function edit()
    {

    }

    public function subscription($package_id)
    {
        //this function test for developer
        if (auth()->check()) {
            //check user  have package activate
            if (checkUserHaveSubscription(auth()->user()->id)) {
                toastr()->success(trans('global.sorry_you_have_package_activated'), ['timeOut' => 20000, 'closeButton' => true]);
                return response()->json(['status' => false, 'msg' => trans('global.sorry_you_have_package_activated')]);
            } else {
                $package = Package::query()->findOrFail($package_id);
                UserPackage::query()->create([
                    'package_id' => $package->id,
                    'user_id' => auth()->user()->id,
                    'price' => $package->price,
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addDays(30),
                    'status' => 1, //subscription is active
                ]);
                toastr()->success(trans('global.subscribed_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
                return response()->json(['status' => true, 'msg' => trans('global.subscribed_successfully')]);
            }
        } else {
            return redirect()->route('login');
        }
    }


}
