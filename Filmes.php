<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/filmes.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <title>Home</title>
</head>

<body class="bodyContainer">


  <?php
  require_once 'Auth.php';
  $auth = checkLogin();  
  if($auth = false){
    header("Location: Login.php");
  }
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
  <main class="mainContainer">


    <header>
      <h1>Meus Filmes</h1>
      <div>
        <p class="d-inline-flex gap-1">
          <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            Adicionar filme
          </button>
        </p>
        <form action="logout.php" method="post">
          <button type="submit" class="btn btn-danger">Logout</button>
          <!-- <input type="submit" value="Logout"> -->
        </form>
      </div>
    </header>



    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <h4>Adicionar filme</h4>
        <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            <label for="formFile" class="form-label">Adicione uma imagem:</label>
            <input class="form-control" type="file" name="imagem" required>
          </div>

          <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" name="titulo" placeholder="Título" required>
          </div>

          <div class="mb-3">
            <label for="diretor" class="form-label">Diretor:</label>
            <input type="text" class="form-control" name="diretor" placeholder="Diretor" required>
          </div>

          <div class="mb-3">
            <label for="ano" class="form-label">Ano de lançamento:</label>
            <input type="number" class="form-control" name="ano" placeholder="Ano de lançamento" required>
          </div>

          <div class="mb-3">
            <label for="descricao" class="form-label">Sinopse:</label>
            <textarea class="form-control" name="descricao" rows="3"></textarea>
          </div>

          <input type="submit" value="Adicionar Filme">
        </form>
      </div>
    </div>




    <?php  
    $filmes = getAllMovies();

// Passo 2: Definir uma Função de Renderização
function renderListItem($item) {

    return "<li class='listaFilmes'>
        <img height='500px' width='500px' src='images/uploads/{$item['imagem']}' />
        <h4>{$item['titulo']}</h4>
        
        <p>Ano lançamento: {$item['ano']}</p>
        <p>Diretor: {$item['diretor']}</p>
        <p>Sinopse: {$item['descricao']}</p>
    </li>";
}

// Passo 3: Usar array_map para Renderizar as Tags HTML
$listItems = array_map("renderListItem", $filmes);

// Passo 4: Juntar os Itens Renderizados em uma String
$listItemsString = implode("", $listItems);

// Passo 5: Envolver os Itens em uma Tag de Lista
$htmlList = "<ul>{$listItemsString}</ul>";

// Imprimir a Lista HTML
echo $htmlList;

?>


  </main>
</body>

</html>