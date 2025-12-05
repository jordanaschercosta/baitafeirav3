<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reagendamento de Evento</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background:#f7f7f7; padding:20px;">

    <div style="max-width:600px; margin:0 auto; background:#fff; padding:20px; border-radius:10px;">

        {{-- LOGO OPCIONAL --}}
        {{-- 
        <div style="text-align:center; margin-bottom:20px;">
            <img src="{{ $logo }}"
                alt="Baita Feira"
                style="max-width:180px;width:100%;height:auto;">
        </div> 
        --}}

        <h2 style="text-align:center;">Olá, {{ $nome }}!</h2>

        <p>
            Informamos que o evento abaixo foi <strong style="color:#e67e22;">reagendado</strong>.
            Confira as novas informações:
        </p>

        <h3>{{ $evento->titulo }}</h3>

        {{-- DATA --}}
        <p>
            📅 <strong>Nova data:</strong>
            {{ $evento->inicio }}
        </p>

        {{-- LOCAL --}}
        <p>
            📍 <strong>Novo local:</strong>
            {{ $evento->endereco }}
        </p>

        {{-- BOTÃO --}}
        <p style="text-align:center; margin:25px 0;">
            <a href="{{ route('eventos.show', $evento->slug) }}"
               style="
                    background:#e67e22;
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
            Caso você não possa comparecer na nova data,
            fique à vontade para cancelar sua inscrição.
        </p>

        <p>
            Agradecemos sua compreensão e esperamos vê-lo(a) em breve!
        </p>

        <p>— Equipe Baita Feira</p>

    </div>

</body>
</html>
