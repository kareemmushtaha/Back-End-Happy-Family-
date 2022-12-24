<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AnswerChatRequest;
use App\Models\AnswerChat;
use Illuminate\Http\Request;


class AnswerChatController extends Controller
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
        $data['answers'] = AnswerChat::query()->whereNull('custom_user_id')->get();
        return view('admin.answer-chat.index', $data);
    }

    public function customAnswerChat()
    {
        $data['answers'] = AnswerChat::query()->whereNotNull('custom_user_id')->get();
        return view('admin.questions-answers-request.answers-request', $data);
    }

    public function store(AnswerChatRequest $request)
    {
       //abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        AnswerChat::query()->create([
            'ar' => [
                'answer_title' => $request->answer_title_ar,
            ],
            'status' => $request->status,
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($questionChatId)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $answerChat = AnswerChat::query()->findOrFail($questionChatId);
        return view('admin.answer-chat.edit', compact('answerChat'));

    }

    public function update(AnswerChatRequest $request, $questionChatId)
    {

        $answerChat = AnswerChat::query()->findOrFail($questionChatId);

        $data = [
            'ar' => [
                'answer_title' => $request->answer_title_ar,
            ],
            'status' => $request->status,
        ];
        $answerChat->update($data);

        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($questionChatId)
    {
//        abort_if(Gate::denies('lesson_step_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answerChat = AnswerChat::query()->findOrFail($questionChatId);
        return view('admin.answer-chat.show', compact('answerChat'));
    }

    public function destroy($questionChatId)
    {
//        abort_if(Gate::denies('lesson_step_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $answerChat = AnswerChat::find($questionChatId);
        if (!$answerChat) {
            return response()->json(['status' => true, 'msg' => trans('global.data_not_found')]);
        } else {
            $answerChat->translations()->delete();
            $answerChat->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }

    public function changeStatusRequestAnswerChat(Request $request)
    {
        try {
            $answer = AnswerChat::query()->find($request->id);
            if (!$answer) {
                return response()->json(['status' => false, 'msg' => trans('global.data_not_found')]);
            }
            $status = $answer->status == '0' ? '1' : '0';
            $answer->update(['status' => $status]);
            return response()->json(['status' => true, 'active' => $answer->getAcceptOrReject(), 'id' => $answer->id, 'msg' => trans('global.update_success')]);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_some_error')]);

        }
    }

}
