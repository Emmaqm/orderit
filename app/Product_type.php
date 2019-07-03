<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{

    public function subcategories(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }

    public function presentPrice(){
        return money_format('$%i', $this->precio / 100);
    }
}
