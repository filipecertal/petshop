@extends('layouts.app')

@section('content')


<div class="container">



    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if (\Request::route()->getName() === 'catalogo') {{ 'active' }} @endif" href="{{ route('catalogo') }}">Todos</a>
        </li>
        @foreach ($categorias as $categoria)
        <li class="nav-item">
            <a class="nav-link @if (\Request::route()->getName() === 'catalogo.categoria' && \Request::route()->parameters['categoria'] == $categoria->id ) {{ 'active' }} @endif" href="{{ route('catalogo.categoria', $categoria->id) }}">{{ $categoria->nome }}</a>
        </li>
        @endforeach
    </ul>
    <br>

    @if (count($produtos) <= 0)

    <div class="row justify-content-center">
        <h4>{{ __('Não existem produtos nesta categoria...') }}</h4>
    </div>

    @else

    <div class="row">
        @foreach ($produtos as $produto)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 product-card">
                    <a href="{{ route('produtos.showProduto', $produto->id) }}"><img class="card-img-top" src="{{ url('images') }}/{{ $produto->imagem }}" alt="{{ $produto->nome }}"></a>
                    <div class="card-body">
                        <h4 class="card-title">
                        <a href="{{ route('produtos.showProduto', $produto->id) }}">{{ $produto->nome }}</a>
                        </h4>
                        <h5><strong>{{ $produto->preco }} €</strong></h5>
                        <p class="card-text"> {{ $produto->descricao }}</p>


                        <form method="POST" action="{{ route('produtos.addToCart', $produto->id) }}">
                            @csrf
                             @method('PUT')

                            <div role="group" arial-label="Ações do formulário" class="input-group card-actions col-8">

                                @if ($produto->stock > 0)
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-success">{{ __('Comprar') }}</button>
                                    </div>
                                    <input type="number" id="quantidade" name="quantidade" class="form-control" min="1" value="1">
                                @else
                                    <div class="alert alert-danger">
                                        <span><strong>{{ __('Esgotado') }}</strong></span>
                                    </div>
                                @endif
                            </div>
                        </form>

                    </div>
   
                        <!--<div class="card-footer">
                            <small class="text-muted">★ ★ ★ ★ ☆</small>
                        </div>-->
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

@endsection