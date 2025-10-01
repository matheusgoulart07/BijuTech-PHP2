<?php 
include "util.php";
$conn = conecta();

$varSQL = "insert into usuario (nome, email, senha, telefone, excluido) 

values (:nome, :email, :senha, :telefone, false)";

$insert = $conn->prepare($varSQL);

$insert->bindParam(':nome', $_POST['nome']);
$insert->bindParam(':email', $_POST['email']);
$insert->bindParam(':senha', $_POST['senha']);
$insert->bindParam(':telefone', $_POST['telefone']);

if ($insert->execute()) {

    $id = $conn->lastInsertId("usuario_id_usuario_seq");

    if ($_FILES && isset($_FILES['imagem'])) {
        $varArquivoRecebido = $_FILES['imagem']['tmp_name'];
        $varExtensaoPadrao = 'jpg'; 
        $varNovoArquivo = "imagens/usuario$id.$varExtensaoPadrao";

        if (move_uploaded_file($varArquivoRecebido, $varNovoArquivo)) {

            $update = $conn->prepare("update usuario set imagem = :imagem where id_usuario = :id");
            $update->bindParam(':imagem', $varNovoArquivo);
            $update->bindParam(':id', $id, PDO::PARAM_INT);
            $update->execute();
        }
    }
}

header("Location: usuario.php");
exit;
?>