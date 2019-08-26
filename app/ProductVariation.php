<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public  function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public  function variationValues(){
        return $this->hasMany(VariationValue::class,'product_id');
    }
}
