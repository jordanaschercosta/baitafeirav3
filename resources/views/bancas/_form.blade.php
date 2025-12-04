@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf

<!-- Campos hidden do crop -->
<input type="hidden" name="x" id="cropX" value="{{ old('x', $banca->x ?? '') }}">
<input type="hidden" name="y" id="cropY" value="{{ old('y', $banca->y ?? '') }}">
<input type="hidden" name="width" id="cropWidth" value="{{ old('width', $banca->width ?? '') }}">
<input type="hidden" name="height" id="cropHeight" value="{{ old('height', $banca->height ?? '') }}">
<input type="hidden" name="imagemOriginal" id="imagemOriginalHidden" value="{{ old('imagemOriginal', $banca->imagemOriginal ?? '') }}">
<input type="hidden" name="cropped_image" id="cropped_image" value="{{ old('cropped_image', $banca->cropped_image ?? '') }}">

<div class="row">
    <!-- Nome Fantasia -->
    <div class="col-md-8">
        <div class="form-group">
            <label for="nome_fantasia">Nome Fantasia *</label>
            <input type="text" name="nome_fantasia" id="nome_fantasia" 
                   class="form-control" required
                   value="{{ old('nome_fantasia', $banca->nome_fantasia ?? '') }}">
        </div>
    </div>

    <!-- Categoria -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="categoria_id">Categoria *</label>
            <select name="categoria_id" id="categoria_id" class="form-select" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ (old('categoria_id', $banca->categoria_id ?? '') == $categoria->id) ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="descricao">Descrição *</label>
    <textarea name="descricao" id="descricao" class="form-control" required>{{ old('descricao', $banca->descricao ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="instagram">Instagram</label>
    <div class="input-group">
        <span class="input-group-text">https://instagram.com/</span>
        <input type="text" 
               name="instagram" 
               id="instagram" 
               class="form-control"
               placeholder="nome_do_perfil" 
               value="{{ old('instagram', $banca->instagram ?? '') }}">
    </div>
</div>

<br>
<div class="form-group">
    <label for="foto_url">Imagem *</label><br>
    <input type="file" id="imagem_url" name="foto_url" accept="image/*">
</div>

<div class="form-group text-center">
    <img 
        id="preview" 
        style="max-width: 300px; display: {{ isset($banca->foto_url) ? 'block' : 'none' }};"
        src="{{ isset($banca->foto_url) ? asset('storage/uploads/'.$banca->foto_url) : '' }}"
        alt="Pré-visualização"
    >
</div>