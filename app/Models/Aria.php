<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aria extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'arias';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title'];


    protected $fillable = [
        'id',
        'country_id',
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
