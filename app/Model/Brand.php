<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'brands';

    protected $fillable = [
        'brand_name_ar',
        'brand_name_en',
        'logo',
    ];
}

