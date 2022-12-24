<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPackage extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'user_packages';

    protected $fillable = [
        'id', 'package_id', 'user_id', 'price', 'start_date', 'end_date', 'status'
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public const STATUS = [
        '1' => 'مفعلة',
        '0' => 'غير مفعلة',
    ];

}
