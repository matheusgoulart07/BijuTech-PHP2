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
    <title>Listar Usuários - BijuTech</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <!-- Fontes e estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php" ?>

<h2>Painel de Usuários</h2>

<form method="post">
    <label for="filtro">Mostrar:</label>
    <select name="filtro" id="filtro">
        <option value="ativos" <?= $filtro === 'ativos' ? 'selected' : '' ?>>Ativos</option>
        <option value="excluidos" <?= $filtro === 'excluidos' ? 'selected' : '' ?>>Excluídos</option>
        <option value="todos" <?= $filtro === 'todos' ? 'selected' : '' ?>>Todos</option>
    </select>

    <input type="text" name="busca" placeholder="Buscar por nome ou e-mail" value="<?= htmlspecialchars($busca ?? '') ?>">
    <button type="submit">Filtrar</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php if (count($usuarios) > 0): ?>
        <?php foreach ($usuarios as $user): ?>
        <tr>
            <td><?= (int)$user['id_usuario'] ?></td>
            <td><?= htmlspecialchars($user['nome'] ?? '') ?></td>
            <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($user['telefone'] ?? '') ?></td>
            <td><?= $user['excluido'] ? 'Excluído' : 'Ativo' ?></td>
            <td class="acoes">
                <?php if (!$user['excluido']): ?>
                    <a href="alterarUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="editar">Editar</a>
                    <a href="excluirUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="excluir" onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
                <?php else: ?>
                    <a href="reativarUsuario.php?id=<?= (int)$user['id_usuario'] ?>" class="reativar" onclick="return confirm('Deseja reativar este usuário?')">Reativar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6">Nenhum usuário encontrado.</td></tr>
    <?php endif; ?>
</table>

<a href="adminUsuario.php">Visualização Alternativa de Usuários</a>

    <script src="js/script.js"></script>
     <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>
</html>