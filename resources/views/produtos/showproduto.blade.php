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

     <a class="btn btn-primary" href="{{ url()->previous() }}">{{ __('Voltar')}}</a>



        
    <div class="row">
        <div class="col">
            <h5>{{ __('Comentários') }}</h5>
            <hr>
        </div>
  
    </div>

    <div class="row">

        <div class="col-md-6">

            @php $comentarios = $produto->comentarios()->orderBy('created_at', 'DESC')->paginate(3); @endphp

            @foreach ($comentarios as $comentario)
            <div class="row">
                <div class="col">
                    <p>{{ __('Por') }} <strong>{{ $comentario->user->name }}</strong> {{ __('a') }} <strong>{{ date('H:m:s d/m/Y', strtotime($comentario->created_at)) }}</strong>: 
                        @if (auth()->user() !== null && auth()->user()->is_admin)
                            <a href="{{ route('comentarios.destroy', $comentario->id) }}" class="btn btn-secondary">{{ __('Remover') }}</a>
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>{{ $comentario->texto }}</p>
                </div>
            </div>

            <hr>
            @endforeach

            {{ $comentarios->render() }}
        
        </div>


        @if (auth()->user() !== null)

        <div class="col-md-6">
            <form method="POST" action="{{ route('produtos.addcomentario', $produto) }}">
            @csrf
                <div class="row">
                    <div class="col">
                        <label for="comentario" class="input-label">{{ __('Insira o seu comentário:') }}</label>
                        <textarea id="texto" name="texto" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                        <input type="submit" class="btn btn-outline-secondary" value="{{ __('Submeter') }}">
                    </div>
                </div>
            </form>
        </div>

        @endif
    
    
    </div>






  

 
    




    
@endsection