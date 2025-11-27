@extends('layouts.app')

@section('title', 'Home')

@section('content')
   <h3>Categorias</h3>
    
    <div class="row">
        @foreach ($categorias as $categoria)
            <a href="{{ route('categorias.show', $categoria->slug) }}" class="col-md-2 click-item">
                <div class="img-wrapper">
                    <img src="{{ $categoria->imagem }}">
                    <p class="text-center">{{ $categoria->nome }}</p>
                </div>
            </a>
       @endforeach
    </div>

   <br><br>
   <h3>Eventos</h3>

   @include("eventos.list", ['proximosEventos' => $proximosEventos, "paginacao" => true])
@endsection

<script>
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            
            fetch('/salva-localizacao', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ latitude: latitude, longitude: longitude })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Localização enviada com sucesso:', data);
            })
            .catch(error => {
                console.error('Erro ao enviar localização:', error);
            });
        },
        function (error) {
            console.error("Erro ao pegar localização:", error);
        }
    );
</script>