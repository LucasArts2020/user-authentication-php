<?php
require_once __DIR__ . '/../bootstrap.php';

$erro_login = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__ . '/../src/processa_login.php';
}



?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Moderno</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <form class="login-form" action="tela_login.php" method="post">

        <h2>Bem-vindo!</h2>
        <p>Faça login para continuar</p>

        <div class="input-group">
            <input type="email" id="email" name="email" placeholder="Seu e-mail" required>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Sua senha" required>
        </div>

        <div class="form-options">
            <a href="esqueceu_senha.php">Esqueceu a senha?</a>
        </div>

        <button type="submit">Entrar</button>

        <div class="separator">
            <span>ou</span>
        </div>

        <p class="register-link">Não tem uma conta? <a href="tela_registrar.php">Crie uma agora</a></p>
    </form>
</div>

</body>
</html>