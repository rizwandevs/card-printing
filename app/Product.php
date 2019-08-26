<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public  function productVariation(){
        return $this->hasMany(ProductVariation::class,'product_id');
    }

    public  function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
