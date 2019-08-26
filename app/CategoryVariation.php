<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryVariation extends Model
{
    public function category(){
        return $this->belongsTo(Category::Class,'category_id');
    }

    public function variationByCategory(){
        return $this->belongsTo(Variation::Class,'category_id');
    }

    public function variation(){
        return $this->belongsTo(Variation::Class,'variation_id');
    }
}
