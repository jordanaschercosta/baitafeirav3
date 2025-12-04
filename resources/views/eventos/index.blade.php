@php
    use App\Models\Enum\StatusEvento;
@endphp

@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Eventos</li>
    </ol>
</nav>

@if (isUserOrganizador())
    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <a class="btn btn-light" href="{{ route('eventos.create') }}">
                <i class="fas fa-calendar-plus"></i> Novo evento
            </a>
        </div>
    </div>
@endif

@if($proximosEventos->isEmpty())
    <p>Nenhum evento cadastrado.</p>
@else
    <div class="row">
        @foreach($proximosEventos as &$evento)
            @php
                $participacao = null;

                if(isset($evento->evento)) {
                    $participacao = $evento;
                    $evento = $evento->evento;
                }

            @endphp
      
            <div class="col-md-4 mb-4">
                <div class="card h-100" style="border-radius: 10px; overflow: hidden;">
                    
                    <!-- Imagem do evento -->
                    @if($evento->imagem_url)
                        <img src="{{ $evento->imagem_url }}" 
                             class="card-img-top" 
                             alt="{{ $evento->titulo }}" 
                             style="height: 180px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                                        <h5 class="d-flex align-items-center gap-2">
                    @if($evento->status == StatusEvento::CANCELADO)
                        <span style="text-decoration: line-through; color: red;">
                            {{ $evento->titulo }}
                        </span>
                        <span class="text-danger" style="font-size: 0.8rem;">
                            (Evento cancelado)
                        </span>
                    @else
                        {{ $evento->titulo }}
                    @endif
                </h5>

                {{-- DATA --}}
                <p>
                    @if($evento->status == StatusEvento::CANCELADO)
                        <span class="text-danger">
                            <i class="fas fa-calendar-times"></i>
                            {{ $evento->inicio }}
                        </span>
                    @else
                        <i class="fas fa-calendar"></i>
                        {{ $evento->inicio }}
                    @endif
                </p>

                <!-- Endereço -->
                <p class="card-text mb-3"><strong>Endereço:</strong> {{ $evento->endereco }}</p>

                        <!-- Número de participantes -->
                        <p class="card-text mb-3">
                            <i class="fas fa-users"></i>
                            {{ $evento->participacoes->count() }} pessoas irão comparecer
                        </p>

                        <!-- Botões -->
                        <div class="mt-auto">
                            <a href="{{ route('eventos.show', $evento->slug) }}" class="btn btn-sm btn-light mb-1 w-100">
                                Ver
                            </a>
                            
                            @if (isEventOrganizador($evento->user_id))
                                <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-primary mb-1 w-100">
                                    Editar
                                </a>
                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        @if ($evento->status == StatusEvento::CANCELADO)
                                            Excluir
                                        @else
                                            Cancelar
                                        @endif
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('participacoes.edit', $participacao->id) }}" class="btn btn-sm btn-light mb-1 w-100">
                                    Ver participação
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $proximosEventos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endif

@endsection