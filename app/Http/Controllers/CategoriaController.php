<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        Categoria::create($this->validator());

        return redirect(route('admin.categorias.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        dd('SHOW');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $categoria->nome = request('nome');
        $categoria->save();
        
        return redirect(route('admin.categorias.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }

        $categoria->delete();

        return redirect(route('admin.categorias.index'));
    }

    public function delete(Categoria $categoria)
    {
        $user = auth()->user();

        if (!isset($user) || !$user->is_admin) {

            abort(403);
        }
        
        return view('categorias.delete', compact('categoria'));
    }

    protected function validator()
    {
        return request()->validate([
            'nome' => ['required', 'max:50']
        ]);
    }
}
