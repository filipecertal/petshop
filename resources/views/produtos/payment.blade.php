@extends('layouts.app')

@section('content')

<div class="container">

<h1>Método de Pagamento</h1>

<p>A sua encomenda será processada após bom pagamento. Transfira o montante da encomenda para o IBAN XXX XXX XXXXX</p>
<p>Obrigado</p>

<a class="btn btn-primary" href="{{ route('catalogo') }}">Voltar</a>

</div>



@endsection