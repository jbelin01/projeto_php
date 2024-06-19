<?php

session_start();
require_once "includes/functions.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST['usuario'];
    $descricao = $_POST['email'];
    $senha = $_POST['senha'];
    if(registerUser($titulo,$descricao,$senha)){
        header('Location: Login.php');
        exit();
    }else{
        echo "erro ao registrar usuario";
    }
}

require_once "FormCadastro.php";
?>