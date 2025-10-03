<?php
session_start();
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

</body>
</html>