<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/register.css">
  <title>Cadastro</title>
</head>

<body>

  <section class="container">
    <form method="POST">
      <h2>Cadastro de Usuário</h2>
      <!-- <label for="usuario">Usuário:</label> -->
      <div class="content">
        <input type="text" placeholder="Nome do usário" id="usuario" name="usuario" required>
        <input type="email" placeholder="E-mail" id="email" name="email" required>
        <input type="password" placeholder="Senha" id="senha" name="senha" required>
        <div class="enviar">
          <input type="submit" value="Cadastrar">
          <p>
            Já possui uma conta?
            <a href="Login.php"> Faça login</a>
          </p>
        </div>
      </div>
    </form>

  </section>

</body>

</html>