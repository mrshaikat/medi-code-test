<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function myVariant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function productVariantsPrice()
    {
        return $this->hasMany('App\Models\ProductVariantPrice');
    }
}