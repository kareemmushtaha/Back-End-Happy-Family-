<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserQuestionAnswer extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'user_question_answers';

    protected $fillable = [
        'id',
        'user_id',
        'question_id',
        'answer_question_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}


















