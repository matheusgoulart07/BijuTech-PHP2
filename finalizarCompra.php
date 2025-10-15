<?php
session_start();

// Se o usuário não estiver logado, redireciona pro login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?redirect=finalizarCompra.php");
    exit;
}

$carrinho = $_SESSION['carrinho'] ?? [];
$usuario = $_SESSION['usuario'];

function calcularTotal($carrinho) {
    $total = 0;
    foreach ($carrinho as $item) {
        $total += $item['preco'] * $item['quantidade'];
    }
    return number_format($total, 2, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/finalizar-compra.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <main class="conteudo">
        <h1 class="heading"><span>Finalizar Compra</span></h1>

        <section class="finalizar-compra">
            <p>Você está comprando como:
                <strong><?= htmlspecialchars($usuario['nome'] ?? 'Usuário') ?></strong>
                (<?= htmlspecialchars($usuario['email'] ?? 'E-mail não informado') ?>)
            </p>

            <h2>Resumo do Carrinho</h2>
            <ul class="lista-carrinho">
                <?php foreach ($carrinho as $item): ?>
                    <li class="item-carrinho">
                        <span><?= htmlspecialchars($item['nome']) ?> x <?= (int)$item['quantidade'] ?></span>
                        <span>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
                <li class="item-total">
                    <strong>Total:</strong>
                    <strong>R$ <?= calcularTotal($carrinho) ?></strong>
                </li>
            </ul>

            <form action="pedidoConfirmado.php" method="POST" class="form-finalizar">
                <label for="pagamento">Forma de Pagamento:</label>
                <select name="pagamento" id="pagamento" required>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Cartão de Débito">Cartão de Débito</option>
                    <option value="Pix">Pix</option>
                    <option value="Boleto">Boleto</option>
                    <option value="Dinheiro">Dinheiro</option>
                </select>

                <button type="submit" class="btn">Confirmar Pedido</button>
            </form>
        </section>
    </main>

    <?php include "rodape.php"; ?>

</body>
</html>