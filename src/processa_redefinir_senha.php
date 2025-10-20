<?php

$sql = "SELECT id FROM usuarios WHERE token_reset_senha = ? AND token_reset_expira > NOW()";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token]);
$usuario = $stmt->fetch();

if ($usuario) {

    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);


    $sql_update = "UPDATE usuarios SET 
                   senha_hash = ?, 
                   token_reset_senha = NULL, 
                   token_reset_expira = NULL 
                   WHERE id = ?";

    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$senha_hash, $usuario['id']]);

    $sucesso = "Senha alterada com sucesso!";

} else {
    // Token expirou ou é inválido
    $erro = "Link inválido ou expirado. Por favor, solicite um novo.";
}
?>