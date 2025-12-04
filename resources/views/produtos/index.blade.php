@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.index') }}">Bancas</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Produtos de {{ $banca->nome_fantasia }}</li>
    </ol>
</nav>

<div class="row mb-3">
    <div class="col d-flex justify-content-end">
        <a class="btn btn-light" href="{{ route('bancas.produtos.create', ['banca' => $banca->id]) }}">
            <i class="fa-solid fa-box"></i> Cadastrar Produto
        </a>
    </div>
</div>

@if ($banca->produtos->isEmpty())
    <p class="text-center">Nenhum produto cadastrado</p>
@else
    <div class="row">
        @foreach ($banca->produtos as $produto)
            <div class="col-md-3 mb-4">
                <div class="card item-card" style="border-radius: 10px; overflow:hidden; cursor:pointer;">
                    <!-- Imagem -->
                    <img src="{{ asset('storage/uploads/' . $produto->imagem_url) }}"
                         class="card-img-top"
                         alt="{{ $produto->nome }}"
                         style="height: 180px; object-fit: cover;">

                    <div class="card-body">
                        <!-- Nome do produto -->
                        <h5 class="card-title">{{ $produto->nome }}</h5>

                        <!-- Descrição -->
                        <p class="card-text" style="font-size: 14px; min-height: 151px;">
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

                        <!-- Ações -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('bancas.produtos.edit', ['banca' => $banca->id, 'produto' => $produto->id]) }}" 
                               class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{ route('bancas.produtos.destroy', ['banca' => $banca->id, 'produto' => $produto->id]) }}" 
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir o produto?')">
                                    Excluir
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection