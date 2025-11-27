@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')
    <small>#{{ $banca->id }} {{ $banca->nome_fantasia }}</small>
    <h3>Cadastrar Produto</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bancas.produtos.store', $banca->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="banca_id" value="{{ $banca->id }}">

        <!-- Inputs hidden para enviar os dados do crop -->
        <input type="hidden" name="x" id="cropX">
        <input type="hidden" name="y" id="cropY">
        <input type="hidden" name="width" id="cropWidth">
        <input type="hidden" name="height" id="cropHeight">
        <input type="hidden" name="imagemOriginal" id="imagemOriginalHidden">

        <div class="form-group">
            <label for="nome">Nome *</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
 
        <div class="form-group">
            <label for="nome">Descrição *</label>
            <textarea name="descricao" id="descricao" class="form-control" required></textarea>
        </div>

        {{-- <div class="form-group">
            <label for="foto_url">Imagem *</label>
            <input type="text" name="imagem_url" id="imagem_url" class="form-control" required>
        </div> --}}

        <div class="form-group">
            <label for="imagem_url">Imagem *</label>
            <input type="file" id="imagem_url" accept="image/*">
        </div>

        <input type="hidden" name="cropped_image" id="cropped_image">

        <img id="preview" style="max-width: 300px; display:none;">

        <div class="form-group">
            <label for="nome">Preço *</label>
            <input type="number" name="preco" id="preco" class="form-control" step="0.1" required>
        </div>

        <br>
        <div class="form-group float-end">
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div>
    </form>
@endsection