<?php

require_once __DIR__ . '/../bootstrap.php';
$erro = null;
$mensagem_sucesso = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__ . '/../src/processa_esqueci_senha.php';
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <form class="login-form" action="esqueceu_senha.php" method="post">

        <h2>Recuperar Senha</h2>

        <?php if ($mensagem_sucesso): ?>

            <p style="color: green; margin-bottom: 15px;"><?php echo htmlspecialchars($mensagem_sucesso); ?></p>
            <p><a href="tela_login.php">Voltar ao Login</a></p>

        <?php elseif ($erro): ?>

            <p style="color: red; margin-bottom: 15px;"><?php echo htmlspecialchars($erro); ?></p>

        <?php endif; ?>

        <?php if (!$mensagem_sucesso): ?>

            <p>Digite seu e-mail para receber um link de recuperação.</p>

            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
            </div>

            <button type="submit">Enviar Link</button>

            <div class="separator">
                <span>ou</span>
            </div>

            <p class="register-link">Lembrou a senha? <a href="tela_login.php">Voltar ao login</a></p> <?php endif; ?>

    </form>
</div>

</body>
</html>