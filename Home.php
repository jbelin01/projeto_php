<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAIW</title>
</head>

<body>
<?php
session_start();
require_once "includes/functions.php";

if (!isset($_SESSION['usuario'])) { // Corrigido para 'usuario' para consistência
    header("Location: Login.php");
    exit;
}

$filmes = getAllMovies(); // Corrigido para 'filmes' para consistência

?>
    <h1>Catálogo de Filmes:</h1>
    <?php foreach ($filmes as $filme): ?>
        <div class="filme">
            <h2><?php echo htmlspecialchars($filme['titulo']); ?></h2>
            <div class="descricao">
                <p><?php echo htmlspecialchars($filme['descricao']); ?></p>
            </div>
            
            <div class="comentarios">
                <h3>Comentários</h3>
                <?php 
                $comentarios = getComments($filme['id']);
                foreach ($comentarios as $comentario): ?>
                    <div>
                        <p><?php echo htmlspecialchars($comentario['comentario']); ?></p>
                        <?php if ($_SESSION['usuario'] == 'admin'): ?>
                            <form method="POST" action="AdminComments.php?action=delete">
                                <input type="hidden" name="id" value="<?php echo $comentario['id']; ?>">
                                <input type="submit" value="Excluir">
                            </form>
                            <form method="POST" action="AdminComments.php?action=update">
                                <input type="hidden" name="id" value="<?php echo $comentario['id']; ?>">
                                <input type="text" name="comentario" value="<?php echo htmlspecialchars($comentario['comentario']); ?>">
                                <input type="submit" value="Atualizar">
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <form method="POST" action="AdminComments.php?action=add">
                    <input type="hidden" name="filme_id" value="<?php echo $filme['id']; ?>">
                    <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                    <textarea name="comentario" required></textarea>
                    <input type="submit" value="Adicionar Comentário">
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <h2>Adicionar Novo Filme</h2>
    <form method="POST" action="addFilme.php">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br>
        <input type="submit" value="Adicionar Filme">
    </form>

</body>

</html>
