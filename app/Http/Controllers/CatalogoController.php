<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use App\Produto;

class CatalogoController extends Controller
{
    
    public function index() 
    {

        $categorias = Categoria::all();

        $produtos = \DB::table('produtos')
        ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
        ->select('produtos.*', 'categorias.nome AS nome_categoria')
        ->get();

        return view('catalogo', compact('categorias'), compact('produtos'));
    }

    public function catalogo($categoria)
    {

        $categorias = Categoria::all();

       $produtos = \DB::table('produtos')
        ->join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
        ->select('produtos.*', 'categorias.nome AS nome_categoria')
        ->where('produtos.categoria_id', $categoria)
        ->get();

        return view('catalogo', compact('categorias'), compact('produtos'));
    }
}
