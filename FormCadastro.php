<form action="Login.php" method="post">
    <h1>CADASTRO</h1>
    <div>
        <label for="username">usuario:</label>
        <input type="text" id="username" name="username" required>
    </div>


    <div>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>

    <div>
        <label for="confirmar">Conrfime sua senha:</label>
        <input type="password" id="confirmar" name="confirmar" required>
    </div>

    <div class="enviar">
        <input type="submit" value="Enviar"></input>
    </div>
</form>