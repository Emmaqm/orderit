<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function products(){
        return $this->belongsTo('App\Product_type');
    }
}
