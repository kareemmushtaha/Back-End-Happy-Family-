<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;


    protected $table = 'settings';

    protected $with = ['translations'];

    protected $translatedAttributes = ['value'];

    protected $fillable = [
        'id',
        'key',
        'active',
    ];

    protected $hidden = ['translations'];
}
