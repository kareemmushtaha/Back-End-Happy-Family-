<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    protected $fillable = ['received_id', 'chat_id', 'question_chat_id', 'answer_chat_id', 'file_name', 'is_seen'];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
    public function question()
    {
        return $this->belongsTo(QuestionChat::class, 'question_chat_id','id');
    }

    public function answer()
    {
        return $this->belongsTo(AnswerChat::class, 'answer_chat_id','id');
    }
}
