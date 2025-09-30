<?php
session_start();

// Inicializando o carrinho 
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$id = $_GET['id_produto'] ;
$nome = $_GET['nome'] ;
$imagem = $_GET['imagem'] ;

//Vetor do carrinho
$_SESSION['carrinho'][] = [
    'id' => $id,
    'nome' => $nome,
    'imagem' => $imagem
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "cabecalho.php" ?>
<div class="pagina-carrinho">
    <h1 class="heading"><span>Carrinho</span></h1>

    <table>
        <tr>
            <th>Produto</th>
        </tr>

        <?php
        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                echo "
                <tr>
                    <td>
                        <div class='info-carrinho'>
                        <img src='imagens/{$item['imagem']}' alt='{$item['nome']}'>
                            <div>
                                <p>{$item['nome']}</p>
                                <a href='remover.php?id={$item['id']}'>Remover</a>
                            </div>
                        </div>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td>Nenhum produto no carrinho.</td></tr>";
        }
        ?>
    </table>
</div>
<?php include "rodape.php" ?>
</body>
</html>