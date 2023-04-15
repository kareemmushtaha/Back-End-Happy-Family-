<?php

namespace App\Http\Controllers\Mediator;

use App\Http\Controllers\Controller;
use App\Models\AnswerChat;
use App\Models\Chat;
use App\Models\Conversations;
use App\Models\QuestionChat;
use App\Models\User;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use function Webmozart\Assert\Tests\StaticAnalysis\null;


class FollowMediatorChatController extends Controller
{

    public function index($user_follow_mediator)
    {
        $data['questions'] = QuestionChat::query()->Active()->MyQuestionChat($user_follow_mediator)->get();
        $data['answers'] = AnswerChat::query()->Active()->MyAnswerChat($user_follow_mediator)->get();
        $data['user_follow_mediator'] = $user_follow_mediator;

        return view('site.followMediatorMessages', $data);
    }

    public function createAndOpenChat($user_follow_mediator, $user_id)
    {
        // Note middleware checkMediator

        if ($user_id == null) {
            $data['questions'] = QuestionChat::query()->Active()->MyQuestionChat($user_follow_mediator)->get();
            return view('site.followMediatorMessages', $data);
        }
        $checkUserFollowMediator = User::query()->where('mediator_id', auth()->user()->id)->find($user_follow_mediator);
        if (!$checkUserFollowMediator) {
            //sorry this user not follow you
            return redirect()->back();
        }

        if ($user_id != $user_follow_mediator) {
            $checkChat = Chat::where(function ($query) use ($user_follow_mediator, $user_id) {
                $query->where('sender_id', $user_follow_mediator)->where('received_id', $user_id);
            })->orWhere(function ($query) use ($user_follow_mediator, $user_id) {
                $query->where('received_id', $user_follow_mediator)->where('sender_id', $user_id);
            })->first();

            if (!$checkChat) {
                $chat =   Chat::create([
                    'sender_id' => $user_follow_mediator,
                    'received_id' => $user_id,
                ]);
                $chat_Id = $chat->id;
            } else {
                $chat_Id = $checkChat->id;
            }
        }
        $data['questions'] = QuestionChat::query()->Active()->MyQuestionChat($user_follow_mediator)->get();
        $data['answers'] = AnswerChat::query()->Active()->MyAnswerChat($user_follow_mediator)->get();
        $data['user_follow_mediator'] = $user_follow_mediator;
        $data['chatId'] = $chat_Id;

        return view('site.followMediatorMessages', $data);
    }


    public function getMessages($user_follow_mediator)
    {
        $messages = Chat::with(['sender', 'receiver', 'conversation'])->orderBy('updated_at', 'desc')
            ->where(function ($query) use ($user_follow_mediator) {
                $query->where('sender_id', '=', $user_follow_mediator)->orWhere('received_id', '=', $user_follow_mediator);
            })->get();

        return response()->json(['chat' => $messages]);
    }

    public function getMessagesChatMessage($user_follow_mediator,$chat_id = 0)
    {
        $messages = Chat::with(['conversation'])->orderBy('id', 'asc')
            ->where(function ($query) use ($user_follow_mediator) {
                $query->where('sender_id', '=', $user_follow_mediator)
                    ->orWhere('received_id', '=', $user_follow_mediator);
            })->findOrFail($chat_id)->conversation;

        $chat = Chat::query()->findOrFail($chat_id);

        if ($chat->sender_id == $user_follow_mediator) {
            $other_user = User::query()->with('country', 'city')->findOrFail($chat->received_id);
        } elseif ($chat->received_id == $user_follow_mediator) {
            $other_user = User::query()->with('country', 'city')->findOrFail($chat->sender_id);
        }
        return response()->json(['messages' => $messages, 'other_user' => $other_user]);
    }


    public function getChat($user_follow_mediator)
    {

        $chats = Chat::with(['conversation'])->orderBy('updated_at', 'desc')
            ->where(function ($query) use ($user_follow_mediator) {
                $query->where('sender_id', '=', $user_follow_mediator)
                    ->orWhere('received_id', '=', $user_follow_mediator);
            })->get();
        return $chats;
    }

    public function send_question_chat(\Illuminate\Http\Request $request,$user_follow_mediator)
    {


        if ($request->chat_id == null) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.chose_contact')]);
        }


        $conversation = Conversations::query()->where('chat_id', $request->chat_id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '!=', $user_follow_mediator)->count();

        if ($conversation) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.question_has_already_been_sent')]);
        }


        $chat = Chat::query()->find($request->chat_id);

        if ($user_follow_mediator == $chat->sender_id) {
            $conversation_user_received = $chat->received_id;
        } elseif ($user_follow_mediator == $chat->received_id) {
            $conversation_user_received = $chat->sender_id;
        }
        $conversations = Conversations::query()->create([
            'received_id' => $conversation_user_received,
            'chat_id' => $request->chat_id,
            'question_chat_id' => $request->question_id,
            'answer_chat_id' => null,
        ]);

        $question = QuestionChat::query()->findOrFail($request->question_id);

        if ($conversations) {
            return response()->json(['status' => true, 'question_title' => $question->question_title, 'msg' => trans('cruds.chat.send_message_successfully')]);
        }
    }

    public function send_answer_chat(\Illuminate\Http\Request $request,$user_follow_mediator)
    {
        if ($request->chat_id == null) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.chose_contact')]);
        }

        $questionChat = QuestionChat::query()->find($request->question_id);
        if ($questionChat->status == 0) {
            return response()->json(['status' => false, 'msg' => trans('cruds.chat.sorry_cant_sent_answer_question_not_activate')]);
        }


        $chat = Chat::query()->findOrFail($request->chat_id);

        $conversation = Conversations::query()->where('chat_id', $chat->id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '=', $user_follow_mediator)->update([
                'answer_chat_id' => $request->answer_id,
            ]);

        $answer = AnswerChat::query()->findOrFail($request->answer_id);
        $conversation = Conversations::query()->where('chat_id', $chat->id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '=', $user_follow_mediator)->first();


        if ($conversation) {
            return response()->json(['status' => true, 'answer_title' => $answer->answer_title, 'conversation_id' => $conversation->id, 'msg' => trans('cruds.chat.send_answer_successfully')]);
        }


    }

    public function send_custom_answer_chat(\Illuminate\Http\Request $request,$user_follow_mediator)
    {
        if ($request->chat_id == null) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.chose_contact')]);
        }

        $questionChat = QuestionChat::query()->find($request->question_id);
        if ($questionChat->status == 0) {
            return response()->json(['status' => false, 'msg' => trans('cruds.chat.sorry_cant_sent_answer_question_not_activate')]);
        }

        $new_answer = AnswerChat::query()->create([
            'ar' => [
                'answer_title' => $request->answer_title_ar,
            ],
            'status' => 0,
            'custom_user_id' => $user_follow_mediator,
        ]);

        $chat = Chat::query()->findOrFail($request->chat_id);


        $conversation = Conversations::query()->where('chat_id', $chat->id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '=', $user_follow_mediator)->update([
                'answer_chat_id' => $new_answer->id,
            ]);

        $conversation = Conversations::query()->where('chat_id', $chat->id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '=', $user_follow_mediator)->first();

        if ($conversation) {
            return response()->json(['status' => true, 'answer_title' => $new_answer->answer_title, 'conversation_id' => $conversation->id, 'msg' => trans('cruds.chat.send_answer_successfully')]);
        }

    }


    public function send_custom_question_chat(\Illuminate\Http\Request $request,$user_follow_mediator)
    {

        if ($request->chat_id == null) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.chose_contact')]);
        }

        $conversation = Conversations::query()->where('chat_id', $request->chat_id)
            ->where('question_chat_id', $request->question_id)->where('received_id', '!=', $user_follow_mediator)->count();

        if ($conversation) {
            toastr()->success(trans('global.chose_contact'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => false, 'msg' => trans('global.question_has_already_been_sent')]);
        }

        $chat = Chat::query()->find($request->chat_id);

        if ($user_follow_mediator == $chat->sender_id) {
            $conversation_user_received = $chat->received_id;
        } elseif ($user_follow_mediator == $chat->received_id) {
            $conversation_user_received = $chat->sender_id;
        }

        $new_question = QuestionChat::query()->create([
            'ar' => [
                'question_title' => $request->question_title_ar,
            ],
            'status' => 0,
            'custom_user_id' => $user_follow_mediator,
        ]);

        $conversations = Conversations::query()->create([
            'received_id' => $conversation_user_received,
            'chat_id' => $request->chat_id,
            'question_chat_id' => $new_question->id,
            'answer_chat_id' => null,
        ]);

        if ($conversations) {
            return response()->json(['status' => true, 'question_title' => $new_question->question_title, 'msg' => trans('cruds.chat.send_message_successfully')]);
        }
    }

    public function searchMessages(Request $request)
    {
        $search = $request->search;
        $messages = Chat::query()->with(['sender', 'receiver', 'conversation'])->orderBy('updated_at', 'desc')
            ->where(function ($query) use ($search) {
                $query->whereHas('sender', function ($query_1) use ($search) {
                    $query_1->where('first_name', 'like', '%' . $search . '%');
                    $query_1->orWhere('last_name', 'like', '%' . $search . '%');
                })->orWhereHas('receiver', function ($query_2) use ($search) {
                    $query_2->where('first_name', 'like', '%' . $search . '%');
                    $query_2->orWhere('last_name', 'like', '%' . $search . '%');
                });
            })->get();

        return response()->json(['chat' => $messages]);
    }


}









