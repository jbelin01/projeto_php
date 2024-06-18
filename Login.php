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
    <?php
      session_start();

      require_once "banco.php";

      //require_once "Header.php";

      if (isset($_SESSION['usuario'])) {
          header("Location: Home.php");
          exit;
      }

      require_once "FormLogin.php";
      if (isset($_POST['usuario']) && isset($_POST['senha'])) {
          $usuario = $_POST['usuario'];
          $senha = $_POST['senha'];

          $stmt = $banco->prepare("SELECT usuario, email, senha FROM usuarios WHERE nome=?");
          $stmt->bind_param("s", $usuario);
          $stmt->execute();
          $resultado = $stmt->get_result();

          if ($resultado->num_rows > 0) {
              $obj_usuario = $resultado->fetch_object();

              if (password_verify($senha, $obj_usuario->senha)) {
                  $_SESSION['usuario'] = $obj_usuario->usuario;
                  $_SESSION['email'] = $obj_usuario->email;

                  header("Location: Home.php");
                  exit;
              } else echo "Senha incorreta.";
          } else echo "Usuário não encontrado.";
          $stmt->close();
        }
    ?>
  </section>
</body>

</html>
