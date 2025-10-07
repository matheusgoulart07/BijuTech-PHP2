<?php
session_start();
<<<<<<< HEAD

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

=======
include "util.php";
$conn = conecta();

$produto = $_GET['id_produto'];

$vSql = "SELECT * FROM produto WHERE id_produto = :id_produto";
$select = $conn->prepare($vSql);
$select->bindParam(':id_produto', $produto, PDO::PARAM_INT);
$select->execute();

// Pega o produto (só vem 1 resultado porque é por ID)
$linha = $select->fetch(PDO::FETCH_ASSOC);

?>
>>>>>>> 78bb4e0c8b86cb900d95f58a3aec0e27ccb36f18
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
<<<<<<< HEAD
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
=======
            <th>Imagem</th>
            <th>Valor Unitário</th>
        </tr>

        <?php if ($linha): 
            while ($linha=$select->fetch()): ?>
            <tr>
                <td><?php echo $linha['nome']; ?></td>
                <td><img src="<?php echo $linha['imagem']; ?>" alt="<?php echo $linha['nome']; ?>" width="100"></td>
                <td>R$ <?php echo number_format($linha['valor_unitario'], 2, ',', '.'); ?></td>
            </tr>
        <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Produto não encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<footer class="rodape"><?php include "rodape.php" ?></footer>

>>>>>>> 78bb4e0c8b86cb900d95f58a3aec0e27ccb36f18
</body>
</html>