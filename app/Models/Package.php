<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'packages';

    protected $with = ['translations'];

    protected $translatedAttributes = ['title',"description","subscription_features"];

    protected $fillable = [
        'id',
        'status',
        'price',
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS = [
        '1' => 'مفعلة',
        '0' => 'غير مفعلة',
    ];

}
