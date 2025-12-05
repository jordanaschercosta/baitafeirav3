 <div class="row">
        @foreach ($bancas as $banca)
            <a href="{{ route('bancas.show', ['banca' => $banca->slug]) }}" class="col-md-2 click-item">
                <div class="img-wrapper">
                    <div class="thumbnail">
                        <img src="{{ $banca->foto_url }}">
                    </div>
                    <p class="text-center">{{ $banca->nome_fantasia }}</p>
                </div>
            </a>
        @endforeach
    </div>