<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/login.css" />
  <title>Login</title>
</head>

<body>
  <section class="container">
    <!-- <img src="/images/catalogofilmes.jpg" alt="images"> -->

    <?php
        session_start();
        require_once "includes\banco.php";

        
        if (isset($_SESSION['username'])) {
            header("Location: Home.php");
            exit;
        }

        
        require_once "FormLogin.php";

        
        if (isset($_POST['username']) && isset($_POST['senha'])) {
            $usuario = $_POST['username'];
            $senha = $_POST['senha'];

            
            $stmt = $banco->prepare("SELECT usuario, senha FROM usuarios WHERE usuario=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $obj_usuario = $resultado->fetch_object();

               
                if (password_verify($senha, $obj_usuario->senha)) {
                    $_SESSION['username'] = $obj_usuario->usuario;

                    header("Location: Home.php");
                    exit;
                } else {
                    echo "<div class='erroLogin'>Senha incorreta.</div>";
                }
            } else {
                echo "<div class='erroLogin'>Usuário não encontrado.</div>";
            }
            $stmt->close();
        }
        ?>
  </section>
</body>

</html>