<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerChatTranslation extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'answer_chat_translations';
    protected $fillable = ['answer_title'];}
