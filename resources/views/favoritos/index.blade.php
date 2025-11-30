@extends('layouts.app')

@section('title', 'Meus Favoritos')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Meus Favoritos</li>
    </ol>
</nav>

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

@endsection
