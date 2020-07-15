<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    protected $fillable = ['nome', 'categoria_id', 'imagem', 'descricao', 'preco', 'stock'];

    public function cliente()
    {
        return $this->belongsTo('App\User',  'cliente', 'id');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'encomenda');
    }
}
