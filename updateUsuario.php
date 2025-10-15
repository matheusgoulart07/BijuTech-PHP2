<?php 
include "util.php";
$conn = conecta();

$id_usuario = $_POST['id_usuario'] ?? null;
$nome       = $_POST['nome'] ?? '';
$email      = $_POST['email'] ?? '';
$senha      = $_POST['senha'] ?? '';
$telefone   = $_POST['telefone'] ?? '';

if (!$id_usuario) {
    die("Erro: ID do usuário não informado.");
}

try {
    $varSQL = "UPDATE usuario 
               SET nome = :nome, 
                   email = :email, 
                   senha = :senha, 
                   telefone = :telefone
               WHERE id_usuario = :id_usuario";

    $update = $conn->prepare($varSQL);
    $update->bindParam(':nome', $nome);
    $update->bindParam(':email', $email);
    $update->bindParam(':senha', $senha);
    $update->bindParam(':telefone', $telefone);
    $update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    $update->execute(); // ✅ Executa o UPDATE

    // Redireciona após a atualização bem-sucedida
    header("Location: adminUsuario.php");
    exit;

} catch (PDOException $e) {
    die("Erro ao atualizar usuário: " . $e->getMessage());
}
?>