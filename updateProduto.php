<?php 
include "util.php";
$conn = conecta();

$id_produto    = $_POST['id_produto'];
$nome          = $_POST['nome'];
$descricao     = $_POST['descricao'];
$valor_unitario= $_POST['valor_unitario'];
$qtd_estoque   = $_POST['qtd_estoque'];

$varSQL = "update produto set nome = :nome, 
               descricao = :descricao, 
               valor_unitario = :valor_unitario, 
               qtd_estoque = :qtd_estoque
           where id_produto = :id_produto";

$update = $conn->prepare($varSQL);
$update->bindParam(':nome', $nome);
$update->bindParam(':descricao', $descricao);
$update->bindParam(':valor_unitario', $valor_unitario);
$update->bindParam(':qtd_estoque', $qtd_estoque, PDO::PARAM_INT);
$update->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);

if ($update->execute()) {

   if (!empty($_FILES['imagem']['tmp_name'])) {

    $varArquivoRecebido = $_FILES['imagem']['tmp_name'];
    $varExtensaoPadrao = 'jpg'; 
    $varNovoArquivo = "imagens/produto{$id_produto}.$varExtensaoPadrao";

    if (move_uploaded_file($varArquivoRecebido, $varNovoArquivo)) {
        $sqlImg = "update produto set imagem = :imagem where id_produto = :id_produto";
        $updateImg  = $conn->prepare($sqlImg);
        $updateImg->bindParam(':imagem', $varNovoArquivo);
        $updateImg->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $updateImg->execute();
    }
}
}

header("Location: produtos.php");
exit;
?>