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

    public function home(Request $request)
    {
        if (auth()->check()) {
            $gender = auth()->user()->gender == 'male' ? 'female' : 'male';
            $data['get_users'] = User::query()->where('id', "!=", auth()->user()->id)->whereIn('role_id', [2, 3])->where('gender', $gender)->latest()->take(10)->paginate(6);
        } else {
            $data['get_users'] = User::query()->whereIn('role_id', [2, 3])->latest()->take(10)->paginate(6);
        }

        $data['countries'] = Country::query()->get();
        $data['cities'] = City::query()->get();
        $data['users'] = \App\Http\Resources\ShowUserResource::collection($data['get_users']);

        if ($request->ajax()) {
            return view('site._userCardPaginate', $data);
        }
            return view('site.home', $data);


    }

    public function homeSearch (Request $request)
    {
        $gender = $request->gender;
        $country = $request->country;
        $area = $request->area;
        $city = $request->city;
        $from = $request->from;
        $to = $request->to;
//
        if ($request->gender){
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


        $data['get_users'] = User::query()
           ->when($gender != null, function ($query_1) use ($gender){
            $query_1->where('gender', $gender);

           })->when($country != null, function ($query_2) use ($country){
            $query_2->where('country_id', $country);

           })->when($area != null, function ($query_3) use ($area) {
                $query_3->where('aria_id', $area);

            })->when($city != null, function ($query_4) use ($city){
                $query_4->where('city_id',$city);

           })->when($from != null && $to != null, function ($query_5) use ($from, $to){

                $query_5->whereBetween('year', [$from,$to]);

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
        return view('site.landing', $data);
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
        //find $package_id
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
