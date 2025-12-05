@extends('layouts.app')

@section('title', 'Bancas')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Bancas</li>
    </ol>
</nav>

<!-- Botão Nova Banca alinhado à direita -->
<div class="row mb-3">
    <div class="col d-flex justify-content-end">
        <a class="btn btn-light" href="{{ route('bancas.create') }}">
            <i class="fas fa-store"></i> Cadastrar Banca
        </a>
    </div>
</div>

@if($bancas->isEmpty())
    <p>Nenhuma banca cadastrada.</p>
@else
    <div class="row">
        @foreach($bancas as $banca)
            <div class="col-md-3 mb-4">
                <div class="card item-card d-flex flex-column h-100" style="border-radius: 10px; overflow:hidden; cursor:pointer;">
                    
                    <!-- Imagem -->
                    <div class="thumbnail">
                        <img src="{{ $banca->foto_url }}" 
                            class="card-img-top"
                            alt="{{ $banca->nome_fantasia }}"
                            style="height: 180px; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $banca->nome_fantasia }}</h5>

                        <p class="card-text" style="font-size: 14px;">
                            {{ $banca->categoria?->nome ?? 'Sem categoria' }}
                        </p>

                        <p class="text-muted">
                            <small class="d-flex align-items-center gap-1">
                                <i class="fa-regular fa-heart"></i>
                                <span>
                                    Adicionado <strong>{{ $banca->favoritos->count() }}</strong> vezes aos favoritos
                                </span>
                            </small>
                        </p>

                        <p class="card-text" style="font-size: 14px;">
                            <i class="fab fa-instagram"></i>
                            <span>
                                @if($banca->instagram)
                                    <a href="https://instagram.com/{{ $banca->instagram }}" target="_blank">
                                        {{ $banca->instagram }}
                                    </a>
                                @else
                                    Sem Instagram
                                @endif
                            </span>
                        </p>


                            <a href="{{ route('bancas.produtos.index', $banca->id) }}" class="btn btn-sm btn-light mb-1 w-100">
                                Produtos
                            </a>

                            <a href="{{ route('bancas.show', $banca->slug) }}" class="btn btn-sm btn-light mb-1 w-100">
                                Ver
                            </a>

                            <a href="{{ route('bancas.edit', $banca->id) }}" class="btn btn-sm btn-light mb-1 w-100">
                                Editar
                            </a>

                            <form action="{{ route('bancas.destroy', $banca->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja deletar esta banca?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger mb-1 w-100">
                                    Excluir
                                </button>
                            </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
