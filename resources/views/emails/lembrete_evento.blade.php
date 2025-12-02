<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lembrete de Evento</title>
</head>
<body>

    <h2>Olá, {{ $nome }}!</h2>

    <p>Este é um lembrete do evento que você se inscreveu:</p>

    <h3>{{ $evento->titulo }}</h3>

    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}</p>

    <p><strong>Horário:</strong> {{ $evento->horario }}</p>

    <p><strong>Local:</strong> {{ $evento->local }}</p>

    <p><strong>Descrição:</strong> {{ $evento->descricao }}</p>

    {{-- ✅ LINK DO EVENTO --}}
    <p>
        <a href="{{ route('eventos.show', $evento->slug) }}"
        style="
                background:#000;
                color:#fff;
                padding:10px 15px;
                border-radius:5px;
                text-decoration:none;
                display:inline-block;
            ">
            Ver detalhes do evento
        </a>
    </p>

    <p>
        Não perca! Esperamos você no evento 😊
    </p>

    <p>— Equipe</p>

</body>
</html>
