@extends('layouts.app')

@section('title', $categoria->nome)

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categorias.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $categoria->nome }}</li>
        </ol>
    </nav>

    <h4>Bancas</h4>
    @if($bancas->isNotEmpty())
        <div class="row">
            @foreach ($bancas as $banca)
                <a href="{{ route('bancas.show', $banca->slug) }}" class="col-md-2 click-item">
                    <div class="img-wrapper">
                        <img src="{{ asset('storage/uploads/' . $banca->foto_url) }}">
                        <p class="text-center">{{ $banca->nome_fantasia }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p>Nenhuma banca cadastrada nesta categoria.</p>
    @endif
@endsection