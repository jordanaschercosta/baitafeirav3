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

<div class="row">
    <div class="col-md-7">
        <small>{{ $banca->categoria->nome }}</small><h3>{{ $banca->nome_fantasia }}</h3>
        <p>{{ $banca->descricao }}</p>
    </div>
    <div class="col-md-5 text-center">
        <img src="{{ asset('storage/uploads/' . $banca->foto_url) }}" 
            alt="Foto da banca" 
            style="width:240px; border-radius:50%; object-fit:cover;">
    </div>
</div>

<h4>Produtos </h4>

@if (!empty($banca->produtos))
    <div class="galeria">
        @foreach ($banca->produtos as $produto)
            <div class="imgContainer">
                <img src="{{ asset('storage/uploads/' . $produto->imagem_url) }}" alt="{{ $produto->nome}} ">
                <br>
                <h5 class="text-center">{{$produto->nome }}</h5>
                <p class="text-center">R$ {{$produto->preco }}</p>
                <p>{{ $produto->descricao }}</p>
            </div>
        @endforeach
    </div>
@else
    <p class="text-center">Nenhum produto cadastrado</p>
@endif

<h4>Localização </h4>

@if(isUserDonoBanca($banca->user_id))
    @include('bancas.admin.actions')
@endif

@endsection