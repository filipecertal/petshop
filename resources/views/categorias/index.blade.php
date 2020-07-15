@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ __('Categorias') }}</h1>

        @if (count($categorias) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nome') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            @foreach ($categorias as $categoria)

            <tr>
                <td><p>{{ $categoria->id }}</p></td>
                <td>{{ $categoria->nome }}</td>
                <td>
                    <div class="btn-group" role="group" arial-label="Ações do formulário">
                        <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-outline-secondary">{{ __('Editar') }}</a>
                        <a href="{{ route('admin.categorias.delete', $categoria->id) }}" class="btn btn-outline-secondary">{{ __('Remover') }}</a>
                    </div>
                </td>
            </tr>

            @endforeach

            </tbody>
            
        </table>
        @else

        <p>{{ __('Não existe nenhuma categoria na base de dados') }}</p>

        @endif

        <a class="btn btn-primary" href="{{ route('admin.categorias.create') }}">{{ __('Adicionar') }}</a>

    </div>
    


@endsection