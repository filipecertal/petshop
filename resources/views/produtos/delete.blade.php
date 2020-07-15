@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ __('Apagar Produto') }}</h1>

    <p>{{ __('Deseja apagar o produto') . ' ' . $produto->nome . '?' }}</p>

    <form method="POST" action="{{ route('admin.produtos.destroy', $produto->id) }}">
        @csrf
        @method('DELETE')


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Apagar') }}
                </button>
                <a class="btn btn-secondary" href="{{ url()->previous() }}">{{ __('Cancelar') }}</a>
            </div>
        </div>
    </form>
</div>
    
@endsection