@extends('layouts.app')

@section('title', 'Banca')

@section('content')

<h3>{{ $banca->nome_fantasia }}</h3>

<p>{{ $banca->descricao }}</p>

<h4>Produtos </h4>
<hr>
<a class="btn btn-primary float-end" href="{{ route('bancas.produtos.create', $banca->id) }}">Adicionar Produto</a>

@if (!empty($banca->produtos))
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Imagem</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banca->produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->imagem_url }}</td>
                    <td>{{ $produto->preco }}</td>
                    <td>Excluir</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else

@endif

@endsection