@php
    use App\Models\Enum\StatusEvento;
@endphp

<div class="row">
    <div class="col-md-6">
        <small class="text-muted">
            @if($paginacao)
                {{ $proximosEventos->total() }} eventos perto de você
            @else
                {{ $proximosEventos->count() }} eventos encontrados
            @endif
        </small>
    </div>
    @if($paginacao)
        <div class="col-md-6 float-end">
            <div class="d-flex justify-content-end mb-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="ordenarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenar
                        </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="ordenarDropdown">
                    <li><a class="dropdown-item" href="?ordenar=data">Data</a></li>
                    <li><a class="dropdown-item" href="?ordenar=mais_perto">Mais perto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="row">
    @php
        use Carbon\Carbon;
        $agora = Carbon::now();
    @endphp

    @foreach ($proximosEventos as $evento)
        @php
            $inicio = Carbon::createFromFormat('d/m/Y H:i', $evento->inicio);
            $fim    = Carbon::createFromFormat('d/m/Y H:i', $evento->fim);
            $emAndamento = $agora->between($inicio, $fim);
        @endphp

        <div class="col-md-4">
            <a href="{{ route('eventos.show', $evento->slug) }}" class="reset-link">
                <div class="thumbnail">
                    <img style="max-width: 100%;" src="{{ $evento->imagem_url }}">
                </div>

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

                    @if($emAndamento && $evento->status != StatusEvento::CANCELADO)
                        <span class="badge bg-success ms-2 d-inline-flex align-items-center gap-1">
                            <span class="pulse-dot"></span>
                            Acontecendo agora
                        </span>
                    @endif
                </p>
                
                <p>
                    <i class="fas fa-map-marker-alt"></i> {{ $evento->endereco }}
                </p>

                @if(isset($evento->distancia))
                    <p>
                        <small>
                            <i class="fas fa-route"></i>
                            {{ round($evento->distancia, 2) }} km
                        </small>
                    </p>
                @endif

            </a>
        </div>

    @endforeach
</div>

@if($paginacao)
    <!-- Links da paginação -->
    <div>
        {{ $proximosEventos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endif