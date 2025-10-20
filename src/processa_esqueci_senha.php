<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$email = $_POST['email'];


$sql_select = "SELECT id FROM usuarios WHERE email = ?";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->execute([$email]);
$usuario = $stmt_select->fetch();


if ($usuario) {
    try {
        $token = bin2hex(random_bytes(32));
        $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $sql_update = "UPDATE usuarios SET token_reset_senha = ?, token_reset_expira = ? WHERE email = ?";
        $stmt_update = $pdo->prepare($sql_update);

        $stmt_update->execute([$token, $expiracao, $email]);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = (int)$_ENV['SMTP_PORT'];
        $mail->CharSet = 'UTF-8';
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($email, $email);
        $mail->isHTML(true);

        $mail->Subject = 'Redefinição de Senha';
        $link_verificacao = "http://localhost/untitled3/public/redefinir_senha.php?token=" . $token;
        $mail->Body    = "Olá!<br><br>Recebemos uma solicitação para redefinir sua senha. Se foi você, clique no link abaixo (válido por 1 hora):<br><br>" .
            "<a href='$link_verificacao'>Redefinir Minha Senha</a>";
        $mail->AltBody = "Copie e cole este link no seu navegador para redefinir sua senha: " . $link_verificacao;

        $mail->send();


    } catch (Exception $e) {
        $erro = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}

$mensagem_sucesso = "Se este e-mail estiver em nosso sistema, um link de recuperação foi enviado.";

