<!DOCTYPE html>
<html lang="pt-br">

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

        $cpf = $_POST['cpf'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $confirmar_senha = $_POST['confirmar_senha'] ?? null;

        require_once "EsqueciSenhaForm.php";

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