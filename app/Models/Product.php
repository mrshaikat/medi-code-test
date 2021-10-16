<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function productVariantPrices()
    {
        return $this->hasMany('App\Models\ProductVariantPrice', 'product_id', 'id');
    }

    public function productVariant()
    {
        return $this->hasMany('App\Models\ProductVariant', 'product_id', 'id');
    }
}