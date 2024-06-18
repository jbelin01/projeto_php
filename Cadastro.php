<?php
session_start();
require_once "includes/functions.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    if(registerUser($usuario,$email,$senha)){
        header('Location. Login.php?success=1');
        exit();
    }else{
        echo "erro ao registrar usuario";
    }
}

require_once "FormCadastro.php";
?>