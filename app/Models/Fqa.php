<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fqa extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;
    use Translatable;

    protected $table = 'fqas';

    protected $with = ['translations'];

    protected $translatedAttributes = ['question', 'answer'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public const STATUS = [
        '1' => 'مفعل',
        '0' => 'غير مفعل',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
