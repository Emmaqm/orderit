<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{
    use Searchable;


    public function toSearchableArray()
    {
        $array = $this->toArray();

        $subcategory = $this->subcategories->toArray();
        $extraFields = [
            'subcategories' => $subcategory['nombre'],
        ];

        $array = array_merge($array, $extraFields);

        return $array;
    }
    

    public function subcategories(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }

    public function establishments(){
        return $this->belongsTo('App\Establishment', 'establishment_id');
    }

    public function presentPrice(){
        return money_format('$%i', $this->precio / 100);
    }
}
