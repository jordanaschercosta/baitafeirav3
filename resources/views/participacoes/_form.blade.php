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

@if ($bancas->count() > 0)
    <h4>Minhas Bancas</h4>
@endif

@php
    $bancasSelecionadas = isset($participacao->bancas)
        ? json_decode($participacao->bancas, true)
        : [];
@endphp

@foreach ($bancas as $banca)
    <div class="form-group d-flex align-items-center mb-2" style="gap:10px;">
        
        {{-- Checkbox --}}
        <input 
            type="checkbox" 
            name="banca_id[]" 
            value="{{ $banca->id }}"
            {{ in_array($banca->id, $bancasSelecionadas) ? 'checked' : '' }}
        >

        {{-- Thumbnail --}}
        <div style="
            width:60px;
            height:60px;
            border-radius:8px;
            overflow:hidden;
            background:#f2f2f2;
            display:flex;
            align-items:center;
            justify-content:center;
        ">
            <img 
                src="{{ $banca->foto_url }}"
                alt="{{ $banca->nome_fantasia }}"
                style="
                    width:100%;
                    height:100%;
                    object-fit:cover;
                "
                onerror="this.style.display='none';"
            >
        </div>

        {{-- Nome --}}
        <strong>{{ $banca->nome_fantasia }}</strong>

    </div>
@endforeach
