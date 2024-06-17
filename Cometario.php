<?php
session_start();
require_once "functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit;
}

$action = $_GET['action'] ?? '';

if ($action == 'add') {
    $movie_id = $_POST['movie_id'];
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];
    if (addComment($movie_id, $user_id, $comment)) {
        echo "Comentário adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar comentário.";
    }
} elseif ($action == 'delete') {
    $id = $_POST['id'];
    if (deleteComment($id)) {
        echo "Comentário removido com sucesso.";
    } else {
        echo "Erro ao remover comentário.";
    }
} elseif ($action == 'update') {
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    if (updateComment($id, $comment)) {
        echo "Comentário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar comentário.";
    }
}

header("Location: Home.php");
exit;
?>
