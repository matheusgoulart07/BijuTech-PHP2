<?php
session_start();
include "util.php";

// --- Verifica se o usuário está logado ---
if (!isset($_SESSION['usuario']['id']) || empty($_SESSION['usuario']['id'])) {
    header("Location: login.php?redirect=meusPedidos.php");
    exit();
}

$id_usuario = (int)$_SESSION['usuario']['id'];

// --- Conecta ao banco ---
$conn = conecta();

/*
if (!$conn || !($conn instanceof PDO)) {
    die("Erro: conexão com banco de dados não encontrada.");
} 
*/

// --- Busca pedidos do usuário ---
$select = $conn->prepare("
    SELECT id_compra, status, data, acrescimo_total, sessao
    FROM compra
    WHERE fk_usuario = :id_usuario
    ORDER BY data DESC
");
$select->execute([':id_usuario' => $id_usuario]);
$pedidos = $select->fetchAll(PDO::FETCH_ASSOC);

// --- Função para exibir status legível ---
function traduzStatus($status) {
    switch(strtolower($status)) {
        case 'cancelado': return "Cancelado";
        case 'carrinho': return "Carrinho";
        case 'reservado': return "Pago / Reservado";
        case 'entregue': return "Entregue";
        default: return $status;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="css/style.css">
     <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
</head>
<body>
<?php include "cabecalho.php"; ?>

<main>
<h1 class="heading"><span>Meus Pedidos</span></h1>

<?php if (empty($pedidos)) { ?>
    <p>Você ainda não realizou nenhum pedido.</p>
<?php } else { ?>
    <table border="1" cellpadding="8" cellspacing="0">
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
        <?php foreach ($pedidos as $pedido) : ?>
            <?php
                // Busca itens do pedido
                $select = $conn->prepare("
                    SELECT p.nome, cp.quantidade, cp.valor_unitario
                    FROM compra_produto cp
                    JOIN produto p ON cp.fk_produto = p.id_produto
                    WHERE cp.fk_compra = :id_compra
                ");
                $select->execute([':id_compra' => $pedido['id_compra']]);
                $itens = $select->fetchAll(PDO::FETCH_ASSOC);

                // Calcula total
                $total = 0.0;
                foreach ($itens as $item) {
                    $total += $item['quantidade'] * $item['valor_unitario'];
                }
            ?>
            <tr>
                <td><?= htmlspecialchars($pedido['id_compra']); ?></td>
                <td><?= date('d/m/Y H:i', strtotime($pedido['data'])); ?></td>
                <td><?= traduzStatus($pedido['status']); ?></td>
                <td>R$ <?= number_format($total + $pedido['acrescimo_total'], 2, ',', '.'); ?></td>
                <td>
                    <ul>
                        <?php foreach ($itens as $item) : ?>
                            <li><?= htmlspecialchars($item['nome']); ?> - Qtd: <?= (int)$item['quantidade']; ?> - R$ <?= number_format($item['valor_unitario'], 2, ',', '.'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>
</main>

<script src="js/script.js"></script>
<footer class="rodape"><?php include "rodape.php"; ?></footer>
</body>
</html>