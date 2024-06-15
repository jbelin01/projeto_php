<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAIW</title>
    
</head>

<body>
    <h1>Catálogo</h1>
    <div class="container">
        <?php

        require_once "banco.php";

        require_once "Header.php";


        $resp = $banco->query("SELECT * FROM produtos");
        while ($row = $resp->fetch_assoc()) {
            echo "<div class='PedidoBox'>";
            echo "<img src='imagens/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<div class='preco'>R$ " . $row['price'] . "</div>";
            echo "<div class='pedir'><a href='Pedido.php?id=" . $row['id'] . "'>Pedir</a></div>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>