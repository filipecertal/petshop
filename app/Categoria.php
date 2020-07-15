<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function produtos()
    {
        $this->hasMany('App\Produto');
    } 
}
