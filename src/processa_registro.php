<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();


if ($_SERVER['REQUEST_METHOD']== 'POST'){
    require_once 'conexaobd.php';


    $email = $_POST['email'];
    $senhaPura = $_POST['password'];
    $senha_hash = password_hash($senhaPura, PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(32));

    try{
        $sql= "INSERT INTO usuarios (email, senha_hash, token_verificacao) VALUES (:email, :senha, :token)";
        $stmt  = $pdo -> prepare($sql);

        $stmt ->bindParam(':email', $email);
        $stmt ->bindParam(':senha', $senha_hash);

        $stmt->bindParam(':token', $token);

        if ($stmt->execute()){

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host=$_ENV['SMTP_HOST'];
                $mail->SMTPAuth= true;
                $mail->Username = $_ENV['SMTP_USER'];
                $mail->Password = $_ENV['SMTP_PASS'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = (int)$_ENV['SMTP_PORT'];
                $mail->CharSet = 'UTF-8';

                $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
                $mail->addAddress($email, $email);

                $mail->isHTML(true);

                $mail->Subject = 'Verifique sua conta';

                $link_verificacao = "http://localhost/untitled3/verificar_email.php?token=" . $token;

                $mail->Body    = "Olá!<br><br>Obrigado por se cadastrar. Por favor, clique no link abaixo para verificar seu e-mail:<br><br>" .
                                    "<a href='$link_verificacao'>Verificar E-mail</a>";
                $mail->AltBody = "Copie e cole este link no seu navegador para verificar seu e-mail: " . $link_verificacao;

                $mail->send();

                echo "<h1>Cadastro quase completo!</h1>";
                echo "<p>Enviamos um link de verificação para <strong>" . htmlspecialchars($email) . "</strong>.</p>";
                echo "<p>Por favor, verifique sua caixa de entrada (e spam) para ativar sua conta.</p>";
                echo '<a href="../public/tela_login.php">Ir para o Login</a>'; //

            } catch (Exception $e){
                echo "Erro ao enviar e-mail: {$mail->ErrorInfo}. <br> Tente se registrar novamente mais tarde.";
            }





            echo "<h1>Cadastro realizado com sucesso!</h1>";
            echo "<p>Bem-vindo, " . htmlspecialchars($email) . "!</p>";
            echo '<a href="../public/tela_login.php">Voltar ao formulário</a>';
        }
        else{
            echo 'erro';
        }

    }catch (PDOException $e) {

        if ($e->getCode() == 23000) {
            echo "Erro: Este e-mail já está cadastrado. Tente outro.";
        } else {
            echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        }
    }
};

$pdo= null;