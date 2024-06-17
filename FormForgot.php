<form action="ForgotPassword.php" method="post">
    <h1>Alterar Senha</h1>
    <div>
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div>
        <label for="senha">Nova Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>

    <div>
        <label for="confirmar">Confirmar Senha:</label>
        <input type="password" id="confirmar" name="confirmar" required>
    </div>

    <div class="enviar">
        <input type="submit" value="Enviar"></input>
    </div>
</form>