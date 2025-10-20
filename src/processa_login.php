<?php

$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['password']);

$sql = "SELECT id, email, senha_hash, email_verificado_em FROM usuarios WHERE email = ?";
$stmt = $pdo ->prepare($sql);
$stmt -> execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario['senha_hash'])){
    if ($usuario['email_verificado_em'] != NULL) {
        session_start(); //
        $_SESSION['user_id'] = $usuario['id']; //
        $_SESSION['user_email'] = $usuario['email']; //

        header("Location: painel.php"); //
        exit();

        } else {

               $erro_login = "Você precisa verificar seu e-mail antes de fazer login.";
            }

    } else {

            $erro_login = "E-mail ou senha inválido.";
        }

