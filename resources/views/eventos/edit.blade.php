@extends('layouts.app')

@section('content')
   
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('eventos.index') }}">Eventos</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Editar Evento #{{ $evento->titulo }}</li>
    </ol>
</nav>

<form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')

    @include('eventos._form', ['evento' => $evento])

    <div class="form-group mt-3 text-end">
        <input type="submit" class="btn btn-primary" value="Salvar alterações" />
    </div>
</form>

@endsection