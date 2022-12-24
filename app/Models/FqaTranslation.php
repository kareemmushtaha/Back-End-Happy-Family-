<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FqaTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fqa_translations';

    protected $fillable = [
        'question',
        'answer'
    ];
}
