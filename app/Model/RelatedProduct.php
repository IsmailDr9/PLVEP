<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $table = 'related_products';

    protected $fillable = [
        'product_id',
        'related_product_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class,'id','related_product_id');
    }
}
