@extends('layouts.app')

@section('title', 'Bancas')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('bancas.create')}}">Nova Banca</a>

@if($bancas->isEmpty())
    <p>Nenhuma banca cadastrada.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nome Fantasia</th>
                <th>Categoria</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Instagram</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bancas as $banca)
                <tr>
                    <td>{{ $banca->nome_fantasia }}</td>
                    <td>{{ $banca->categoria?->nome ?? 'Sem categoria' }}</td>
                    <td>
                        {{ $banca->endereco }}, {{ $banca->numero ?? '' }}, 
                        {{ $banca->bairro ?? '' }} - {{ $banca->cidade ?? '' }}
                    </td>
                    <td>{{ $banca->telefone }}</td>
                    <td>{{ $banca->instagram }}</td>
                    <td><a href="{{ route('bancas.show', $banca->slug) }}" class="btn btn-sm btn-default">Exibir</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection