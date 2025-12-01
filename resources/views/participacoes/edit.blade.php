@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('eventos.index') }}">Eventos</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Participação em {{ $participacao->evento->titulo }}</li>
    </ol>
</nav>

<form action="{{ route('participacoes.update', $participacao->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('participacoes._form', [
        'evento' => $participacao->evento, 
        'participacao' => $participacao,
        'bancas' => $bancas
    ])

    <div class="d-flex justify-content-end gap-2 mt-3">
        {{-- Botão DELETE --}}
        <button 
            type="button"
            class="btn btn-danger"
            onclick="confirmDelete()"
        >
            Cancelar Participação
        </button>

        <button type="submit" name="acao" value="salvar" class="btn btn-primary">
            Salvar Alterações
        </button>
    </div>
</form>

{{-- FORM DE DELETE (oculto) --}}
<form 
    id="form-delete"
    action="{{ route('participacoes.destroy', $participacao->id) }}"
    method="POST"
    style="display:none;"
>
    @csrf
    @method('DELETE')
</form>

@endsection

<script>
    function confirmDelete() {
        if (confirm('Deseja realmente cancelar sua participação?')) {
            document.getElementById('form-delete').submit();
        }
    }
</script>