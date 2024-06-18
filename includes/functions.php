<?php 
    include 'banco.php';

    function registerUser($usuario,$email,$senha){
        global $banco;
        $passwordHash = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (usuario, email, senha) VALUES (?,?,?)";

        $stmt = $banco->prepare($sql);
        $stmt->bind_param("sss",$usuario, $email,$passwordHash);
        return $stmt->execute();
    }

    function loginUser($usuario, $senha) {
        global $banco;
        $sql = "SELECT id, usuario, email, senha FROM usuarios WHERE usuario = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_db, $email, $hashed_password);
        
        while ($stmt->fetch()) {
            if (password_verify($senha, $hashed_password)) {
                return [
                    'id' => $id,
                    'usuario' => $usuario_db,
                    'email' => $email
                ];
            }
        }
        
        return false;
    }

    function getAllMovies() {
        global $banco;
        $sql = "SELECT * FROM filmes";
        $result = $banco->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function addMovie($titulo, $descricao) {
        global $banco;
        $sql = "INSERT INTO filmes (titulo, descricao) VALUES (?, ?)";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("ss", $titulo, $descricao);
        return $stmt->execute();
    }
    
    function deleteMovie($id) {
        global $banco;
        $sql = "DELETE FROM filmes WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    function updateMovie($id, $titulo, $descricao) {
        global $banco;
        $sql = "UPDATE filmes SET titulo = ?, descricao = ? WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("ssi", $titulo, $descricao, $id);
        return $stmt->execute();
    }
    
    function getComments($filme_id) {
        global $banco;
        $sql = "SELECT * FROM comentarios WHERE filme_id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $filme_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function addComment($filme_id, $usuario_id, $comentario) {
        global $banco;
        $sql = "INSERT INTO comentarios (filme_id, usuario_id, comentario) VALUES (?, ?, ?)";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("iis", $filme_id, $usuario_id, $comentario);
        return $stmt->execute();
    }
    
    function deleteComment($id) {
        global $banco;
        $sql = "DELETE FROM comentarios WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    function updateComment($id, $comentario) {
        global $banco;
        $sql = "UPDATE comentarios SET comentario = ? WHERE id = ?";
        $stmt = $banco->prepare($sql);
        $stmt->bind_param("si", $comentario, $id);
        return $stmt->execute();
    }

?>