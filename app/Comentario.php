<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['user_id', 'produto_id', 'texto'];

    public function produto()
    {
        return $this->belongsTo('App\Produto');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
