<?php
session_start();
include "util.php";
$conn = conecta();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['atualizar'])) {
    $index = $_POST['index'];
    $quantidade = max(1, (int) $_POST['quantidade']);
    $_SESSION['carrinho'][$index]['quantidade'] = $quantidade;
    $_SESSION['carrinho'][$index]['total'] = $_SESSION['carrinho'][$index]['preco'] * $quantidade;
    header("Location: carrinho.php");
    exit();
}

if (isset($_GET['remover'])) {
    $index = $_GET['remover'];
    unset($_SESSION['carrinho'][$index]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); 
    header("Location: carrinho.php");
    exit();
}

$totalGeral = array_sum(array_column($_SESSION['carrinho'], 'total'));
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - BijuTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Ícones e estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <main class="carrinho-container">
        <h1 class="titulo-carrinho">Carrinho de Compras</h1>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <div class="mensagem-vazio">Seu carrinho está vazio.</div>
            <a href="index.php" class="btn botao-continuar">Continuar comprando</a>
        <?php else: ?>

            <div class="table-wrapper">
                <table class="tabela-carrinho">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                            <tr class="item-carrinho">
                                <td class="produto">
                                    <?php if (!empty($item['imagem'])): ?>
                                       <img src="<?= htmlspecialchars($item['imagem']) ?>" width="60" alt="<?= htmlspecialchars($item['nome']) ?>" class="imagem-produto">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/60x60?text=Sem+Foto" alt="Sem imagem" class="imagem-produto">
                                    <?php endif; ?>
                                    <span class="nome-produto"><?= htmlspecialchars($item['nome']) ?></span>
                                </td>
                                <td class="descricao"><?= htmlspecialchars($item['descricao']) ?></td>
                                <td class="preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                <td class="quantidade">
                                    <form method="post" class="form-quantidade">
                                        <input type="hidden" name="index" value="<?= $index ?>">
                                        <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1" class="input-quantidade">
                                        <button type="submit" name="atualizar" class="btn botao-atualizar">Atualizar</button>
                                    </form>
                                </td>
                                <td class="total-item">R$ <?= number_format($item['total'], 2, ',', '.') ?></td>
                                <td class="acoes">
                                    <a href="carrinho.php?remover=<?= $index ?>" class="btn remover" onclick="return confirm('Deseja remover este item?')">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-geral">
                            <td colspan="4" class="texto-total">Total Geral:</td>
                            <td colspan="2" class="valor-total">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="acoes-carrinho">
                <a href="index.php" class="btn continuar">Continuar comprando</a>
               <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="finalizarCompra.php" class="btn finalizar">Finalizar Compra</a>
               <?php else: ?>
                    <a href="login.php?redirect=finalizarCompra.php" class="btn finalizar">Finalizar Compra</a>
               <?php endif; ?>
            </div>

        <?php endif; ?>
    </main>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    
</body>
</html>

