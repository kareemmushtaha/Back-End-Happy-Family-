<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnswerChatRequest;
use App\Http\Requests\Admin\PersonalAnswerQuestionRequest;
use App\Http\Requests\Admin\QuestionPersonalRequest;
use App\Models\AnswerChat;
use App\Models\AnswerQuestion;
use App\Models\Question;
use App\Models\UserQuestionAnswer;
use Illuminate\Http\Request;


class PersonalAnswerQuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data['answers'] = AnswerQuestion::query()->where('question_id', $request->question_id)->get();
        $data['question_id'] = $request->question_id;
        return view('admin.personal-answer-question.index', $data);
    }


    public function store(PersonalAnswerQuestionRequest $request)
    {
        AnswerQuestion::query()->create([
            'ar' => [
                'answer_title' => $request->answer_title_ar,
            ],
            'question_id' => $request->question_id,
            'status' => $request->status,
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($answerQuestionId)
    {
        $answer = AnswerQuestion::query()->findOrFail($answerQuestionId);
        return view('admin.personal-answer-question.edit', compact('answer'));

    }

    public function update(PersonalAnswerQuestionRequest $request, $answerId)
    {
        $answerQuestion = AnswerQuestion::query()->findOrFail($answerId);
        $data = [
            'ar' => [
                'answer_title' => $request->answer_title_ar,
            ],
            'status' => $request->status,
        ];
        $answerQuestion->update($data);

        toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($question)
    {
        $answerQuestion = AnswerQuestion::query()->findOrFail($question);
        return view('admin.personal-answer-question.show', compact('answerQuestion'));
    }

    public function destroy($answerQuestionId)
    {
        $answerQuestion = AnswerQuestion::find($answerQuestionId);
        if (!$answerQuestion) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            UserQuestionAnswer::query()->where('answer_question_id', $answerQuestionId)->delete();
            $answerQuestion->translations()->delete();
            $answerQuestion->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }


}
