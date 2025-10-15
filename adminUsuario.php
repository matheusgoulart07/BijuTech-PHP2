<?php
session_start();
include 'util.php';
$conn = conecta();

try {
    $sql = "SELECT id_usuario, nome, email, admin FROM usuario WHERE excluido = 'false' ORDER BY nome";
    $stmt = $conn->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar usuários: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Usuários - BijuTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pgs-admin.css"> </head>
<body>
    <?php include "cabecalho.php" ?>

    <div class="admin-container">
        <div class="admin-content">
            <h1 class="admin-title">Administração de Usuários</h1>
            <a href="adicionarUsuario.php" class="admin-button" style="margin-bottom: 1.5rem;">Incluir Novo Usuário</a>
            <div class="table-responsive-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr><th>ID</th><th>Nome</th><th>Email</th><th>Admin</th><th>Ações</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id_usuario']) ?></td>
                                <td><?= htmlspecialchars($user['nome']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= $user['admin'] ? 'Sim' : 'Não' ?></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="alterarUsuario.php?id=<?= $user['id_usuario'] ?>" class="admin-button">Alterar</a>
                                        <a href="excluirUsuario.php?id=<?= $user['id_usuario'] ?>" class="admin-button admin-button-delete" onclick="return confirm('Deseja realmente excluir este usuário?');">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>
</body>
</html>