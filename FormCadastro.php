<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    
    <section>
        
        <h2>Cadastro de Usuário</h2>
        
        <form method="POST" action="cadastro.php">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br>
            <br>
            <input type="submit" value="Cadastrar">
            <br> 
            <a href="Login.php">Já possui uma conta? Faça login</a>
        </form>
        
    </section>

</body>

</html>
