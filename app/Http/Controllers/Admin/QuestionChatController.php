<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionChatRequest;
use App\Models\QuestionChat;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionChatController extends Controller
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
        $data['questions'] = QuestionChat::query()->whereNull('custom_user_id')->get();
        return view('admin.question-chat.index', $data);
    }

    public function customQuestionChat()
    {
        $data['questions'] = QuestionChat::query()->whereNotNull('custom_user_id')->get();
        return view('admin.questions-answers-request.questions-request', $data);
    }


    public function store(QuestionChatRequest $request)
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        QuestionChat::query()->create([
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
        $questionChat = QuestionChat::query()->findOrFail($questionChatId);
        return view('admin.question-chat.edit', compact('questionChat'));

    }

    public function update(QuestionChatRequest $request, $questionChatId)
    {

        $questionChat = QuestionChat::query()->findOrFail($questionChatId);

        $data = [
            'ar' => [
                'question_title' => $request->question_title_ar,
            ],
            'status' => $request->status,
        ];
        $questionChat->update($data);

        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($questionChatId)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questionChat = QuestionChat::query()->findOrFail($questionChatId);
        return view('admin.question-chat.show', compact('questionChat'));
    }

    public function destroy($questionChatId)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $QuestionChat = QuestionChat::find($questionChatId);
        if (!$QuestionChat) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            $QuestionChat->translations()->delete();
            $QuestionChat->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }


    public function acceptRequestQuestionChat(Request $request)
    {
        try {
            $question = QuestionChat::query()->find($request->id);
            if (!$question) {
                return response()->json(['status' => false, 'msg' => trans('global.data_not_found')]);
            }
             $question->update(['status' => 1]);
            return response()->json(['status' => true, 'active' => $question->getAcceptOrReject(), 'id' => $question->id, 'msg' => trans('global.update_success')]);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_some_error')]);

        }
    }

    public function rejectRequestQuestionChat(Request $request)
    {
        try {
            $question = QuestionChat::query()->find($request->id);
            if (!$question) {
                return response()->json(['status' => false, 'msg' => trans('global.data_not_found')]);
            }
            $question->update(['status' => 2]);
            return response()->json(['status' => true, 'active' => $question->getAcceptOrReject(), 'id' => $question->id, 'msg' => trans('global.update_success')]);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_some_error')]);

        }
    }

}
