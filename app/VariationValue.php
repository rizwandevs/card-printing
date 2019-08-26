<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationValue extends Model
{
    public function variation(){
        return $this->belongsTo(Variation::Class,'variation_id');
    }
}
