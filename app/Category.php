<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categoryVariation(){
        return $this->hasMany(CategoryVariation::Class,'category_id');
    }

    public  function product(){
        return $this->hasMany(Product::class,'category_id');
    }

}
