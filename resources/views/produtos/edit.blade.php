@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.index') }}">Bancas</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.produtos.index', ['banca' => $produto->banca]) }}">Produtos de {{ $produto->banca->nome_fantasia }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Editar #{{ $produto->nome }}</li>
    </ol>
</nav>

<form action="{{ route('bancas.produtos.update', [$produto->banca->id, $produto->id]) }}" method="POST">
    @method('PUT')
    @include('produtos._form', ['buttonText' => 'Salvar alterações'])
</form>

@endsection
