<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'contact_us';
    protected $guarded= [''];
     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];



}






