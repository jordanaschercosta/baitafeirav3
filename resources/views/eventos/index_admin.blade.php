@extends('layouts.app')

@section('title', 'Eventos')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('eventos.create') }}">Novo evento</a>

<h4>Eventos</h4>
@if($proximosEventos->isEmpty())
    <p>Nenhum evento cadastrado.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Endereço</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proximosEventos as $evento)
                <tr>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ $evento->inicio }}</td>
                    <td>{{ $evento->fim }}</td>
                    <td>{{ $evento->endereco }}</td>
                    <td>
                        <a href="{{ route('eventos.show', $evento->slug) }}" class="btn btn-sm btn-default">Exibir</a>
                        <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('eventos.destroy', $evento->id) }}" 
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja cancelar evento?')">
                                Cancelar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection