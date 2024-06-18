<?php

$dbname = "filme_catalogos";

// Conectar ao MySQL sem especificar o banco de dados
$banco = new mysqli("localhost:3307", "root", "");

// Verificar conexão
if ($banco->connect_error) {
    die("Falha na conexão: " . $banco->connect_error);
}

// Criar o banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($banco->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso<br>";
} else {
    echo "Erro ao criar banco de dados: " . $banco->error . "<br>";
}

// Selecionar o banco de dados
$banco->select_db($dbname);

// Criar a tabela de usuários
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($banco->query($sql) === TRUE) {
    echo "Tabela de usuários criada com sucesso<br>";
} else {
    echo "Erro ao criar tabela de usuários: " . $banco->error . "<br>";
}

// Criar a tabela de comentários
$sql = "CREATE TABLE IF NOT EXISTS comentarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(6) UNSIGNED NOT NULL,
    comentario TEXT NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";
if ($banco->query($sql) === TRUE) {
    echo "Tabela de comentários criada com sucesso<br>";
} else {
    echo "Erro ao criar tabela de comentários: " . $banco->error . "<br>";
}

// Fechar conexão
$banco->close();

?>
