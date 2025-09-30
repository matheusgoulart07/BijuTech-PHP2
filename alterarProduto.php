<html>
<body>
<?php 
include "util.php";
$conn = conecta();

$id_produto = $_GET['id_produto'];

$varSQL = "select * from produto where id_produto = :id_produto";
$select = $conn->prepare($varSQL);
$select->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$select->execute();

$linha = $select->fetch();

$nome = $linha['nome'];
$descricao = $linha['descricao'];
$valor_unitario = $linha['valor_unitario'];
$qtd_estoque = $linha['qtd_estoque'];
$varFoto = $linha['imagem'];

$htmlFoto = (!empty($varFoto) && file_exists($varFoto)) 
    ? "<img src='$varFoto' width='100'>" 
    : "";
?>

<form action="updateProduto.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_produto" value="<?php echo htmlspecialchars($id_produto); ?>">

    Nome:
    <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>

    Descrição:
    <textarea name="descricao"><?php echo htmlspecialchars($descricao); ?></textarea><br><br>

    Valor unitário:
    <input type="number" step="0.01" name="valor_unitario" value="<?php echo htmlspecialchars($valor_unitario); ?>"><br><br>

    Quantidade em estoque:
    <input type="number" name="qtd_estoque" value="<?php echo htmlspecialchars($qtd_estoque); ?>"><br><br>

    <?php if ($htmlFoto): ?>
        Imagem atual:<br>
        <?php echo $htmlFoto; ?><br><br>
    <?php endif; ?>

    Substituir imagem:<br>
    <input type="file" name="imagem" accept="image/*"><br><br>

    <button type="submit">Salvar Alterações</button>
</form>
</body>
</html>