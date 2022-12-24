<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerQuestion extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'answer_questions';

    protected $with = ['translations'];

    protected $translatedAttributes = ['answer_title'];

    protected $fillable = [
        'id',
        'status',
        'question_id',
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }


}
