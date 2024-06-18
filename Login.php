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
        require_once 'includes/functions.php';
        require_once 'FormLogin.php';
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario']; // Corrigido para 'usuario' para consistência
            $senha = $_POST['senha'];
            $user = loginUser($usuario, $senha);
            if ($user) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario'] = $user['usuario']; // Adicionado para consistência com home.php
                header('Location: Home.php');
                exit;
            } else {
                echo "Usuário ou senha inválidos.";
            }
        }
    ?>
  </section>
</body>

</html>
