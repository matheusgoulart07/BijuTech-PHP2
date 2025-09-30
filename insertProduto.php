<?php 
include "util.php";
$conn = conecta();

$varSQL = "insert into produto (nome, descricao, valor_unitario, qtd_estoque, imagem, excluido) 

values (:nome, :descricao, :valor_unitario, :qtd_estoque, :imagem, false)";

$insert = $conn->prepare($varSQL);

$insert->bindParam(':nome', $_POST['nome']);
$insert->bindParam(':descricao', $_POST['descricao']);
$insert->bindParam(':valor_unitario', $_POST['valor_unitario']);
$insert->bindParam(':qtd_estoque', $_POST['qtd_estoque'], PDO::PARAM_INT);

$caminhoImagem = null; 
$insert->bindParam(':imagem', $caminhoImagem);

if ($insert->execute()) {
 
    $id = $conn->lastInsertId("produto_id_produto_seq");

    if ($_FILES && isset($_FILES['imagem'])) {
        $varArquivoRecebido = $_FILES['imagem']['tmp_name'];
        $varExtensaoPadrao = 'jpg'; 
        $varNovoArquivo = "imagens/produto$id.$varExtensaoPadrao";

        if (move_uploaded_file($varArquivoRecebido, $varNovoArquivo)) {

            $update = $conn->prepare("update produto set imagem = :imagem where id_produto = :id");
            $update->bindParam(':imagem', $varNovoArquivo);
            $update->bindParam(':id', $id, PDO::PARAM_INT);
            $update->execute();
        }
    }
}

header("Location: produtos.php");
exit;
?>