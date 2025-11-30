@extends('layouts.app')

@section('title', 'Banca')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('categorias.index') }}">Home</a>
        </li>
        @if (!empty($evento))
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $evento->titulo }}</a></li>
        @endif
        <li class="breadcrumb-item"><a href="{{ route("categorias.show", $banca->categoria->slug ) }}">{{ $banca->categoria->nome }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $banca->nome_fantasia }}</li>
    </ol>
</nav>

@if (!isUserDonoBanca($banca->user_id))
    <div class="row">
        <div class="col-md-3 ms-auto">
            @if ($favorito)
                <form action="{{ route('favoritos.destroy', $favorito->id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="banca_id" value="{{ $banca->id }}">
                    @method('DELETE')
                    <button class="btn btn-light">
                        <i class="fa-regular fa-heart"></i> Remover dos Favoritos
                    </button>
                </form>
            @else
                <form action="{{ route('favoritos.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="banca_id" value="{{ $banca->id }}">
                    <button class="btn btn-light">
                        <i class="fa-regular fa-heart"></i> Adicionar aos Favoritos
                    </button>
                </form>
            @endif
        </div>
    </div>
@endif

<div clas="row">
    <div class="col-md-4">
        <img src="{{ asset('storage/uploads/' . $banca->foto_url) }}">
    </div>
    <div class="col-md-8">
        <p>{{ $banca->descricao }}</p>
    </div>
</div>

<h4>Produtos</h4>

@if (!empty($banca->produtos) && $banca->produtos->isNotEmpty())
    <div class="row">
        @foreach ($banca->produtos as $produto)
            <div class="col-md-3 mb-4">
                <div class="card item-card d-flex flex-column h-100" style="border-radius: 10px; overflow:hidden; cursor:pointer;">
                    <img src="{{ asset('storage/uploads/' . $produto->imagem_url) }}"
                         class="card-img-top"
                         alt="{{ $produto->nome }}"
                         style="height: 180px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>

                        <p class="card-text" style="font-size: 14px;">
                            {{ Str::limit($produto->descricao, 80, '...') }}
                        </p>

                        <p class="card-text fw-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center">Nenhum produto cadastrado</p>
@endif

@endsection