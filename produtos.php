<?php 
session_start();
include "util.php"; 
$conn = conecta();

$varSQL = "select * from produto";
$select = $conn->query($varSQL);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "cabecalho.php" ?>

<h2>Lista de Produtos</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Valor Unitário</th>
            <th>Qtd Estoque</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($linha = $select->fetch()) {
            $id = $linha['id_produto'];

            echo "<tr>
                <td>".$linha['nome']."</td>
                <td>".$linha['descricao']."</td>
                <td>".$linha['valor_unitario']."</td>
                <td>".$linha['qtd_estoque']."</td>
                <td>";

            if (!empty($linha['imagem'])) {
                echo "<img src='".$linha['imagem']."' width='80'>";
            }

            echo "</td>
                <td>
                    <a href='alterarProduto.php?id_produto=$id'>Alterar</a>
                    <a href='excluirProduto.php?id_produto=$id'>Excluir</a>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<a href="adicionarProduto.php">Adicionar Produto</a>

<?php include "rodape.php" ?>

</body>
</html>