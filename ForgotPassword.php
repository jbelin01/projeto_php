<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    
</head>

<body>
    
    <section>
        
        <?php

        $cpf = $_POST['username'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmar = $_POST['confirmar'] ?? null;

        require_once "FormForgot.php";

        if (is_null($username) && is_null($password) && is_null($confirmar)) {
            echo "<div class=\"erroAlterar\">Criar usuario...</div>";
        } elseif ($password === $confirmar) {
            require_once "Banco.php";

            $busca = $banco->query("SELECT * FROM usuarios WHERE username = '$username'");

            if ($busca->num_rows > 0) {
                $obj_usuario = $busca->fetch_object();

                if ($username === $obj_usuario->username) {
                    alterarsenhaUsuario($username, $password);
                    header("Location: Login.php");
                }
            } else {
                echo "<div class=\"erroAlterar\">Criar usuario...</div>";
            }
        }
        ?>
    </section>
</body>

</html>