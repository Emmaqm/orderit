<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'posts_index';
    }

    

    public function subcategories(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }

    public function presentPrice(){
        return money_format('$%i', $this->precio / 100);
    }
}
