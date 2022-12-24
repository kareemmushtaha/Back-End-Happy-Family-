<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionChatTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'question_chat_translations';
    protected $fillable = ['question_title'];

}
