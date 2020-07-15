@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ $produto->nome }}</h1>

    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src="{{ url('images') }}/{{ $produto->imagem }}" alt="{{ $produto->nome }}">
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2">{{ __("Nome:") }}</div>
                <div class="col-md-10"><strong>{{ $produto->nome }}</strong></div>
            </div>
            <div class="row">
                <div class="col-md-2">{{ __("Categoria:") }}</div>
                <div class="col-md-10"><strong>{{ $produto->categoria()->first()->nome }}</strong></div>
            </div>
            <div class="row">
                <div class="col-md-2">{{ __("Descrição:") }}</div>
                <div class="col-md-10">{{ $produto->descricao }}</div>
            </div>
            <div class="row">
                <div class="col-md-2">{{ __("Preço:") }}</div>
                <div class="col-md-10"><strong>{{ $produto->preco }} € / Unid.</strong></div>
            </div>
            <div class="row">
                <div class="col-md-2">{{ __("Stock:") }}</div>
                <div class="col-md-10">{{ $produto->stock }} Unid.</div>
            </div>
        </div>
    </div>

    <div class="btn-group" role="group" arial-label="Ações do formulário">   
        <a class="btn btn-primary" href="{{ route('admin.produtos.index') }}">{{ __('Voltar')}}</a>
        <a class="btn btn-outline-secondary" href="{{ route('admin.produtos.edit', $produto->id) }}">{{ __('Editar') }}</a>
        <a class="btn btn-outline-secondary" href="{{ route('admin.produtos.delete', $produto->id) }}">{{ __('Remover') }}</a>
    </div>

    
@endsection