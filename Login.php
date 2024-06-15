<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/Cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <img class="fundo" src="imagens/fundo.jpg" alt="">
    <section>
        <img src="imagens/LOGOTIPO.png" alt="">
        <?php

        $usuario = $_POST['usuario'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmar_senha = $_POST['confirmar_senha'] ?? null;

        require_once "CadastroForm.php";

        if (is_null($usuario) && is_null($senha) && is_null($confirmar_senha)) {
            echo "<div class=\"erroCadastro\">Criar usuário...</div>";
        } elseif ($senha === $confirmar_senha) {
            require_once "Banco.php";

            $busca = $banco->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");

            if ($busca->num_rows > 0) { // Se há busca com o usuário inserido, quer dizer que já está cadastrado
                echo "<div class=\"erroCadastro\">Usuário já cadastrado...</div>";
            } else cadastrarUsuario($usuario, $senha); // Cadastra o usuário no BD
        } else echo "<div class=\"erroCadastro\">As senhas não coincidem...</div>";

        ?>
    </section>
</body>

</html>

<?php
function cadastrarUsuario($usuario, $senha) {
    require_once "Banco.php";

    $senha_hash = password_hash($senha, PASSWORD_BCRYPT); // Hash da senha para segurança

    $stmt = $banco->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha_hash);

    if ($stmt->execute()) {
        echo "<div class=\"sucessoCadastro\">Usuário cadastrado com sucesso!</div>";
    } else {
        echo "<div class=\"erroCadastro\">Erro ao cadastrar usuário...</div>";
    }

    $stmt->close();
    $banco->close();
}
?>
