<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
</head>
<body>
    <h2>Olá, {{ $nome }}!</h2>
    <p>Você solicitou a redefinição da sua senha.</p>
    <p>Clique no link abaixo para criar uma nova senha:</p>
    <p><a href="{{ $link }}">Redefinir senha</a></p>
    <p>Se você não solicitou isso, ignore este e-mail.</p>
    <p>Atenciosamente,<br>Equipe Baita Feira</p>
</body>
</html>