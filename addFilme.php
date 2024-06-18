<?php 

session_start();

require_once 'includes/functions.php';

if(!isset($_SESSION['username'])){
    header("Location: Login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];

    if(addMovie($title,$description)){
        header("Location: home.php");
    }else{
        echo "erro ao adicionar filme";
    }
}

?>