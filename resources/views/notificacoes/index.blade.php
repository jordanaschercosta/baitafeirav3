@php
    use App\Models\Enum\TipoNotificacao;
@endphp

@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            Notificações
        </li>
    </ol>
</nav>

<div id="alert-has-notifications"
     style="display: none !important"
     class="alert alert-info d-flex align-items-center"
     role="alert">

    <div>
        <i class="fa fa-bell me-2"></i>
        <span>Você tem notificações não lidas</span>
    </div>

    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-primary">
        Atualizar
    </a>

</div>

@if($notificacoes->isEmpty())

    <p class="text-muted" id="alert-no-notifications">
        Nenhuma notificação recebida.
    </p>

@else

<div class="list-group">

@foreach($notificacoes as $notificacao)

@php

    // Ícone e cor padrão
    $icone = 'fa-circle-info';
    $cor   = 'text-secondary';

    if ($notificacao->tipo === TipoNotificacao::EVENTO_CANCELADO) {
        $icone = 'fa-calendar-xmark';
        $cor   = 'text-danger';

    } elseif ($notificacao->tipo === TipoNotificacao::EVENTO_LEMBRETE) {
        $icone = 'fa-bell';
        $cor   = 'text-warning';

    } elseif ($notificacao->tipo === TipoNotificacao::EVENTO_REAGENDADO) {
        $icone = 'fa-calendar-days';
        $cor   = 'text-primary';
    } elseif ($notificacao->tipo === TipoNotificacao::PRODUTO_PROMOCAO) {
        $icone = 'fa-tag';
        $cor   = 'text-primary';
    } else {
        $icone = 'fa-calendar-check';
        $cor   = 'text-primary';
    }

@endphp

<div class="card mb-2 shadow-sm border-0
    @if($notificacao->event_id && $notificacao->tipo === TipoNotificacao::EVENTO_CANCELADO)
        border-start border-danger border-3
    @elseif($notificacao->event_id)
        border-start border-primary border-3
    @endif
">

    <div class="card-body py-2">

        {{-- DATA + HORA --}}
        <small class="text-muted d-flex align-items-center gap-1 mb-1" style="font-size: 0.75rem;">
            <i class="fa-solid fa-clock"></i>
            {{
                $notificacao->created_at
                    ->timezone(config('app.timezone'))
                    ->format('d/m/Y H:i')
            }}
        </small>

        {{-- LINHA PRINCIPAL --}}
        <div class="d-flex justify-content-between align-items-start">

            <div>

                {{-- ÍCONE + TÍTULO --}}
                <div class="d-flex align-items-center gap-2 mb-1">

                    <i class="fa-solid {{ $icone }} {{ $cor }}"></i>

                    <h6 class="mb-0">
                        {{ $notificacao->titulo }}
                    </h6>

                </div>

                {{-- MENSAGEM --}}
                <p class="mb-0 text-muted">
                    {!! $notificacao->mensagem !!}
                </p>

            </div>

            {{-- AÇÕES --}}
            <div class="d-flex align-items-center gap-2">

                {{-- LINK --}}
                @if(
                    $notificacao->evento_id &&
                    $notificacao->evento
                )
                    <a href="{{ route('eventos.show', $notificacao->evento->slug) }}"
                       class="btn btn-sm btn-outline-primary">
                        Ver evento
                    </a>
                @elseif ($notificacao->url)
                    <a href="{{ $notificacao->url }}"
                       class="btn btn-sm btn-outline-primary">
                        Ver mais
                    </a>
                @endif

                {{-- BADGE --}}
                @if(!$notificacao->lido)
                    <span class="badge bg-primary">
                        Novo
                    </span>
                @endif

            </div>

        </div>

    </div>

</div>

@endforeach

</div>

@endif

@endsection
