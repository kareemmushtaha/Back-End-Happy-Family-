<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewPersonalInformation extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'view_personal_information';
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fromUser()
    {
        //this is  sender
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function toUser()
    {
        //this is receiver
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }
}

