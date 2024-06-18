<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    
</head>

<body>
    
    <section>
        
        <?php

        $usuario = $_POST['usuario'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmar = $_POST['confirmar'] ?? null;

        require_once "FormCadastro.php";

        if (is_null($usuario) && is_null($senha) && is_null($confirmar)) {
            echo "<div class=\"erroCadastro\">Criar usuário...</div>";
        } elseif ($senha === $confirmar_senha) {
            require_once "includes/banco.php";

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
    require_once "includes/banco.php";

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
