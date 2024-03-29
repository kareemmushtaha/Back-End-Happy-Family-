<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Jobs\RegesterEmailJob;
use App\Models\Conversations;
use Illuminate\Support\Str;
use App\Models\AnswerQuestion;
use App\Models\Aria;
use App\Models\City;
use App\Models\Country;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersMediatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users'] = User::query()->where('mediator_id', auth()->user()->id)->get();

        return view('mediator.users.index', $data);
    }

    public function create()
    {
        $data['countries'] = Country::query()->get();
        $data['questions'] = Question::query()->Active()->get();
        return view('mediator.users.create', $data);
    }

    public function filterAreas(Request $request)
    {
        $areas = Aria::query()->where('country_id', $request->country_id)->get();

        return response()->json([
            'status' => true,
            'areas' => $areas,
        ]);
    }

    public function filterCities(Request $request)
    {
        $cities = City::query()->where('aria_id', $request->area_id)->get();
        return response()->json([
            'status' => true,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' => 'nullable|image',
            'user_gender' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'fake_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'nationality' => 'required',
            'phone' => 'required|string|max:12',
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8'],
            'country_id' => 'required|exists:countries,id',
            'aria_id' => 'required|exists:arias,id',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'answers' => 'required|array',
            'show_profile' => 'required',
        ]);

        if (in_array('null', $request->answers)) {
            return response()->json(['status' => false, 'msg' => trans('global.some_question_no_answered')]);
        }

        DB::beginTransaction();
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }

        $generate_email = Str::random(5) . '-osra-saeeda@gmail.com';

        $user = User::create([
            'mediator_id' => auth()->user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fake_name' => $request->fake_name,
//            'email' => $request->email,
            'email' => $generate_email,
//            'password' => Hash::make($request->password),
            'password' => Hash::make($generate_email),
            'role_id' => 4,
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
            'show_profile' => $request->show_profile,
            'photo' => $file,
            'check_active' => 1,
        ]);

        foreach ($request->answers as $answer) {
            $answerQuestion = AnswerQuestion::query()->find($answer);
            $check_user_answered_question = UserQuestionAnswer::query()->where('user_id', $user->id)->where('question_id', $answerQuestion['question_id'])->first();
            if (!$check_user_answered_question) {
                UserQuestionAnswer::query()->create([
                    'user_id' => $user->id,
                    'question_id' => $answerQuestion['question_id'],
                    'answer_question_id' => $answerQuestion['id'],
                ]);
            }
        }

        DB::commit();
        dispatch(new RegesterEmailJob($user));
        toastr()->success(trans('global.register'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.register')]);
    }

    public function edit($userId)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::query()->findOrFail($userId);
        $data['countries'] = Country::query()->get();
        $data['arias'] = Aria::query()->where('country_id', $user->country_id)->get();
        $data['cities'] = City::query()->where('aria_id', $user->aria_id)->get();
        $data['questions'] = Question::query()->Active()->get();
        return view('mediator.users.edit', compact('user'), $data);

    }

    public function update(Request $request, $userId)
    {
        $this->validate($request, [
            'user_gender' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'fake_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'nationality' => 'required',
            'phone' => 'required|string|max:12',
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
//            'password' => ['nullable', 'string', 'min:8'],
            'country_id' => 'required|exists:countries,id',
            'aria_id' => 'required|exists:arias,id',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'answers' => 'required|array',
            'show_profile' => 'required',
        ]);
        if (in_array('null', $request->answers)) {
            return response()->json(['status' => false, 'msg' => trans('global.some_question_no_answered')]);
        }
        $user = User::query()->findOrFail($userId);

        DB::beginTransaction();
        foreach ($request->answers as $answer) {
            $answerQuestion = AnswerQuestion::query()->find($answer);
            $check_user_answered_question = UserQuestionAnswer::query()->where('user_id', $user->id)->where('question_id', $answerQuestion['question_id'])->first();
            if ($check_user_answered_question) {

                $check_user_answered_question->update([
                    'user_id' => $user->id,
                    'question_id' => $answerQuestion['question_id'],
                    'answer_question_id' => $answerQuestion['id'],
                ]);
            } else {
                UserQuestionAnswer::query()->create([
                    'user_id' => $user->id,
                    'question_id' => $answerQuestion['question_id'],
                    'answer_question_id' => $answerQuestion['id'],
                ]);
            }
        }

        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'fake_name' => $request->fake_name,
//            'email' => $request->email,
            'role_id' => 4,
            'birth_date' => $request->birth_date,
            'year' => Carbon::parse($request->birth_date)->format('Y'),
            'gender' => $request->user_gender,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
            'swear_god' => 1,
            'code' => '1234',
            'country_id' => $request->country_id,
            'show_profile' => $request->show_profile,
            'aria_id' => $request->aria_id,
            'city_id' => $request->city_id,
            'height' => $request->height,
            'width' => $request->width,
            'photo' => $file,
        ]);

        DB::commit();

        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($userId)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::query()->findOrFail($userId);
        return view('mediator.users.show', compact('user'));
    }

    public function destroy($userId)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::query()->findOrFail($userId);
        if (!$user) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            $user->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }

    public function notifications($userId)
    {
        $user = User::query()->findOrFail($userId);
        $questionsNotAnswer = Conversations::query()->where('received_id', $user->id)->whereNull('answer_chat_id')->get();
        return view('mediator.users.notification',compact('questionsNotAnswer','user'));
    }


}
