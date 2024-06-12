<?php 
    include 'banco.php';

    function registerUser($username,$password){
        global $banco;
        $passwordHash = password_hash($password,PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        $stmt = $banco->prepare($sql);
        $stmt->bind_param("ss",$username,$passwordHash);
        return $stmt->execute(); 
    }

    function loginUser($username,$password){
        global $banco;
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $banco->prepare($sql);
        $stmt -> bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if(password_verify($password,$user["password"])){
                return $user;
            }
        }
        return false;
    }

?>