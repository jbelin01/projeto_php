<?php
session_start();
require_once "includes/functions.php";

require_once "FormCadastro.php";

$usuario = $_POST['usuario'] ?? null;
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;

if (empty($usuario) || empty($email) || empty($senha)) {
    echo "<div class=\"erroCadastro\">Preencha todos os campos.</div>";
} else {
    require_once "includes/banco.php";

    $busca = $banco->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
    $busca->bind_param("ss", $usuario, $email);
    $busca->execute();
    $result = $busca->get_result();

    if ($result->num_rows > 0) {
        echo "<div class=\"erroCadastro\">Usuário ou email já cadastrado.</div>";
    } else {
        cadastrarUsuario($usuario, $email, $senha);
    }

    $busca->close();
    $banco->close();
}

function cadastrarUsuario($usuario, $email, $senha) {
    require_once "includes/banco.php";

    $senha_hash = password_hash($senha, PASSWORD_BCRYPT); // Hash da senha para segurança

    $stmt = $banco->prepare("INSERT INTO usuarios (usuario, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $email, $senha_hash);

    if ($stmt->execute()) {
        echo "<div class=\"sucessoCadastro\">Usuário cadastrado com sucesso!</div>";
    } else {
        echo "<div class=\"erroCadastro\">Erro ao cadastrar usuário.</div>";
    }

    $stmt->close();
}
?>