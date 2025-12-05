@php
    use App\Models\Enum\StatusEvento;
@endphp

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
    <img style="width: 100%; margin-bottom: 1.2pc;" src="{{ $evento->imagem_url }}">
</div>

@if ($evento->status == StatusEvento::CONFIRMADO)
    @if (isEventOrganizador($evento->user->id))
        <form action="{{ route('eventos.destroy', $evento->id) }}"
            method="POST"
            class="float-end"
            style="display:inline;">

            @csrf
            @method('DELETE')

            <button type="submit"
                class="btn btn-danger"
                onclick="return confirm('Tem certeza que deseja cancelar o evento?')">
                <i class="fa-solid fa-calendar-xmark"></i>
                Cancelar Evento
            </button>
        </form>
    @else
        @if (session('user_id'))
            @if (empty($participacao))
                <a href="{{ route('participacoes.create', ['evento' => $evento->id]) }}" class="float-end btn btn-primary"><i class="fa-solid fa-calendar-check"></i> Quero Participar</a>
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
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Tem certeza que deseja cancelar participação?')">
                            <i class="fa-solid fa-calendar-xmark"></i> Cancelar Participação
                        </button>
                    </form>
                @endif            
            @endif
        @else
            <a href="{{ route('participacoes.create', ['evento' => $evento->id, 'redirect' => url()->current() ]) }}" class="float-end btn btn-primary"><i class="fa-solid fa-calendar-check"></i> Quero Participar</a>
        @endif
    @endif
@else
    <span class="float-end text-danger fw-bold">
        <i class="fa-solid fa-calendar-xmark"></i>
        Evento Cancelado
    </span>
@endif

<h3>{{ $evento->titulo }}</h3>

<p>
    <i class="fa-solid fa-calendar-plus me-2"></i>
    <strong>Início:</strong> {{ $evento->inicio }}
</p>

<p>
    <i class="fa-solid fa-calendar-check me-2"></i>
    <strong>Fim:</strong> {{ $evento->fim }}
</p>

<p>
    <i class="fa-solid fa-align-left me-2 text-secondary"></i>
    <strong>Descrição</strong><br>
    {{ $evento->descricao }}
</p>

<br>
<h4 class="title-center">Bancas Participantes</h4>
@if ($listaBancas)
    <div class="row">
        @foreach ($listaBancas as $banca)
            <a href="{{ route('bancas.show', ['banca' => $banca->slug, 'evento' => $evento->id]) }}" class="col-md-2 click-item">
                <div class="img-wrapper">
                    <div class="thumbnail">
                        <img src="{{ $banca->foto_url }}">
                    </div>
                    <p class="text-center">{{ $banca->nome_fantasia }}</p>
                </div>
            </a>
        @endforeach
    </div>
@else
    <p class="text-sm text-gray-600 text-center">Nenhuma banca confirmou presença neste evento.</p>
@endif
<br>

<h4 class="title-center">Localização</h4>
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

<h4 class="title-center">Organizador</h4>
{{-- INFOS EXPOSITOR --}}
<p class="mb-1">
    <i class="fas fa-envelope"></i>
    <b>Email:</b> {{ $evento->user->email }}
</p>

@if(!empty($evento->user->phone))
<p class="mb-1">
    <i class="fas fa-phone"></i>
    <b>Telefone:</b> {{ $evento->user->phone }}
</p>
@endif

@endsection

