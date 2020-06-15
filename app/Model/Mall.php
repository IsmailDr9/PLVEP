<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = 'malls';

    protected $fillable =[
        'name_ar',
        'name_en',
        'facebook',
        'twitter',
        'website',
        'contact_name',
        'lat',
        'lan',
        'icon',
        'email',
        'mobile',
        'address',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
