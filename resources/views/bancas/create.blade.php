@extends('layouts.app')

@section('title', 'Cadastrar Banca')

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

    <form action="{{ route('bancas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome Fantasia *</label>
            <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" required>
        </div>
 
        <div class="form-group">
            <label for="nome">Descrição *</label>
            <textarea name="descricao" id="descricao" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria *</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="foto_url">Imagem *</label>
            <input type="file" id="imagem_url" name="foto_url" accept="image/*">
        </div>

        <input type="hidden" name="x" id="cropX">
        <input type="hidden" name="y" id="cropY">
        <input type="hidden" name="width" id="cropWidth">
        <input type="hidden" name="height" id="cropHeight">
        <input type="hidden" name="imagemOriginal" id="imagemOriginalHidden">

        <input type="hidden" name="cropped_image" id="cropped_image">

        <div class="form-group">
            <img id="preview" style="max-width: 300px; display:none;">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço *</label>
            <input type="text" name="endereco" id="endereco" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numero">Numero *</label>
            <input type="text" name="numero" id="numero" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="bairro">Bairro *</label>
            <input type="text" name="bairro" id="bairro" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cidade">Cidade *</label>
            <input type="text" name="cidade" id="cidade" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone *</label>
            <input type="text" name="telefone" id="telefone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" name="instagram" id="instagram" class="form-control">
        </div>

        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div>
    </form>
@endsection