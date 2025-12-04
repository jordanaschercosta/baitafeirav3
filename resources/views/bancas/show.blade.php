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

@if (!isUserDonoBanca($banca->user_id) && !isUserOrganizador())
    <div class="row">
        <div class="col-md-3 ms-auto" style="text-align: right">
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

<p class="text-muted text-end">
    <small class="d-flex justify-content-end align-items-center gap-1">
        <span>
            Adicionado <strong>{{ $banca->favoritos->count() }}</strong> vezes aos favoritos
        </span>
    </small>
</p>

<div class="row align-items-center">
    <div class="col-md-3 mb-3">
        <img 
            src="{{ asset('storage/uploads/' . $banca->foto_url) }}"
            class="img-fluid rounded"
            style="max-width: 250px;"
            alt="{{ $banca->nome_fantasia }}"
        >
    </div>

    <div class="col-md-7">
        <p style="font-size:14px;">
            <i class="fas fa-align-left text-secondary"></i>
            {{ $banca->descricao }}
        </p>

        @if($banca->instagram)
            <p class="mt-2">
                <i class="fab fa-instagram text-danger"></i>
                <a href="https://instagram.com/{{ ltrim($banca->instagram, '@') }}"
                target="_blank">
                    {{ '@' . ltrim($banca->instagram, '@') }}
                </a>
            </p>
        @endif
        
        <br>

        <h4>Contato</h4>
        {{-- INFOS EXPOSITOR --}}
        <p class="mb-1">
            <i class="fas fa-envelope"></i>
            <b>Email:</b> {{ $banca->user->email }}
        </p>

        @if(!empty($banca->user->phone))
            <p class="mb-1">
                <i class="fas fa-phone"></i>
                <b>Telefone:</b> {{ $banca->user->phone }}
            </p>
        @endif
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

                        <p class="card-text" style="font-size: 14px; min-height: 151px">
                            {{ $produto->descricao }}
                        </p>

                        <!-- Preço -->
                        @if($produto->em_promocao)
                            <p class="card-text fw-bold">
                                <span class="text-muted text-decoration-line-through">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </span>

                                <span class="text-success ms-2">
                                    R$ {{ number_format($produto->valor_novo, 2, ',', '.') }}
                                </span>

                                <span class="badge bg-success ms-2">
                                    <i class="fa-solid fa-tag me-1"></i> Promoção
                                </span>
                            </p>
                        @else
                            <p class="card-text fw-bold">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>
                        @endif
                        
                        
                        @if(in_array($produto->id, $produtos_favoritos))
                                <form action="{{ route('favoritos.destroy', $produto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fa-solid fa-heart"></i> Remover dos Favoritos
                                    </button>
                                </form>

                            @else
                                <form action="{{ route('favoritos.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                    <button class="btn btn-light btn-sm w-100">
                                        <i class="fa-regular fa-heart"></i> Adicionar aos Favoritos
                                    </button>
                                </form>
                            @endif
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center">Nenhum produto cadastrado</p>
@endif

@include("eventos.list", ['proximosEventos' => $eventos, "paginacao" => false])

{{-- BANCAS EXPOSITOR --}}
@if(!$bancas->isEmpty())
    <h4 class="mb-3">Bancas deste expositor</h4>

    <div class="row">
        @foreach($bancas as $banca)
            <div class="col-md-3 mb-4">
                <div class="card item-card d-flex flex-column h-100"
                     style="border-radius: 10px; overflow: hidden;">

                    {{-- Imagem --}}
                    <img 
                        src="{{ asset('storage/uploads/' . $banca->foto_url) }}"
                        class="card-img-top"
                        alt="{{ $banca->nome_fantasia }}"
                        style="height: 180px; object-fit: cover;"
                    >

                    <div class="card-body d-flex flex-column">

                        {{-- Nome --}}
                        <h5 class="card-title">
                            {{ $banca->nome_fantasia }}
                        </h5>

                        {{-- Categoria --}}
                        <p class="card-text mb-1" style="font-size:14px;">
                            {{ $banca->categoria?->nome ?? 'Sem categoria' }}
                        </p>

                        {{-- Instagram --}}
                        <p class="card-text" style="font-size:14px;">
                            @if($banca->instagram)
                                <i class="fab fa-instagram"></i>
                                <a href="https://instagram.com/{{ ltrim($banca->instagram, '@') }}"
                                   target="_blank">
                                    {{ '@' . ltrim($banca->instagram, '@') }}
                                </a>
                            @else
                                <span class="text-muted">
                                    Sem Instagram
                                </span>
                            @endif
                        </p>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection