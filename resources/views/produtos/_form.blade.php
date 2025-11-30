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

<input type="hidden" name="banca_id" value="{{ $banca->id }}">

<!-- Inputs ocultos do crop -->
<input type="hidden" name="x" id="cropX">
<input type="hidden" name="y" id="cropY">
<input type="hidden" name="width" id="cropWidth">
<input type="hidden" name="height" id="cropHeight">
<input type="hidden" name="imagemOriginal" id="imagemOriginalHidden">

<div class="form-group">
    <label for="nome">Nome *</label>
    <input
        type="text"
        name="nome"
        id="nome"
        class="form-control"
        required
        value="{{ old('nome', $produto->nome ?? '') }}"
    >
</div>

<div class="form-group">
    <label for="descricao">Descrição *</label>
    <textarea
        name="descricao"
        id="descricao"
        class="form-control"
        required
    >{{ old('descricao', $produto->descricao ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="imagem_url">Imagem *</label>
    <input type="file" id="imagem_url" accept="image/*">
</div>

<!-- Campo para receber a imagem cortada -->
<input type="hidden" name="cropped_image" id="cropped_image">

<!-- Preview da imagem -->
@if(!empty($produto->imagem_url))
    <img id="preview"
         src="{{ asset('storage/uploads/' . $produto->imagem_url) }}"
         style="max-width: 300px; display:block;">
@else
    <img id="preview" style="max-width: 300px; display:none;">
@endif

<div class="form-group mt-3">
    <label for="preco">Preço *</label>
    <input
        type="number"
        name="preco"
        id="preco"
        class="form-control"
        step="0.1"
        required
        value="{{ old('preco', $produto->preco ?? '') }}"
    >
</div>
<br>

<div class="form-group">
    <input type="checkbox"
           name="em_promocao"
           id="em_promocao"
           value="1"
           {{ old('em_promocao', $produto->em_promocao ?? false) ? 'checked' : '' }}>
    <label for="em_promocao">Em promoção?</label>
</div>

<div class="form-group mt-3">
    <label for="valor_novo">Preço Promocional</label>
    <input
        type="number"
        name="valor_novo"
        id="valor_novo"
        class="form-control"
        step="0.1"
        disabled
        value="{{ old('valor_novo', $produto->valor_novo ?? '') }}"
    >
</div>

<button type="submit" class="btn btn-primary mt-3">
    {{ $buttonText ?? 'Salvar' }}
</button>