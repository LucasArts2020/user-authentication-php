<?php


session_start();


if (!isset($_SESSION['user_id'])) {

    header("Location: login.html");
    exit();
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Usuário</title>
</head>
<body>
    <h1>Bem-vindo ao seu Painel!</h1>
    <p>Seu e-mail é: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>