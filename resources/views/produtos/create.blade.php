@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.index') }}">Bancas</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.produtos.index', ['banca' => $banca]) }}">Produtos de {{ $banca->nome_fantasia }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Cadastrar Produto</li>
    </ol>
</nav>

<form action="{{ route('bancas.produtos.store', $banca->id) }}" method="POST">
    @include('produtos._form', ['buttonText' => 'Salvar'])
</form>
@endsection


