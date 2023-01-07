<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\ShowUserResource;
use App\Jobs\RegesterEmailJob;
use App\Models\AnswerQuestion;
use App\Models\Package;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use function Webmozart\Assert\Tests\StaticAnalysis\null;


class UserController extends Controller
{

    public function my_profile()
    {
        $data['user'] = auth()->user();
        $data['questions'] = Question::query()->Active()->get();
        return view('site.my-profile', $data);

    }

    public function personally($user_id)
    {
        $data['find_user'] = User::query()->find($user_id);
        $data['filter_user'] = ShowUserResource::make($data['find_user']);
        $data['user'] = collect($data['filter_user']);
        $data['questions'] = Question::query()->Active()->get();
        $data['package'] = Package::query()->first();

        if (\auth()->check()) {
            $data['users_follow_mediator'] = User::query()->where('mediator_id', \auth()->user()->id)->get();
        }

        return view('site.personally', $data);
    }

    public function update_answer_questions(Request $request)
    {
        $requests = $request->except('_token');

        if (in_array('null', $requests['answers'])) {
            return response()->json(['status' => false, 'msg' => trans('global.some_question_no_answered')]);
        }

        foreach ($requests['answers'] as $answer) {
            $answerQuestion = AnswerQuestion::query()->find($answer);
            $check_user_answered_question = UserQuestionAnswer::query()->where('user_id', auth()->user()->id)->where('question_id', $answerQuestion['question_id'])->first();
            if ($check_user_answered_question) {

                $check_user_answered_question->update([
                    'user_id' => auth()->user()->id,
                    'question_id' => $answerQuestion['question_id'],
                    'answer_question_id' => $answerQuestion['id'],
                ]);
            } else {
                UserQuestionAnswer::query()->create([
                    'user_id' => auth()->user()->id,
                    'question_id' => $answerQuestion['question_id'],
                    'answer_question_id' => $answerQuestion['id'],
                ]);
            }
        }
        toastr()->success(trans('global.update_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.register')]);
    }


    public function edit_profile(Request $request)
    {

        $user = auth()->user();
        return view('site.edit-profile', compact('user'));

    }

    public function update_profile(Request $request): \Illuminate\Http\JsonResponse
    {


        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'fake_name' => 'required|string|max:255',
            'birth_date' => 'required',
            'nationality' => 'required',
            'phone' => 'required|string|max:12',
            'country_id' => 'required|exists:countries,id',
            'aria_id' => 'required|exists:arias,id',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            $error = $validator->errors()->first();
            toastr()->error("$error", ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => true, 'msg' => trans('global.register')]);

        }


        $user = User::findOrFail(Auth::user()->id);
        $file = '';
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $user->photo = $file;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->fake_name = $request->fake_name;
        $user->birth_date = $request->birth_date;
        $user->year = Carbon::parse($request->birth_date)->format('Y');
        $user->nationality = $request->nationality;
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->aria_id = $request->aria_id;
        $user->city_id = $request->city_id;
        $user->height = $request->height;
        $user->width = $request->width;
        $user->save();

        toastr()->success(trans('global.update_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.register')]);
    }

}
























