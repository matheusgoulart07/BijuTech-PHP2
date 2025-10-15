<?php
session_start();
include 'util.php';
$conn = conecta();

// Buscar todos os usuários ativos      WHERE status ="ativo"
try {
    $sql = "SELECT id_usuario, nome, email, admin 
            FROM usuario 
            WHERE excluido = 'false' 
            ORDER BY nome";
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
    <title>BijuTech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php" ?>

    <h2>Administração de Usuários</h2>

    <a href="adicionarUsuario.php" class="button incluir">Incluir Novo Usuário</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($usuarios as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id_usuario']) ?></td>
                <td><?= htmlspecialchars($user['nome']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= $user['admin'] ? 'Sim' : 'Não' ?></td>
                <td>
                    <a href="alterarUsuario.php?id=<?= $user['id_usuario'] ?>" class="button">Alterar</a>
                    <a href="excluirUsuario.php?id=<?= $user['id_usuario'] ?>" class="button" onclick="return confirm('Deseja realmente excluir este usuário?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

                <br>
                    <a href="index.php"  class="button">Início</a>
                <br>
                    <a href="usuarios.php"  class="button">Lista Usuários Ativos</a>
                <br>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>

</html>