<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Chat extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'chats';
    protected $fillable = [
        'id',
        'sender_id',
        'received_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = ['last_message', 'last_message_time'];


    public function conversation(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Conversations::class)->with('question', 'answer');
    }

    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'received_id', 'id');
    }


    public function getLastMessageAttribute(): string
    {

        $count_message_un_answer = $this->conversation()->where('received_id', "=", auth()->user()->id)->whereNull('answer_chat_id')->count();
        if ($count_message_un_answer > 0 ) {
            return trans('global.the_number_of_unanswered_questions') . $count_message_un_answer;
        } else {
            return trans('global.all_question_is_answered');
        }
    }

    public function getLastMessageTimeAttribute()
    {
        $last_message_time = $this->conversation()->latest()->first();
        $last_message_time = $last_message_time ? $last_message_time->created_at->format('h:i') : "";
        return $last_message_time;
    }


}
