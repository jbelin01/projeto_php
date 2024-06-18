<?php

$dbname = "filme_catalogos";


$banco = new mysqli("localhost:3307", "root", "", $dbname);


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($banco->query($sql) === true) {
    echo "Banco criado com sucesso<br>";
}

$banco->select_db($dbname);

// Criar a tabela de usuários
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela de usuários criada com sucesso<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS comentarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(6) UNSIGNED NOT NULL,
    comentario TEXT NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabela de comentários criada com sucesso<br>";
}


?>
