<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AriaTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'aria_translations';
    protected $fillable = ['title'];}
