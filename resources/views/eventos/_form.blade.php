@csrf

 @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="titulo">Título *</label>
    <input type="text" name="titulo" id="titulo" class="form-control" 
           value="{{ old('titulo', $evento->titulo ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <label for="inicio">Início *</label>
        <input type="datetime-local" name="inicio" id="inicio" class="form-control" 
               value="{{ old('inicio', isset($evento->inicio) ? date('Y-m-d\TH:i', strtotime($evento->inicio)) : '') }}" required>
    </div>

    <div class="col-md-6 form-group">
        <label for="fim">Fim *</label>
        <input type="datetime-local" name="fim" id="fim" class="form-control" 
               value="{{ old('fim', isset($evento->fim) ? date('Y-m-d\TH:i', strtotime($evento->fim)) : '') }}" required>
    </div>
</div>

<div class="form-group">
    <label for="imagem_url">Imagem *</label><br>
    <input type="file" id="imagem_url" data-aspectratio="retangular" name="imagem_url" accept="image/*">
</div>

<input type="hidden" name="x" id="cropX">
<input type="hidden" name="y" id="cropY">
<input type="hidden" name="width" id="cropWidth">
<input type="hidden" name="height" id="cropHeight">
<input type="hidden" name="imagemOriginal" id="imagemOriginalHidden">
<input type="hidden" name="cropped_image" id="cropped_image">

<div class="form-group">
    <img id="preview" style="max-width: 1000px;" 
         src="{{ isset($evento->imagem_url) ? asset('storage/uploads/' . $evento->imagem_url) : '' }}">
</div>

<div class="form-group">
    <label for="descricao">Descrição *</label>
    <textarea name="descricao" id="descricao" class="form-control" required>{{ old('descricao', $evento->descricao ?? '') }}</textarea>
</div>
<br>

<div class="row">
    <div class="col-md-2 form-group">
        <label for="cep">CEP *</label>
        <input type="text" name="cep" id="cep" class="form-control" 
               value="{{ old('cep', $evento->cep ?? '') }}" required>
    </div>

    <div class="col-md-8 form-group">
        <label for="rua">Rua *</label>
        <input type="text" name="rua" id="rua" class="form-control" 
               value="{{ old('rua', $evento->rua ?? '') }}" readonly>
    </div>

    <div class="col-md-2 form-group">
        <label for="numero">Número *</label>
        <input type="text" name="numero" id="numero" class="form-control" 
               value="{{ old('numero', $evento->numero ?? '') }}">
    </div>

    <div class="col-md-5 form-group">
        <label for="bairro">Bairro *</label>
        <input type="text" name="bairro" id="bairro" class="form-control" 
               value="{{ old('bairro', $evento->bairro ?? '') }}" readonly>
    </div>

    <div class="col-md-5 form-group">
        <label for="cidade">Cidade *</label>
        <input type="text" name="cidade" id="cidade" class="form-control" 
               value="{{ old('cidade', $evento->cidade ?? '') }}" readonly>
    </div>

    <div class="col-md-2 form-group">
        <label for="uf">UF *</label>
        <input type="text" name="uf" id="uf" class="form-control" 
               value="{{ old('uf', $evento->uf ?? '') }}" readonly>
    </div>
</div>