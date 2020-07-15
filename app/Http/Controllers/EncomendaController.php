<?php

namespace App\Http\Controllers;

use App\Encomenda;
use App\Pedido;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {

            $encomendas = Encomenda::orderBy('created_at', 'DESC')->paginate(10);

            return view('encomendas.index', compact('encomendas'));

        } else {

            return redirect(route('catalogo'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = session()->get('cart');
        $user = auth()->user();

        if ($user === null) {
            return redirect('/login');
        }

        $encomenda = new Encomenda;

        $encomenda->cliente = $user->id;

        $encomenda->save();

        foreach ($cart as $key=>$row) {

            $pedido = new Pedido;

            $pedido->encomenda = $encomenda->id;
            $pedido->produto = $key;
            $pedido->quantidade = $row['quantidade'];
            $pedido->preco = $row['preco'];

            $pedido->save();

        }

        session()->forget('cart');

        return redirect(route('cart.payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Encomenda  $encomenda
     * @return \Illuminate\Http\Response
     */
    public function show(Encomenda $encomenda)
    {
        $user = auth()->user();

        if ($user->is_admin) {


            return view('encomendas.show', compact('encomenda'));

        } else {

            return redirect(route('catalogo'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encomenda  $encomenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Encomenda $encomenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encomenda  $encomenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encomenda $encomenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encomenda  $encomenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encomenda $encomenda)
    {
        $encomenda->delete();

        return redirect(url()->previous());
    }

    public function processar(Encomenda $encomenda)
    {

        $user = auth()->user();

        if ($user->is_admin) {

            $encomenda->processada = !$encomenda->processada;
            $encomenda->update();

        }
        
        return redirect(url()->previous());
        
    }

    public function payment()
    {
        return view('produtos.payment');
    }
}
