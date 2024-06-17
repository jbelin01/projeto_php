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
        $confirmar_senha = $_POST['confirmara'] ?? null;

        require_once "FormForgot.php";

        if (is_null($cpf) && is_null($senha) && is_null($confirmar_senha)) {
            echo "<div class=\"erroAlterar\">Criar usuario...</div>";
        } elseif ($senha === $confirmar_senha) {
            require_once "Banco.php";

            $busca = $banco->query("SELECT * FROM usuarios WHERE cpf = '$cpf'");

            if ($busca->num_rows > 0) {
                $obj_usuario = $busca->fetch_object();

                if ($cpf === $obj_usuario->cpf) {
                    alterarSenhaUsuario($cpf, $senha);
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