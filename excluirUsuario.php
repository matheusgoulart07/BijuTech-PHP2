<?php
include "util.php";
$conn = conecta();

$id_usuario = $_GET['id'] ?? null;

if (!$id_usuario) {
    die("Erro: ID do usuário não informado.");
}

try {
    // Atualiza o campo 'excluido' para true (exclusão lógica)
    $sql = "UPDATE usuario SET excluido = true WHERE id_usuario = :id_usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona de volta para a lista de usuários
    header("Location: adminUsuario.php");
    exit;

} catch (PDOException $e) {
    die("Erro ao excluir usuário: " . $e->getMessage());
}
?>