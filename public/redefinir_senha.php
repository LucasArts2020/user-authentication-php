<?php
require_once __DIR__ . '/../bootstrap.php';

$token = null;
$erro = null;
$sucesso = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $token = $_POST['token'];
    $nova_senha = $_POST['password'];
    $confirma_senha = $_POST['password_confirm'];

    if ($nova_senha !== $confirma_senha) {
        $erro = "As senhas não conferem.";
    } else {
        require __DIR__ . '/../src/processa_redefinir_senha.php';
    }
}

else if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT id FROM usuarios WHERE token_reset_senha = ? AND token_reset_expira > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        $erro = "Link inválido ou expirado. Por favor, solicite um novo.";
        $token = null;
    }

} else {
    $erro = "Nenhum token fornecido."; //
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
<div class="login-container">
    <form class="login-form" action="redefinir_senha.php" method="POST">
        <h2>Redefina sua Senha</h2>

        <?php if ($sucesso): ?>
            <p style="color: green;"><?php echo $sucesso; ?></p>
            <p><a href="tela_login.php">Ir para o Login</a></p>
        <?php elseif ($erro): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <?php if ($token && !$sucesso): ?>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="input-group">
                <input type="password" name="password" placeholder="Nova Senha" required>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirm" placeholder="Confirmar Nova Senha" required>
            </div>
            <button type="submit">Alterar Senha</button>
        <?php endif; ?>

    </form>
</div>
</body>
</html>