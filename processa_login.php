<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $nome = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);

};
