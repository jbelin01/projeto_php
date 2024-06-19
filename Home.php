<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>

<body>

  <?php
session_start();
require_once "includes/functions.php";

if (!isset($_SESSION['usuario'])) { // Corrigido para 'usuario' para consistência
    header("Location: Login.php");
    exit;
} // Corrigido para 'filmes' para consistência

if(isset($_FILES["imagem"])){
    $titulo = $_POST['titulo'] ?? "";
    $diretor = $_POST['diretor'] ?? "";
    $ano = $_POST['ano'] ?? ""; 
    $descricao = $_POST['descricao'] ?? "";

    $imagePath = !empty($_FILES['imagem']['name']) ? $_FILES['imagem']['name'] : "";
    $imageNovo;
        if(!empty($imagePath)) {
            $caminho = "images/uploads/";
            $imageNovo = uploadMovie($caminho);
        }
        if(!empty($imageNovo)) 
        {
            addMovie($imageNovo,$titulo, $diretor, intval($ano),  $descricao);
        }
}

?>
  <h1>Catálogo de Filmes:</h1>


  <h2>Adicionar Novo Filme</h2>
  <form method="POST" enctype="multipart/form-data" action="">
    <label for="image">Imagem:</label>
    <input type="file" name="imagem" required><br>
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required><br>
    <label for="diretor">Diretor:</label>
    <input type="text" name="diretor" required><br>
    <label for="ano">Ano de lançamento:</label>
    <input type="number" name="ano" required><br>
    <label for="descricao">Sinopse:</label>
    <textarea name="descricao" required></textarea><br>
    <input type="submit" value="Adicionar Filme">
  </form>


  <?php  
    $filmes = getAllMovies();

    foreach($filmes as $filme) ?>
  <tr>
    <td>
      <img src="images/uploads/<?php echo $filme['imagem']; ?>">
    </td>
  </tr>

</body>

</html>