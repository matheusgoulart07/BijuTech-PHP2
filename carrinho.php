<?php
session_start();
include "util.php";
$conn = conecta();

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Lógica para atualizar a quantidade de um item
if (isset($_POST['atualizar'])) {
    $index = $_POST['index'];
    $quantidade = max(1, (int) $_POST['quantidade']); // Garante que a quantidade seja no mínimo 1
    
    // Verifica se o item ainda existe antes de atualizar
    if (isset($_SESSION['carrinho'][$index])) {
        $_SESSION['carrinho'][$index]['quantidade'] = $quantidade;
        $_SESSION['carrinho'][$index]['total'] = $_SESSION['carrinho'][$index]['preco'] * $quantidade;
    }
    
    header("Location: carrinho.php");
    exit();
}

// Lógica para remover um item do carrinho
if (isset($_GET['remover'])) {
    $index = $_GET['remover'];
    
    if (isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]);
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array para evitar buracos
    }

    header("Location: carrinho.php");
    exit();
}

// Calcula o total geral do carrinho
$totalGeral = array_sum(array_column($_SESSION['carrinho'], 'total'));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - BijuTech</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carrinho.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <main class="flex-fill carrinho-container <?php echo empty($_SESSION['carrinho']) ? 'vazio' : ''; ?>">
        
        <h1 class="titulo-carrinho">Carrinho de Compras</h1>

        <?php if (empty($_SESSION['carrinho'])): ?>

            <p class="mensagem-vazio">Seu carrinho está vazio.</p>
            <div class="botoes-carrinho-vazio">
                <a href="index.php" class="btn">Continuar comprando</a>
                <a href="meusPedidos.php" class="btn">Meus Pedidos</a>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                            <tr>
                                <td data-label="Produto">
                                    <img src="<?= htmlspecialchars($item['imagem']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>" class="imagem-produto">
                                    <span class="nome-produto"><?= htmlspecialchars($item['nome']) ?></span>
                                </td>
                                <td data-label="Descrição"><?= htmlspecialchars($item['descricao']) ?></td>
                                <td data-label="Preço">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                
                                <td data-label="Quantidade">
                                    <div class="controles-quantidade">
                                        <form method="post" class="form-quantidade">
                                            <input type="hidden" name="index" value="<?= $index ?>">
                                            <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1" class="input-quantidade">
                                            <button type="submit" name="atualizar" class="botao-atualizar">Atualizar</button>
                                        </form>
                                        <a href="carrinho.php?remover=<?= $index ?>" class="link-remover" onclick="return confirm('Tem certeza que deseja remover este item?')">Remover</a>
                                    </div>
                                </td>
                                
                                <td data-label="Total">R$ <?= number_format($item['total'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-geral">
                            <td colspan="4" class="texto-total">Total Geral:</td>
                            <td class="valor-total">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
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
    <?php include "rodape.php"; ?>
    <script src="js/script.js"></script>
    
</body>
</html>