@extends('layouts.app')

@section('title', 'Confirmar Presença')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>Quero participar do evento <strong>{{ $evento->titulo }}</strong></p>
    <form action="{{ route('participacoes.store', $evento->id) }}" method="POST">
        @csrf

        <input type="hidden" name="evento_id" value="{{ $evento->id }}">

        <h4>Minhas Bancas</h4>
        @foreach ($bancas as $banca)
            <div class="form-group">
                <input type="checkbox" name="banca_id[]" value="{{ $banca->id }}"> {{ $banca->nome_fantasia }}
            </div>
        @endforeach

        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Confirmar Presença" />
        </div>
    </form>
@endsection