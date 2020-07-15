@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>{{ __('Encomendas') }}</h1>

        @if ($encomendas !== null && count($encomendas) > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Data/Hora') }}</th>
                    <th scope="col">{{ __('Cliente') }}</th>
                    <th scope="col">{{ __('Processada') }}</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

            @foreach ($encomendas as $encomenda)

            <tr>
                <td><p>{{ $encomenda->id }}</p></td>
                <td><p>{{ $encomenda->created_at }}</p></td>
                <td><p>{{ $encomenda->cliente()->first()->name }}</p></td>
                <td><p>{{ $encomenda->processada?'Sim':'Não' }}</p></td>
                <td>
                    <div class="btn-group" role="group" arial-label="Ações do formulário"> 
                        <a href="{{ route('encomendas.show', $encomenda) }}" class="btn btn-secondary">{{ __('Ver') }}</a>
                        <a href="{{ route('encomendas.processar', $encomenda) }}" class="btn btn-outline-secondary">{{ __('Processar') }}</a>
                        <a href="{{ route('encomendas.destroy', $encomenda) }}" class="btn btn-outline-secondary">{{ __('Remover') }}</a>
                    </div>
                </td>
                
            </tr>

            @endforeach

            </tbody>
            
        </table>

        {{ $encomendas->render() }}

        @else

        <p>{{ __('Não existe nenhum produto na base de dados') }}</p>

        @endif


    </div>
    


@endsection