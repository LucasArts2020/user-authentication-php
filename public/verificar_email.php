<?php

require_once __DIR__ . '/../bootstrap.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];


    $sql = "SELECT id FROM usuarios WHERE token_verificacao = ? AND email_verificado_em IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    $usuario = $stmt->fetch();

    if ($usuario) {

        $sql_update = "UPDATE usuarios 
                       SET email_verificado_em = NOW(), token_verificacao = NULL 
                       WHERE id = ?";

        $stmt_update = $pdo->prepare($sql_update);
        if ($stmt_update->execute([$usuario['id']])) {
            echo "<h1>E-mail verificado com sucesso!</h1>";
            echo '<p>Sua conta está ativa. Você já pode fazer login.</p>';
            echo '<a href="tela_login.php">Ir para o Login</a>';
        } else {
            echo "<h1>Erro!</h1><p>Não foi possível verificar sua conta. Tente novamente mais tarde.</p>";
        }

    } else {

        echo "<h1>Link inválido ou expirado.</h1>";
        echo "<p>Este link de verificação não é válido ou sua conta já foi ativada.</p>";
    }

} else {
    header("Location: tela_login.php");
    exit();
}
