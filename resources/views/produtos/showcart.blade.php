@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ __('Carrinho') }}</h1>

    @php $total = 0; @endphp

    @if ($cart === null || count($cart) <= 0) 

        <h4>{{ __('Não existem itens no carrinho de compras') }}</h4>
        <a class="btn btn-primary" href="{{ route('catalogo') }}">{{ __('Efetuar compras') }}</a>

    @else

    <form method="POST" action="{{ route('produtos.updatecart') }}">
    @csrf

        <table class="table cart-view">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Nome') }}</th>
                    <th scope="col">{{ __('Peço (€/Unid.)') }}</th>
                    <th scope="col">{{ __('Quantidade (Unid.)') }}</th>
                    <th scope="col">{{ __('Subtotal (€)') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

            @foreach ($cart as $key=>$row)
                <tr>
                    <td><a href="{{ route('produtos.showProduto', $key) }}"><img src="{{ url('images') }}/{{ $row['imagem'] }}" alt="{{ $row['nome'] }}"></a></td>
                    <td><a href="{{ route('produtos.showProduto', $key) }}">{{ $row['nome'] }}</a></td>
                    <td>{{ number_format($row['preco'], 2, ",", " ") }}</td>
                    <td><input type="number" min="1" value = "{{ $row['quantidade'] }}" name="quantidades[{{$key}}]"></td>
                    <td>{{ number_format($row['preco'] * $row['quantidade'], 2, ",", " ") }}</td>
                    <td>
                        <div class="form-checkbox">
                            <input class="form-check-input" type="checkbox" name="apagar[]" id="check{{ $key }}" value="{{ $key }}">
                            <label class="form-check-label" for="check{{ $key }}">{{ __('Remover') }}</label>
                        </div>
                    </td>
                    @php $total += $row['preco'] * $row['quantidade']; @endphp
                </tr>
            @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{ __('Total') }}</strong></td>
                    <td><strong>{{ number_format($total, 2, ",", " ") }}</strong></td>
                    <td><input type="submit" value="{{ __('Atualizar') }}" class="btn btn-outline-secondary"></td>
                </tr>

            </tbody>
                
        </table>

    </form>

    <div class="btn-group" role="group" arial-label="Ações do formulário">   
        <a class="btn btn-primary" href="{{ route('encomendas.create') }}">{{ __('Efetuar o Pagamento') }}</a>
        <a class="btn btn-outline-secondary" href="{{ route('catalogo') }}">{{ __('Efetuar mais compras') }}</a>
    </div>

    @endif
    
@endsection