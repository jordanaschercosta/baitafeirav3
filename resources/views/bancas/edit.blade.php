@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('bancas.index') }}">Bancas</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Editar Banca</li>
    </ol>
</nav>

<form action="{{ route('bancas.update', $banca->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('bancas._form')

    <div class="form-group mt-3 text-end">
        <input type="submit" class="btn btn-primary" value="Salvar alterações" />
    </div>
</form>

@endsection
