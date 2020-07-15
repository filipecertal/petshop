@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ $encomenda->cliente()->first()->name }}</h1>
    <h4>{{ $encomenda->created_at}}</h4>

    @php 
        $pedidos = $encomenda->pedidos()->get();
        $total = 0;
    @endphp

    @if ($pedidos !== null && count($pedidos) > 0)

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Produto') }}</th>
                <th scope="col">{{ __('Quantidade') }}</th>
                <th scope="col">{{ __('Preço') }}</th>
                <th scope="col">{{ __('Subtotal') }}</th>
               

            </tr>
        </thead>
        <tbody>

        @foreach ($pedidos as $pedido)

        <tr>
            <td><p>{{ $pedido->id }}</p></td>
            <td><p>{{ $pedido->produto }}</p></td>
            <td><p>{{ $pedido->quantidade }}</p></td>
            <td><p>{{ $pedido->preco }}</p></td>
            <td><p>{{ $pedido->quantidade * $pedido->preco }}</p></td>

            @php $total += $pedido->quantidade * $pedido->preco; @endphp
            
        </tr>

        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><p>{{ __('Total') }}</p></td>
            <td><p>{{ $total }}</p></td>
 
        </tr>

        </tbody>
        
    </table>

    @else

    <p>{{ __('Não existe nenhum pedido para a encomenda') }}</p>

    @endif














    <div class="btn-group" role="group" arial-label="Ações do formulário">   
        <a class="btn btn-primary" href="{{ url()->previous() }}">{{ __('Voltar')}}</a>
    </div>

    
@endsection