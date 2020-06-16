<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable =[
        'name_ar',
        'name_en',
        'department_id',
        'is_public',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id', 'id');
    }
}
