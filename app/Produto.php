<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'categoria_id', 'imagem', 'descricao', 'preco', 'stock'];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

}
