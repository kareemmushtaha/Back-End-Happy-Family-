<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuccessStory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;
    use Translatable;

    protected $table = 'success_stories';

    protected $with = ['translations'];

    protected $translatedAttributes = ['title', 'description'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'status',
        'photo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS = [
        '1' => 'مفعلة',
        '0' => 'غير مفعلة',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/man.png');
        }
        return asset('storage/successStory/' . $value);
    }
}
