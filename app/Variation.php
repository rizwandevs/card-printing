<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public function variationValues(){
        return $this->hasMany(VariationValue::Class,'variation_id');
    }

    public function categoryVariation(){
        return $this->hasMany(CategoryVariation::Class,'variation_id');
    }
}
