<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnswerChatRequest;
use App\Http\Requests\Admin\QuestionPersonalRequest;
use App\Models\AnswerChat;
use App\Models\Question;
use App\Models\UserQuestionAnswer;
use Illuminate\Http\Request;


class PersonalQuestionsController extends Controller
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
        $data['questions'] = Question::query()->get();
        return view('admin.personal-questions.index', $data);
    }


    public function store(QuestionPersonalRequest $request)
    {
        //abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Question::query()->create([
            'ar' => [
                'question_title' => $request->question_title_ar,
            ],
            'status' => $request->status,
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($questionChatId)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $question = Question::query()->findOrFail($questionChatId);
        return view('admin.personal-questions.edit', compact('question'));

    }

    public function update(QuestionPersonalRequest $request, $questionId)
    {

        $question = Question::query()->findOrFail($questionId);

        $data = [
            'ar' => [
                'question_title' => $request->question_title_ar,
            ],
            'status' => $request->status,
        ];
        $question->update($data);

        toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($question)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question = Question::query()->findOrFail($question);
        return view('admin.personal-questions.show', compact('question'));
    }

    public function destroy($questionId)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $question = Question::find($questionId);
        if (!$question) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            UserQuestionAnswer::query()->where('question_id', $questionId)->delete();
            $question->translations()->delete();
            $question->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }


}
