@extends('layouts.app')

@section('title', 'Eventos')

@section('content')

<h4>Meus Eventos</h4>
@if($participacoes->isEmpty())
    <p>Nenhum evento agendado.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Local</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participacoes as $participacao)
                <tr>
                    <td>{{ $participacao->evento->titulo }}</td>
                    <td>{{ $participacao->evento->inicio }}</td>
                    <td>{{ $participacao->evento->fim }}</td>
                    <td>{{ $participacao->evento->endereco }}</td>
                    <td>
                        <a href="{{ route('eventos.show', $participacao->evento->slug) }}" class="btn btn-sm btn-default">Ver mais</a>
                        <form action="{{ route('participacoes.destroy', $participacao->id) }}" 
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tem certeza que deseja cancelar sua presença neste evento?')">
                                Cancelar presença
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif


<h4>Próximos Eventos</h4>
@if($proximosEventos->isEmpty())
    <p>Nenhum evento agendado.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Local</th>
                <th>Ações</th>
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
                        <a href="{{ route('eventos.show', $evento->slug) }}" class="btn btn-sm btn-default">Ver mais</a>
                        <a href="{{ route('participacoes.create', ['evento' => $evento->id]) }}" class="btn btn-sm btn-default">Confirmar presença</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection