<?php

require "conexaobd.php";

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['password']);

        $sql = "SELECT id, email, senha_hash FROM usuarios WHERE email = ?";

        $stmt = $pdo ->prepare($sql);
        $stmt -> execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha_hash'])){
            session_start();
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_email'] = $usuario['email'];

            header("Location: painel.php");
            var_dump($_SESSION);
            exit();

        } else{
            echo "email ou senha invalido";
        }

    } else{
    header("Location:tela_login.php");
    exit();
}

