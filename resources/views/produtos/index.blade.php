@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ __('Produtos') }}</h1>

        @if (count($produtos) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nome') }}</th>
                    <th scope="col">{{ __('Categoria') }}</th>
                    <th scope="col">{{ __('Peço (€/Unid.)') }}</th>
                    <th scope="col">{{ __('Stock (Unid.)') }}</th>
                    <th scope="col">{{ __('Ações') }}</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($produtos as $produto)

            <tr>
                <td><p>{{ $produto->id }}</p></td>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->nome_categoria }}</td>
                <td>{{ $produto->preco }}</td>
                <td>{{ $produto->stock }}</td>
                <td>
                    <div class="btn-group" role="group" arial-label="Ações do formulário">  
                        <a href="{{ route('admin.produtos.show', $produto->id) }}" class="btn btn-outline-secondary">{{ __('Ver') }}</a>
                        <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="btn btn-outline-secondary">{{ __('Editar') }}</a> 
                        <a href="{{ route('admin.produtos.delete', $produto->id) }}" class="btn btn-outline-secondary">{{ __('Remover') }}</a>
                    </div>
                </td>
            </tr>

            @endforeach

            </tbody>
            
        </table>
        @else

        <p>{{ __('Não existe nenhum produto na base de dados') }}</p>

        @endif

        <a class="btn btn-primary" href="{{ route('admin.produtos.create') }}">{{ __('Adicionar') }}</a>

    </div>
    


@endsection