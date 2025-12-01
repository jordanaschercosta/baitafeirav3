<input type="hidden" name="participacao_id" value="{{ $participacao->id ?? '' }}">
<input type="hidden" name="evento_id" value="{{ $participacao->id ?? $evento->id }}">

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h4>Minhas Bancas</h4>

@php
    $bancasSelecionadas = isset($participacao->bancas)
        ? json_decode($participacao->bancas, true)
        : [];
@endphp

@foreach ($bancas as $banca)
    <div class="form-group">
        <input 
            type="checkbox" 
            name="banca_id[]" 
            value="{{ $banca->id }}"
            {{ in_array($banca->id, $bancasSelecionadas) ? 'checked' : '' }}
        >
        {{ $banca->nome_fantasia }}
    </div>
@endforeach
