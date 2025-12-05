<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cancelamento de Evento</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background:#f7f7f7; padding:20px;">

    <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:10px;">

        {{-- <div style="text-align:center; margin-bottom:20px;">
            <img src="{{ $logo }}"
                alt="Baita Feira"
                style="max-width:180px;width:100%;height:auto;">
        </div> --}}

        <h2 style="text-align:center;">Olá, {{ $nome }}!</h2>

        <p>
            Lamentamos informar que o evento abaixo foi <strong style="color:#990000;">cancelado</strong>:
        </p>

        <h3>{{ $evento->titulo }}</h3>

        {{-- DATA --}}
        <p>
            📅 <strong>Data:</strong>
            {{ $evento->inicio }}
        </p>

        {{-- LOCAL --}}
        <p>
            📍 <strong>Local:</strong>
            {{ $evento->endereco }}
        </p>

        <p style="text-align:center; margin:25px 0;">
            <a href="{{ route('eventos.show', $evento->slug) }}"
               style="
                    background:#990000;
                    color:#fff;
                    padding:12px 20px;
                    border-radius:6px;
                    text-decoration:none;
                    display:inline-block;
                    font-weight:bold;
               ">
                Ver detalhes do evento
            </a>
        </p>

        <p>
            Pedimos desculpas por qualquer inconveniente causado.
            Esperamos poder recebê-lo(a) em uma nova oportunidade em breve.
        </p>

        <p>— Equipe Baita Feira</p>

    </div>

</body>
</html>
