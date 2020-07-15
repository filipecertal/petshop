<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['encomenda', 'produto', 'quantidade', 'preco'];

    public function encomenda()
    {
        return $this->belongsTo('App\Encomenda', 'pedido', 'id');
    }

}
