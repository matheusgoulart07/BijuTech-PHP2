<?php
session_start();
include 'util.php';
$conn = conecta();

// Verifica se é admin
if (!isset($_SESSION['sessaoConectado']) || !$_SESSION['sessaoConectado'] || !isset($_SESSION['admin']) || !$_SESSION['admin']) {
    echo "Acesso negado.";
    exit;
}

// Captura ação de alteração de status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_compra'], $_POST['status'])) {
    $id = (int)$_POST['id_compra'];
    $novo = $_POST['status'];

    try {
        $conn->beginTransaction();
        // Se o novo status for 'entregue', dar baixa no estoque
        if ($novo === 'entregue') {
            $sel = $conn->prepare("SELECT fk_produto, quantidade FROM compra_produto WHERE fk_compra = :id");
            $sel->bindParam(':id', $id);
            $sel->execute();
            $itens = $sel->fetchAll(PDO::FETCH_ASSOC);
            foreach ($itens as $it) {
                // Atualiza estoque (evitar estoque negativo)
                $upd = $conn->prepare("UPDATE produto SET qtd_estoque = qtd_estoque - :q WHERE id_produto = :pid AND qtd_estoque >= :q");
                $upd->bindParam(':q', $it['quantidade']);
                $upd->bindParam(':pid', $it['fk_produto']);
                $upd->execute();
            }
        }
        $u = $conn->prepare("UPDATE compra SET status = :status WHERE id_compra = :id");
        $u->bindParam(':status', $novo);
        $u->bindParam(':id', $id);
        $u->execute();
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Erro ao atualizar status: " . $e->getMessage();
    }
}

// Listar compras
$sel = $conn->query("SELECT c.*, u.nome AS nome_usuario FROM compra c LEFT JOIN usuario u ON c.fk_usuario = u.id_usuario ORDER BY c.data DESC");
$compras = $sel->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include "cabecalho.php" ?>

            <h1>Gerenciar Compras</h1>
                    <table border="1" cellpadding="6">
                        <tr><th>ID</th><th>Usuário</th><th>Data</th><th>Status</th><th>Sessão</th><th>Ações</th></tr>
                        <?php foreach($compras as $c): ?>
                        <tr>
                            <td><?= $c['id_compra'] ?></td>
                            <td><?= htmlspecialchars($c['nome_usuario'] ?? '---') ?></td>
                            <td><?= $c['data'] ?></td>
                            <td><?= $c['status'] ?></td>
                            <td><?= $c['sessao'] ?></td>
                            <td>
                                <form method="post" style="display:inline">
                                <input type="hidden" name="id_compra" value="<?= $c['id_compra'] ?>">
                                <select name="status">
                                <option value="cancelado" <?= $c['status']=='cancelado'?'selected':'' ?>>cancelado</option>
                                <option value="carrinho" <?= $c['status']=='carrinho'?'selected':'' ?>>carrinho</option>
                                <option value="compra" <?= $c['status']=='compra'?'selected':'' ?>>compra</option>
                                <option value="entregue" <?= $c['status']=='entregue'?'selected':'' ?>>entregue</option>
                                </select>
                                <button type="submit">Salvar</button>
                                </form>
                                    <a href="detalhe_compra.php?id=<?= $c['id_compra'] ?>">Ver Itens</a>
                                    </td>
                                    </tr>
                                    <?php endforeach; ?>
                    </table>
    
    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>
</html>