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

    function getAllMovies() {
        global $banco;
        $sql = "SELECT * FROM movies";
        $result = $banco->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function addMovie($title, $description) {
        global $banco;
        $sql = "INSERT INTO movies (title, description) VALUES (?, ?)";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("ss", $title, $description);
        return $stmt->execute();
    }
    
    function deleteMovie($id) {
        global $banco;
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    function updateMovie($id, $title, $description) {
        global $banco;
        $sql = "UPDATE movies SET title = ?, description = ? WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $id);
        return $stmt->execute();
    }
    
    function getComments($movie_id) {
        global $banco;
        $sql = "SELECT * FROM comments WHERE movie_id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function addComment($movie_id, $user_id, $comment) {
        global $banco;
        $sql = "INSERT INTO comments (movie_id, user_id, comment) VALUES (?, ?, ?)";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("iis", $movie_id, $user_id, $comment);
        return $stmt->execute();
    }
    
    function deleteComment($id) {
        global $banco;
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    function updateComment($id, $comment) {
        global $banco;
        $sql = "UPDATE comments SET comment = ? WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("si", $comment, $id);
        return $stmt->execute();
    }

?>