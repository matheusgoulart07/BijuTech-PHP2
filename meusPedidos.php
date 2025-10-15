<?php
session_start();
include "util.php";

// --- Verifica se o usuário está logado ---
if (!isset($_SESSION['usuario']['id']) || empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?redirect=meusPedidos.php");
    exit();
}

$id_usuario = (int)$_SESSION['usuario']['id'];
$conn = conecta();

// --- Busca pedidos do usuário ---
$select = $conn->prepare("
    SELECT id_compra, status, data, acrescimo_total, sessao
    FROM compra
    WHERE fk_usuario = :id_usuario AND status != 'carrinho'
    ORDER BY data DESC
");
$select->execute([':id_usuario' => $id_usuario]);
$pedidos = $select->fetchAll(PDO::FETCH_ASSOC);

// --- Função para exibir status legível ---
function traduzStatus($status) {
    switch(strtolower($status)) {
        case 'cancelado': return "Cancelado";
        case 'reservado': return "Pago / Processando";
        case 'entregue': return "Entregue";
        default: return ucfirst($status);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Meus Pedidos - BijuTech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pedidos.css"> </head>
<body>
<?php include "cabecalho.php"; ?>

<main class="flex-fill pedidos-container">
    <div class="pedidos-content">
        <h1 class="pedidos-titulo">Meus Pedidos</h1>

        <?php if (empty($pedidos)): ?>
            <div class="pedidos-vazio">
                <i class="fa fa-shopping-bag icone-vazio"></i>
                <p class="mensagem-vazia">Você ainda não realizou nenhum pedido.</p>
                <a href="index.php" class="btn">Começar a comprar</a>
            </div>
        <?php else: ?>
            <div class="table-responsive-wrapper">
                <table class="pedidos-table">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Itens</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <?php
                            // Busca itens do pedido
                            $stmtItens = $conn->prepare("
                                SELECT p.nome, cp.quantidade, cp.valor_unitario
                                FROM compra_produto cp
                                JOIN produto p ON cp.fk_produto = p.id_produto
                                WHERE cp.fk_compra = :id_compra
                            ");
                            $stmtItens->execute([':id_compra' => $pedido['id_compra']]);
                            $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);
                            $total = array_reduce($itens, fn($carry, $item) => $carry + ($item['quantidade'] * $item['valor_unitario']), 0.0);
                        ?>
                        <tr>
                            <td data-label="ID Pedido"><?= htmlspecialchars($pedido['id_compra']); ?></td>
                            <td data-label="Data"><?= date('d/m/Y H:i', strtotime($pedido['data'])); ?></td>
                            <td data-label="Status"><?= traduzStatus($pedido['status']); ?></td>
                            <td data-label="Total">R$ <?= number_format($total + $pedido['acrescimo_total'], 2, ',', '.'); ?></td>
                            <td data-label="Itens">
                                <ul>
                                    <?php foreach ($itens as $item) : ?>
                                        <li><?= (int)$item['quantidade']; ?>x <?= htmlspecialchars($item['nome']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</main>
<footer class="rodape"><?php include "rodape.php"; ?></footer>
<script src="js/script.js"></script>
</body>
</html>