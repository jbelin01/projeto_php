<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    
</head>

<body>
    
    <section>
        
        <?php

        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirmar = $_POST['confirmar'] ?? null;

        

        require_once "FormCadastro.php";

        if (is_null($username) && is_null($password) && is_null($confirmar)) {
            echo "<div class=\"erroCadastro\">Criar usuario...</div>";
        } elseif ($password === $confirmar) {
            require_once "banco.php";          

            $busca = $banco->query("SELECT * FROM usuarios WHERE username = '$username'");

            if ($busca->num_rows > 0) { // Se há busca com o username inserido, quer dizer que já está cadastrado
                echo "<div class=\"erroCadastro\">username já cadastrado...</div>";
            } else cadastrarUsuario($username, $password); // Cadastra o usuário no BD
        } else echo "<div class=\"erroCadastro\">A senha não é a mesma!</div>";

        ?>
    </section>
</body>

</html>