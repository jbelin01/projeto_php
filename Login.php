<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <section>
        <h1>LOGIN</h1>
        <?php
        session_start();
        require_once "Banco.php";

        
        if (isset($_SESSION['username'])) {
            header("Location: Home.php");
            exit;
        }

        
        require_once "LoginForm.php";

        
        if (isset($_POST['username']) && isset($_POST['senha'])) {
            $username = $_POST['username'];
            $password = $_POST['senha'];

            
            $stmt = $banco->prepare("SELECT username, senha FROM usuarios WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $obj_usuario = $resultado->fetch_object();

               
                if (password_verify($password, $obj_usuario->senha)) {
                    $_SESSION['username'] = $obj_usuario->username;

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
