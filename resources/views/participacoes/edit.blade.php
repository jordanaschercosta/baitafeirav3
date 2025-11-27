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

    <p>Participação no evento <strong>{{ $participacao->evento->titulo }}</strong></p>
    <form action="{{ route('participacoes.update', $participacao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="participacao_id" value="{{ $participacao->id }}">

        <h4>Minhas Bancas</h4>
        @foreach ($bancas as $banca)
            <div class="form-group">
                @if (in_array($banca->id, json_decode($participacao->bancas)))
                    <input type="checkbox" checked name="banca_id[]" value="{{ $banca->id }}"> {{ $banca->nome_fantasia }}
                @else
                    <input type="checkbox" name="banca_id[]" value="{{ $banca->id }}"> {{ $banca->nome_fantasia }}
                @endif
            </div>
        @endforeach

        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Salvar Alterações" />
        </div>
    </form>
@endsection