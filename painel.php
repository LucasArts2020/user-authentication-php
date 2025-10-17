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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="panel-container">
    <h1>Bem-vindo ao seu Painel!</h1>

    <p>Seu e-mail é: <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p>

    <a href="logout.php" class="logout-btn">Sair</a>
</div>

</body>
</html>
</html>