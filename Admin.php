<?php
session_start();
require_once "includes/functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit;
}

$action = $_GET['action'] ?? '';


$username = $_SESSION['username'];

if ($action == 'add') {
    $movie_id = $_POST['movie_id'];
    $comment = $_POST['comment'];
    if (addComment($movie_id, $username, $comment)) { 
        echo "Comentário adicionado!";
    } else {
        echo "Erro ao adicionar comentário.";
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    if (deleteComment($id, $username)) { 
        echo "Comentário removido!";
    } else {
        echo "Erro ao remover comentário.";
    }
} elseif ($action == 'update') {
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    if (updateComment($id, $comment, $username)) { 
        echo "Comentário atualizado!";
    } else {
        echo "Erro ao atualizar comentário.";
    }
}

header("Location: Home.php");
exit;
?>
