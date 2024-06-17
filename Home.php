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
require_once "<includes>functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit;
}

$movies = getAllMovies();

?>
    <h1> Catálogo de Filmes: </h1>
    <?php foreach ($movies as $movie): ?>
        <div class="movie">
            <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
            <div class="description">
                <p><?php echo htmlspecialchars($movie['description']); ?></p>
            </div>
            
            <div class="comments">
                <h3>Comentários</h3>
                <?php 
                $comments = getComments($movie['id']);
                foreach ($comments as $comment): ?>
                    <div>
                        <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                        <?php if ($_SESSION['username'] == 'admin'): ?>
                            <form method="POST" action="AdminComments.php?action=delete">
                                <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
                                <input type="submit" value="Excluir">
                            </form>
                            <form method="POST" action="AdminComments.php?action=update">
                                <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
                                <input type="text" name="comment" value="<?php echo htmlspecialchars($comment['comment']); ?>">
                                <input type="submit" value="Atualizar">
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <form method="POST" action="AdminComments.php?action=add">
                    <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                    <!-- Utilizando o nome de usuário da sessão como identificação do usuário -->
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <textarea name="comment" required></textarea>
                    <input type="submit" value="Adicionar Comentário">
                </form>
            </div>
        </div>
    <?php endforeach; ?>


    
</body>

</html>
