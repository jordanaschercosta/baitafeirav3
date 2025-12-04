@extends('layouts.app')

@section('title', 'Meus Favoritos')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Meus Favoritos</li>
    </ol>
</nav>

<h4>Bancas Favoritas </h4>

@if($favoritos->isEmpty())
    <p>Você ainda não favoritou nenhuma banca.</p>
@else
    <div class="row">
        @foreach($favoritos as $favorito)
            @php
                $banca = $favorito->banca;
            @endphp

            <div class="col-md-3 mb-4">

                <!-- Link envolvendo TODO o card -->
                <a href="{{ route('bancas.show', $banca->slug) }}" 
                   style="text-decoration:none; color:inherit;">

                    <div class="card item-card" 
                         style="border-radius: 10px; overflow:hidden; cursor:pointer;">

                        <!-- Imagem -->
                        <img src="{{ asset('storage/uploads/' . $banca->foto_url) }}"
                             class="card-img-top"
                             alt="{{ $banca->nome_fantasia }}"
                             style="height: 180px; object-fit: cover;">

                        <div class="card-body">
                            <!-- Nome Fantasia -->
                            <h5 class="card-title">{{ $banca->nome_fantasia }}</h5>

                            <!-- Descrição -->
                            <p class="card-text" style="font-size: 14px;">
                                {{ Str::limit($banca->descricao, 80, '...') }}
                            </p>
                        </div>

                    </div>

                </a>
                <!-- FIM DO LINK -->

            </div>
        @endforeach
    </div>
@endif


<h4> Produtos Favoritos </h4>

@if($produtosFavoritos->isEmpty())
    <p>Você ainda não favoritou nenhuma produto.</p>
@else
    <div class="row">
        @foreach ($produtosFavoritos as $produtoFavorito)
            @php
                $produto = $produtoFavorito->produto;
            @endphp

            <div class="col-md-3 mb-4">
                <div class="card item-card d-flex flex-column h-100" style="border-radius: 10px; overflow:hidden;">
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
                            <form action="{{ route('favoritos.destroy', $produto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fa-solid fa-heart"></i> Remover dos Favoritos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
@endif

@endsection
