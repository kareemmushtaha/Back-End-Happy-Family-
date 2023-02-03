<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'questions';

    protected $with = ['translations'];

    protected $translatedAttributes = ['question_title'];

    protected $fillable = [
        'id',
        'status',
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function answers()
    {
        return $this->hasMany(AnswerQuestion::class, 'question_id', 'id');
    }

    public function getActive()
    {
        return $this->status == '1' ? trans('global.active') : trans('global.un_active');
    }


}








