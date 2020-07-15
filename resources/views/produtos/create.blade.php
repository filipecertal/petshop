@extends('layouts.app')

@section('content')


<div class="container">

    <h1>{{ __('Novo Produto') }}</h1>

    <form method="POST" action="{{ route('admin.produtos.store') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Nome do Produto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome" class="col-form-label text-md-right">{{ __('Nome do Produto') }}</label>

                    <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>

                    @error('nome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>    
            </div>

            <!-- Categoria do Produto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categoria" class="col-form-label text-md-right">{{ __('Categoria do Produto') }}</label>

                    <div class="input-group">
                        <select name="categoria_id" id="categoria" class="custom-select @error('categoria') is-invalid @enderror" required autocomplete="categoria" autofocus>
                            @forelse($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @empty
                                <option>{{ __('Não existem categorias para seleccionar') }}</option>
                            @endforelse 
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-outline-secondary" href="{{ route('admin.categorias.index') }}">{{ _('Gerir')}}</a>
                        </div>
                    </div>

                    @error('categoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>    
            </div>
        
        </div>

       
        <div class="row">
            <div class="col-md-6">

                <!-- Descrição do Produto -->
                <div class="form-group">
                    <label for="descricao" class="col-form-label">{{ __('Descrição do Produto') }}</label>
                    <textarea rows="4" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus>{{ old('descricao')}}</textarea>
                    @error('descricao')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <!-- Preço do Produto -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="preco" class="col-form-label">{{ __('Preço do Produto') }}</label>
                            <input type="numeric" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror" value="{{ old('preco') }}" required autocomplete="preco" autofocus> </input>
                            @error('preco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- Stock do Produto -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock" class="col-form-label">{{ __('Stock do Produto') }}</label>
                            <input type="numeric" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required autocomplete="stock" autofocus> </input>
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <!-- Imagem do Produto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="imagem" class="col-form-label">{{ __('Imagem do Produto') }}</label>
                    <input type="file" name="imagem" id="imagem" class="form-control @error('imagem') is-invalid @enderror" value="{{ old('imagem') }}" required autocomplete="imagem" autofocus> 
                    @error('imagem')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Ações do formulários -->
        <div class="row">

            <div class="col-md-6 col-centered">
                <div class="btn-group" role="group" arial-label="Ações do formulário">   
                    <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
                    <a class="btn btn-secondary" href="{{ route('admin.produtos.index') }}">{{ __('Voltar') }}</a>
                </div>
            </div>
        </div>

    </form>

</div>
    
@endsection