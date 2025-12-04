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

    <form method="GET"
        action="{{ route('categorias.show', $categoria->slug) }}"
        class="mb-4">

        <div class="row g-2">
            <div class="col-md-10">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Buscar banca pelo nome..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-light w-100">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
        </div>

    </form>


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

        <br>
        <div>
            {{ $bancas->links('pagination::bootstrap-5') }}
        </div>
    @else
        <p>Nenhuma banca cadastrada nesta categoria.</p>
    @endif
@endsection