<?php

namespace App\Model;

use App\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    const PRODUCT = 'product';

    protected $fillable = [

        'photo',
        'title',
        'content',
        'department_id',
        'brand_id',
        'manu_id',
        'color_id',
        'size_id',
        'weight',
        'weight_id',
        'currency_id',
        'other_data',
        'stock',
        'price',
        'start_at',
        'end_at',
        'price_offer',
        'start_offer_at',
        'end_offer_at',
        'status',
        'reason',
    ];

    public function files(){

        return $this->hasMany(File::class,'relation_id','id')->where('file_type',self::PRODUCT);
    }
}
