@extends('layouts.app')

@section('title', 'Microoemprendedores')

@section('content')

<a class="btn btn-primary float-end" href="{{ route('bancas.create')}}">Novo Banca</a>

@if($bancas->isEmpty())
    <p>Nenhuma banca cadastrado.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nome Fantasia</th>
                <th>Categoria</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Instagram</th>
                <!-- <th>Ações</th> -->
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
                    <!-- <td>
                        <a href="{{ route('bancas.edit', $micro->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('bancas.destroy', $banca->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td> -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection