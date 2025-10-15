<?php
session_start();
include "util.php";

// --- Verifica se o usuário é admin ---
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login.php?redirect=adminPedidos.php");
    exit();
}

// --- Conecta ao banco ---
$pdo = conecta();
if (!$pdo || !($pdo instanceof PDO)) {
    die("Erro: conexão com banco de dados não encontrada.");
}

// --- Atualiza status ou acréscimo/desconto se solicitado ---
if ($_POST && isset($_POST['id_compra'])) {
    $id_compra = (int)$_POST['id_compra'];
    $updates = [];
    $params = [':id_compra' => $id_compra];
    $mensagem_email = '';

    // --- Atualiza status ---
    if (isset($_POST['novo_status']) && $_POST['novo_status'] != '') {
        $novo_status = strtolower($_POST['novo_status']); // minúsculas conforme ENUM
        $updates[] = "status = :status";
        $params[':status'] = $novo_status;
        $mensagem_email .= "O status do seu pedido #{$id_compra} foi alterado para: " . ucfirst($novo_status) . ".\n";
    }

    // --- Atualiza acréscimo/desconto ---
    if (isset($_POST['acrescimo']) && $_POST['acrescimo'] !== '') {
        $acrescimo = floatval(str_replace(',', '.', $_POST['acrescimo']));
        $updates[] = "acrescimo_total = :acrescimo";
        $params[':acrescimo'] = $acrescimo;
        $mensagem_email .= "O acréscimo/desconto do seu pedido #{$id_compra} foi atualizado para: R$ " . number_format($acrescimo, 2, ',', '.') . ".\n";
    }

    if (!empty($updates)) {
        $sql = "UPDATE compra SET " . implode(', ', $updates) . " WHERE id_compra = :id_compra";
        $stmtUpdate = $pdo->prepare($sql);
        $stmtUpdate->execute($params);

        // --- Envia e-mail ao cliente ---
        $stmtUser = $pdo->prepare("
            SELECT u.nome, u.email
            FROM usuario u
            JOIN compra c ON c.fk_usuario = u.id_usuario
            WHERE c.id_compra = :id_compra
        ");
        $stmtUser->execute([':id_compra' => $id_compra]);
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

        if ($user && !empty($user['email']) && $mensagem_email != '') {
            $assunto = "Atualização do Pedido #{$id_compra} - BijuTech";
            $mensagem = "Olá, {$user['nome']}!\n\n" . $mensagem_email . "\nObrigado por comprar na BijuTech!";
            $headers = "From: contato@bijutech.com.br\r\nReply-To: contato@bijutech.com.br\r\nX-Mailer: PHP/" . phpversion();
            @mail($user['email'], $assunto, $mensagem, $headers);
        }

        $msg_sucesso = "Pedido #{$id_compra} atualizado com sucesso.";
    }
}

// --- Filtro por status ---
$filtro_status = isset($_GET['status']) ? strtolower($_GET['status']) : '';
$whereFiltro = '';
$params = [];

if (!empty($filtro_status) && in_array($filtro_status, ['carrinho', 'cancelado', 'reservado', 'entregue'])) {
    $whereFiltro = "WHERE c.status = :status";
    $params[':status'] = $filtro_status;
}

// --- Busca pedidos ---
$stmtPedidos = $pdo->prepare("
    SELECT c.id_compra, c.status, c.data, c.acrescimo_total, u.nome AS cliente_nome, u.email AS cliente_email
    FROM compra c
    JOIN usuario u ON c.fk_usuario = u.id_usuario
    $whereFiltro
    ORDER BY c.data DESC
");
$stmtPedidos->execute($params);
$pedidos = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);

// --- Função para traduzir status ---
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
    <meta charset="UTF-8">
    <title>Painel Administrativo - Pedidos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "cabecalho.php"; ?>

<main>
<h1 class="heading"><span>Painel Administrativo - Pedidos</span></h1>

<?php if (isset($msg_sucesso)) { ?>
    <p style="color:green;"><?= htmlspecialchars($msg_sucesso) ?></p>
<?php } ?>

<form method="get">
    <label for="status">Filtrar por status:</label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="">Todos</option>
        <option value="carrinho" <?= $filtro_status == 'carrinho' ? 'selected' : '' ?>>Carrinho</option>
        <option value="cancelado" <?= $filtro_status == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
        <option value="reservado" <?= $filtro_status == 'reservado' ? 'selected' : '' ?>>Pago / Reservado</option>
        <option value="entregue" <?= $filtro_status == 'entregue' ? 'selected' : '' ?>>Entregue</option>
    </select>
</form>

<?php if (empty($pedidos)) { ?>
    <p>Nenhum pedido encontrado.</p>
<?php } else { ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Data</th>
                <th>Status</th>
                <th>Acréscimo / Desconto</th>
                <th>Total</th>
                <th>Itens</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $pedido) : ?>
            <?php
                // Busca itens do pedido
                $stmtItens = $pdo->prepare("
                    SELECT p.nome, cp.quantidade, cp.valor_unitario
                    FROM compra_produto cp
                    JOIN produto p ON cp.fk_produto = p.id_produto
                    WHERE cp.fk_compra = :id_compra
                ");
                $stmtItens->execute([':id_compra' => $pedido['id_compra']]);
                $itens = $stmtItens->fetchAll(PDO::FETCH_ASSOC);

                // Calcula total
                $total = 0.0;
                foreach ($itens as $item) {
                    $total += $item['quantidade'] * $item['valor_unitario'];
                }
            ?>
            <tr>
                <td><?= htmlspecialchars($pedido['id_compra']); ?></td>
                <td><?= htmlspecialchars($pedido['cliente_nome']); ?></td>
                <td><?= htmlspecialchars($pedido['cliente_email']); ?></td>
                <td><?= date('d/m/Y H:i', strtotime($pedido['data'])); ?></td>
                <td><?= traduzStatus($pedido['status']); ?></td>
                <td>
                    <form method="post" style="margin:0;">
                        <input type="hidden" name="id_compra" value="<?= (int)$pedido['id_compra']; ?>">
                        <input type="text" name="acrescimo" value="<?= number_format($pedido['acrescimo_total'], 2, ',', '.'); ?>" size="8">
                        <button type="submit">Atualizar</button>
                    </form>
                </td>
                <td>R$ <?= number_format($total + $pedido['acrescimo_total'], 2, ',', '.'); ?></td>
                <td>
                    <ul>
                        <?php foreach ($itens as $item) : ?>
                            <li><?= htmlspecialchars($item['nome']); ?> - Qtd: <?= (int)$item['quantidade']; ?> - R$ <?= number_format($item['valor_unitario'], 2, ',', '.'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td>
                    <form method="post" style="margin:0;">
                        <input type="hidden" name="id_compra" value="<?= (int)$pedido['id_compra']; ?>">
                        <select name="novo_status" required>
                            <option value="">Alterar status</option>
                            <option value="carrinho">Carrinho</option>
                            <option value="cancelado">Cancelado</option>
                            <option value="reservado">Pago / Reservado</option>
                            <option value="entregue">Entregue</option>
                        </select>
                        <button type="submit">Atualizar</button>
                    </form>
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