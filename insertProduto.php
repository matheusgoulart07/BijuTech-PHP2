<?php 
include "util.php";
$conn = conecta();

$varSQL = "INSERT INTO produto (nome, descricao, valor_unitario, qtd_estoque, imagem, excluido) 
           VALUES (:nome, :descricao, :valor_unitario, :qtd_estoque, :imagem, false)";

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
        $nomeOriginal = basename($_FILES['imagem']['name']); // nome original do arquivo
        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION); // extensão original
        $extensao = strtolower($extensao);

        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($extensao, $extensoesPermitidas)) {
            $novoNome = pathinfo($nomeOriginal, PATHINFO_FILENAME);
            $novoNome = preg_replace('/[^a-zA-Z0-9_-]/', '_', $novoNome); 
            $varNovoArquivo = "imagens/" . $novoNome . "_$id." . $extensao;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $varNovoArquivo)) {
                $update = $conn->prepare("UPDATE produto SET imagem = :imagem WHERE id_produto = :id");
                $update->bindParam(':imagem', $varNovoArquivo);
                $update->bindParam(':id', $id, PDO::PARAM_INT);
                $update->execute();
            }
        }
    }
}

header("Location: produtos.php");
exit;
?>