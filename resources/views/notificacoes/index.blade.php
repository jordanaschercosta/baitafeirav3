@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Notificações
        </li>
    </ol>
</nav>

<div id="alert-has-notifications" style="display: none !important" class="alert alert-info d-flex align-items-center" role="alert">
    <div>
        <i class="fa fa-bell me-2"></i>
        <span>Você tem notificações não lidas</span>
    </div>

    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-primary">
        Atualizar
    </a>
</div>

@if($notificacoes->isEmpty())
    <p class="text-muted" id="alert-no-notifications">Nenhuma notificação recebida.</p>
@else

<div class="list-group">

    @foreach($notificacoes as $notificacao)

        <div class="list-group-item 
                    d-flex gap-3 py-3 
                    {{ !$notificacao->lido ? 'bg-light' : '' }}">
            
            {{-- ÍCONE --}}
            <div class="pt-2 fs-4">
                <i class="bi
                    @switch($notificacao->tipo)
                        @case('evento') bi-calendar-event @break
                        @case('evento_reagendado') bi-arrow-repeat @break
                        @case('evento_cancelado') bi-x-circle @break
                        @default bi-info-circle
                    @endswitch
                "></i>
            </div>

            {{-- CONTEÚDO --}}
            <div class="w-100">
                
                {{-- DATA PEQUENA NO TOPO --}}
                <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">
                    {{
                        $notificacao->created_at
                            ->locale('pt_BR')
                            ->translatedFormat('d/m/Y \à\s H:i')
                    }}
                </small>

                <div class="d-flex justify-content-between align-items-start">
                    
                    <h6 class="mb-1 fw-bold">
                        {{ $notificacao->titulo }}
                    </h6>

                    @if(!$notificacao->lido)
                        <span class="badge bg-primary">
                            Novo
                        </span>
                    @endif

                </div>

                <small class="text-muted">
                    Tipo: {{ ucfirst(str_replace('_',' ', $notificacao->tipo)) }}
                </small>

                {{-- BOTÃO --}}
                @if($notificacao->url)
                    <div class="mt-2">
                        <a href="{{ $notificacao->url }}"
                           class="btn btn-sm btn-outline-primary">
                            Ver mais
                        </a>
                    </div>
                @endif

            </div>

        </div>

    @endforeach

</div>

@endif

@endsection
