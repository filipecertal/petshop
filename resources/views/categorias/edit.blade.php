@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ __('Editar Categoria') }}</h1>

    <form method="POST" action="{{ route('admin.categorias.update', $categoria->id) }}">
        @csrf
        @method('PATCH')

        <div class="form-group row">
            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome da Categoria') }}</label>

            <div class="col-md-6">
                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $categoria->nome }}" required autocomplete="nome" autofocus>

                @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Alterar') }}
                </button>
                <a class="btn btn-secondary" href="{{ route('admin.categorias.index') }}">Voltar</a>
            </div>
        </div>
    </form>
</div>
    
@endsection