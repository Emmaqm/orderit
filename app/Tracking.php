<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{

    protected $fillable = ['lugar', 'estado', 'id_pedido', 'id_establecimiento'];


    public function orders(){
        return $this->belongsTo('App\Order', 'id_pedido');
    }

    public function establishments(){
        return $this->belongsTo('App\Establishment', 'id_establecimiento');
    }

}
