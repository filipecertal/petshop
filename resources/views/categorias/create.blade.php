@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ __('Nova Categoria') }}</h1>

    <form method="POST" action="{{ route('admin.categorias.store') }}">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('Nome da Categoria') }}</label>

            <div class="col-md-6">
                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>

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
                    {{ __('Adicionar') }}
                </button>
                <a class="btn btn-secondary" href="{{ route('admin.categorias.index') }}">{{ __('Voltar') }}</a>
            </div>
        </div>
    </form>
</div>
    
@endsection