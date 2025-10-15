<?php
session_start();
include "util.php";
$conn = conecta();

// Recebe os filtros
$filtro = $_POST['filtro'] ?? 'ativos';
$busca = trim($_POST['busca'] ?? '');

// Monta a cláusula WHERE dinamicamente
$where = "1=1";

if ($filtro === 'ativos') {
    $where .= " AND excluido = false";
} elseif ($filtro === 'excluidos') {
    $where .= " AND excluido = true";
}

if ($busca !== '') {
    $where .= " AND (nome ILIKE :busca OR email ILIKE :busca)";
}

$sql = "SELECT id_usuario, nome, email, telefone, excluido 
        FROM usuario
        WHERE $where
        ORDER BY id_usuario";

$stmt = $conn->prepare($sql);

if ($busca !== '') {
    $likeBusca = "%" . $busca . "%";
    $stmt->bindParam(':busca', $likeBusca, PDO::PARAM_STR);
}

$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Usuários - BijuTech</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pgs-admin.css">
</head>
<body>
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="admin-container">
            <div class="admin-content">
                <h1 class="admin-title">Painel de Usuários</h1>

                <div class="filter-bar">
                    <form method="post" class="admin-form-inline">
                        <label for="filtro">Mostrar:</label>
                        <select name="filtro" id="filtro">
                            <option value="ativos" <?= $filtro === 'ativos' ? 'selected' : '' ?>>Ativos</option>
                            <option value="excluidos" <?= $filtro === 'excluidos' ? 'selected' : '' ?>>Excluídos</option>
                            <option value="todos" <?= $filtro === 'todos' ? 'selected' : '' ?>>Todos</option>
                        </select>

                        <input type="text" name="busca" placeholder="Buscar por nome ou e-mail" value="<?= htmlspecialchars($busca ?? '') ?>">
                        <button type="submit" class="admin-button">Filtrar</button>
                    </form>
                </div>

                <div class="table-responsive-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($usuarios) > 0): ?>
                                <?php foreach ($usuarios as $user): ?>
                                <tr>
                                    <td><?= (int)$user['id_usuario'] ?></td>
                                    <td><?= htmlspecialchars($user['nome'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($user['telefone'] ?? '') ?></td>
                                    <td><?= $user['excluido'] ? 'Excluído' : 'Ativo' ?></td>
                                    <td>
                                        <div class="admin-actions">
                                            <?php if (!$user['excluido']): ?>
                                                <a href="alterarUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="admin-button">Editar</a>
                                                <a href="excluirUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="admin-button admin-button-delete" onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
                                            <?php else: ?>
                                                <a href="reativarUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="admin-button admin-button-success" onclick="return confirm('Deseja reativar este usuário?')">Reativar</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align: center;">Nenhum usuário encontrado com os filtros aplicados.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 1.5rem;">
                    <a href="adminUsuario.php" class="admin-button">Visualização Alternativa</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>
</body>
</html>