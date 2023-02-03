<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionChat extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'question_chats';

    protected $with = ['translations'];

    protected $translatedAttributes = ['question_title'];

    protected $fillable = [
        'id',
        'custom_user_id',
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

    public function scopeMyQuestionChat($query, $userFollowMediator = null)
    {
        $user = $userFollowMediator != null ? $userFollowMediator : auth()->user()->id;
        return $query->whereNull('custom_user_id')->orWhere('custom_user_id', $user);
    }


    public function getActive()
    {
        return $this->status == '1' ? trans('global.active') : trans('global.un_active');
    }

    public function getAcceptOrReject()
    {
        return $this->status == '1' ? trans('global.reject') : trans('global.accept');
    }

    public function customUserId(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'custom_user_id', 'id');
    }
}
