<?php 
session_start();
include "util.php"; 
$conn = conecta();

$varSQL = "select * from produto where excluido = false";
$select = $conn->query($varSQL);
verifica($_SESSION['admin']);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/style.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
</head>
<body>

<?php include "cabecalho.php" ?>

<main class="pagina-crud pagina-produtos">
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

<a href="adicionarProduto.php" class="btn btn-add">Adicionar Produto</a>
</main>

<footer class="rodape"><?php include "rodape.php" ?></footer>
<script src="js/script.js"></script>

</body>
</html>