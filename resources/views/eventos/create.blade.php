@extends('layouts.app')

@section('content')
   
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('eventos.index') }}">Eventos</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Cadastrar Evento</li>
    </ol>
</nav>

<form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
    @include('eventos._form')

    <div class="form-group mt-3 text-end">
        <input type="submit" class="btn btn-primary" value="Salvar" />
    </div>
</form>

@endsection