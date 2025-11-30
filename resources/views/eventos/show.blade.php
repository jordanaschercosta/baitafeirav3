@extends('layouts.app')

@section('title', 'Evento')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('categorias.index') }}">Home</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $evento->titulo }}</li>
  </ol>
</nav>

<div class="banner">
    <img style="width: 100%; margin-bottom: 1.2pc;" src="{{ asset('storage/uploads/' . $evento->imagem_url) }}">
</div>

@if (isEventOrganizador($evento->user->id))
    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="float-end" onsubmit="return confirm('Tem certeza que deseja cancelar?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Cancelar</button>
    </form>
@else
    @if (session('user_id'))
        @if (empty($participacao))
            <a href="{{ route('participacoes.create', ['evento' => $evento->id]) }}" class="float-end btn btn-primary">Tenho interesse</a>
        @else
            @if(isUserExpositor())
                <a href="{{ route('participacoes.edit', $participacao->id ) }}" class="float-end btn btn-primary">Ver participação</a>
            @else
                <form action="{{ route('participacoes.destroy', $participacao->id) }}" 
                    method="POST"
                    class="float-end"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Tem certeza que deseja cancelar participação?')">
                        Cancelar
                    </button>
                </form>
            @endif            
        @endif
    @else
        <a href="{{ route('participacoes.create', ['evento' => $evento->id, 'redirect' => url()->current() ]) }}" class="float-end btn btn-primary">Tenho interesse</a>
    @endif
@endif

<h3>{{ $evento->titulo }}</h3>

<p><strong>Início:</strong> {{ $evento->inicio }}</p>
<p><strong>Fim:</strong> {{ $evento->fim }}</p>

<p>
    <strong>Descrição</strong><br>
    {{ $evento->descricao }}
</p>

<p><strong>Local:</strong> {{ $evento->endereco }}</p>

<h4>Bancas Participantes</h4>
<div class="row">
    @foreach ($listaBancas as $banca)
        <a href="{{ route('bancas.show', ['banca' => $banca->slug, 'evento' => $evento->id]) }}" class="col-md-2 click-item">
            <div class="img-wrapper">
                <img src="{{ asset('storage/uploads/' . $banca->foto_url) }}">
                <p class="text-center">{{ $banca->nome_fantasia }}</p>
            </div>
        </a>
    @endforeach
</div>

<br>

<h4>Localização</h4>
<p>{{ $evento->endereco }}</p>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([{{ $evento->latitude }}, {{ $evento->longitude }}], 13); // Porto Alegre

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // --- Marcação do Evento ---
    var marker = L.marker([{{ $evento->latitude }}, {{ $evento->longitude }}]).addTo(map);

    // Opcional: popup ao clicar
    marker.bindPopup("<b>{{ $evento->titulo }}</b><br>{{ $evento->endereco }}");
</script>

<br>

<small>Organizador {{ $evento->user->name }}</small>

@endsection

