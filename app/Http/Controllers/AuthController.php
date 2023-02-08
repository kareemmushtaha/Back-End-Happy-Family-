<?php

namespace App\Http\Controllers;

use App\Jobs\RegesterEmailJob;
use App\Models\User;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login_page()
    {
        return view('site.login');
    }

    public function register_page()
    {
        return view('site.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->verified == 0 || Auth::user()->check_active == 0) {
                return response()->json(['status' => 422, 'msg' => 'You should verify your account first, please check your email']);
            }
            if (Auth::user()->getType() == 'mediator') {
                return response()->json(['status' => true, "redirect_url" => route('home')]);
            } elseif (Auth::user()->getType() == 'user') {
                return response()->json(['status' => true, "redirect_url" => route('home')]);
            } elseif (Auth::user()->getType() == 'FollowMediator') {
                return response()->json(['status' => true, "redirect_url" => route('home')]);
            } elseif (Auth::user()->getType() == 'admin') {
                return response()->json(['status' => true, "redirect_url" => route('admin.home')]);
            }

        } else {
            return response()->json(['status' => false, 'msg' => 'The provided credentials do not match our records.', 'redirect_url' => url('/')]);
        }
    }

    public function register(Request $request)
    {

        if ($request->user_role == "2") {
            //mediator
            return $this->registermediator($request);
        } else {
            //user
            return $this->registerUser($request);
        }
    }

    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'user_role' => 'required|in:2,3',
            'user_gender' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'fake_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'nationality' => 'required',
            'phone' => 'required|string|max:12',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'country_id' => 'required|exists:countries,id',
            'aria_id' => 'required|exists:arias,id',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fake_name' => $request->fake_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3,
            'birth_date' => $request->birth_date,
            'year' => Carbon::parse($request->birth_date)->format('Y'),
            'gender' => $request->user_gender,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'aria_id' => $request->aria_id,
            'city_id' => $request->city_id,
            'height' => $request->height,
            'width' => $request->width,
            'swear_god' => 1,
            'code' => '1234',
            'status' => 1,
        ]);

//        dispatch(new RegesterEmailJob($user));
        Notification::send($user, new VerifyUserNotification($user));

        toastr()->success(trans('global.register'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.register')]);
    }

    public function registermediator(Request $request)
    {
        $this->validate($request, [
            'user_role' => 'required|in:2,3',
            'user_gender' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'fake_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'nationality' => 'required',
            'phone' => 'required|string|max:12',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'country_id' => 'required|exists:countries,id',
            'aria_id' => 'required|exists:arias,id',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fake_name' => $request->fake_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'birth_date' => $request->birth_date,
            'year' => Carbon::parse($request->birth_date)->format('Y'),
            'gender' => $request->user_gender,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'swear_god' => 1,
            'code' => '1234',
            'country_id' => $request->country_id,
            'aria_id' => $request->aria_id,
            'city_id' => $request->city_id,
            'height' => $request->height,
            'width' => $request->width,
            'status' => 0,
        ]);
//        dispatch(new RegesterEmailJob($user));
        Notification::send($user, new VerifyUserNotification($user));

        toastr()->success(trans('global.register'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.register')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}
