@extends('layouts.app')

@section('title', 'Editar Evento')

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

    <h3>Editar Evento #{{ $evento->id }}</h3>
    <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Título *</label>
            <input type="text" name="titulo" id="titulo" value="{{ $evento->titulo }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="foto_url">Imagem *</label>
            <input type="file" id="imagem_url" data-aspectratio="retangular" name="imagem_url" accept="image/*">
        </div>

        <input type="hidden" name="x" id="cropX">
        <input type="hidden" name="y" id="cropY">
        <input type="hidden" name="width" id="cropWidth">
        <input type="hidden" name="height" id="cropHeight">
        <input type="hidden" name="imagemOriginal" id="imagemOriginalHidden">

        <input type="hidden" name="cropped_image" id="cropped_image">

        <div class="form-group">
            <img id="preview" style="max-width: 100%;" src="{{ asset($evento->imagem_url) }}">
        </div>

        <div class="form-group">
            <label for="inicio">Início *</label>
                <input type="datetime-local" name="inicio" id="inicio" class="form-control"
                value="{{ old('inicio', isset($evento) ? \Carbon\Carbon::parse(str_replace('/', '-', $evento->inicio))->format('Y-m-d\TH:i') : '') }}"
                required>
        </div>

        <div class="form-group">
            <label for="fim">Fim *</label>
            <input type="datetime-local" name="fim" id="fim" class="form-control"
                value="{{ old('fim', isset($evento) ? \Carbon\Carbon::parse(str_replace('/', '-', $evento->fim))->format('Y-m-d\TH:i') : '') }}"
                required>
        </div>

        <div class="form-group">
            <label for="nome">Descrição *</label>
            <textarea name="descricao" id="descricao" class="form-control" required>{{ $evento->descricao }}</textarea>
        </div>

        <div class="row">  
            <div class="col-md-2 form-group">
                <label for="nome">CEP *</label>
                <input type="text" name="cep" id="cep" value="{{ $evento->cep }}" class="form-control" required>
            </div>
    
            <div class="col-md-8 form-group">
                <label for="nome">Rua *</label>
                <input type="text" name="rua" id="rua" value="{{ $evento->rua }}" class="form-control" readonly>
            </div>
    
            <div class="col-md-2 form-group">
                <label for="numero">Número *</label>
                <input type="text" name="numero" id="numero" value="{{ $evento->numero }}" class="form-control">
            </div>
    
            <div class="col-md-5 form-group">
                <label for="bairro">Bairro *</label>
                <input type="text" name="bairro" id="bairro" value="{{ $evento->bairro }}" class="form-control" readonly>
            </div>
    
            <div class="col-md-5 form-group">
                <label for="cidade">Cidade *</label>
                <input type="text" name="cidade" id="cidade" value="{{ $evento->cidade }}" class="form-control" readonly>
            </div>
    
            <div class="col-md-2 form-group">
                <label for="uf">UF *</label>
                <input type="text" name="uf" id="uf" value="{{ $evento->uf }}" class="form-control" readonly>
            </div>
        </div>

            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Salvar alterações" />
            </div>
        </div>
    </form>
@endsection