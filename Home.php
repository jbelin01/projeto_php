<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAIW</title>
    
</head>

<body>
    <h1>Catálogo</h1>
    <div class="container">
    <?php
session_start();
require_once "functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit;
}

$movies = getAllMovies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Filmes</title>
    <style>
        .movie {
            margin-bottom: 20px;
        }
        .description, .comments {
            display: none;
        }
    </style>
    <script>
        function toggleDescription(movieId) {
            var desc = document.getElementById('desc-' + movieId);
            desc.style.display = desc.style.display === 'none' ? 'block' : 'none';
        }

        function toggleComments(movieId) {
            var comments = document.getElementById('comments-' + movieId);
            comments.style.display = comments.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h1>Catálogo de Filmes</h1>
    <?php foreach ($movies as $movie): ?>
        <div class="movie">
            <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
            <button onclick="toggleDescription(<?php echo $movie['id']; ?>)">Saiba mais</button>
            <div id="desc-<?php echo $movie['id']; ?>" class="description">
                <p><?php echo htmlspecialchars($movie['description']); ?></p>
            </div>
            <button onclick="toggleComments(<?php echo $movie['id']; ?>)">Comentários</button>
            <div id="comments-<?php echo $movie['id']; ?>" class="comments">
                <h3>Comentários</h3>
                <?php 
                $comments = getComments($movie['id']);
                foreach ($comments as $comment): ?>
                    <div>
                        <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                        <?php if ($_SESSION['username'] == 'admin'): // Admin privileges ?>
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
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <textarea name="comment" required></textarea>
                    <input type="submit" value="Adicionar Comentário">
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>

    </div>
</body>

</html>