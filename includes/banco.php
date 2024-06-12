<?php 

    $banco = new mysqli("localhost:3307","root","","filmes");
    
    if($banco -> connect_error){
        die("Connection failed: ".$banco->connect_error);
    }


?>