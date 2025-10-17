<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    require_once 'conexaobd.php';


    $email = $_POST['email'];
    $senhaPura = $_POST['password'];
    $senha_hash = password_hash($senhaPura, PASSWORD_DEFAULT);

    try{
        $sql= "INSERT INTO usuarios (email, senha_hash) VALUES (:email, :senha)";
        $stmt  = $pdo -> prepare($sql);

        $stmt ->bindParam(':email', $email);
        $stmt ->bindParam(':senha', $senha_hash);

        if ($stmt->execute()){
            echo "<h1>Cadastro realizado com sucesso!</h1>";
            echo "<p>Bem-vindo, " . htmlspecialchars($email) . "!</p>";
            echo '<a href="formulario.html">Voltar ao formulário</a>';
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