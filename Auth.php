<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        
        header("Location: Login.php");
        exit();
        return false;
    }
    return true;
}
?>
