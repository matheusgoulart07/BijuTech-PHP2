<?php
session_start();
include "util.php"; // conecta ao PostgreSQL
$conn = conecta();

// Verifica se o usuário está logado
if (empty($_SESSION['usuario']['id'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = (int) $_SESSION['usuario']['id'];

// Verifica se há produtos no carrinho
if (empty($_SESSION['carrinho'])) {
    echo "<script>alert('Seu carrinho está vazio!'); window.location.href='carrinho.php';</script>";
    exit;
}

try {
    $conn->beginTransaction();

    // Calcula o valor total do pedido
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['preco'] * $item['quantidade'];
    }

    // Insere o pedido na tabela "compra"
    $stmt = $conn->prepare("
        INSERT INTO compra (data, acrescimo_total, sessao, fk_usuario, status)
        VALUES (NOW(), :acrescimo_total, :sessao, :fk_usuario, 'reservado')
        RETURNING id_compra
    ");
    $stmt->bindValue(':acrescimo_total', $acrescimo_total ?? 0);
    $stmt->bindValue(':sessao', session_id());
    $stmt->bindValue(':fk_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $id_compra = $stmt->fetchColumn();

    // Insere os produtos na tabela "compra_produto"
    $stmtItem = $conn->prepare("
        INSERT INTO compra_produto (fk_compra, fk_produto, quantidade, valor_unitario)
        VALUES (:fk_compra, :fk_produto, :quantidade, :valor_unitario)
    ");

    foreach ($_SESSION['carrinho'] as $item) {
        $stmtItem->execute([
            ':fk_compra' => $id_compra,
            ':fk_produto' => $item['id'],
            ':quantidade' => $item['quantidade'],
            ':valor_unitario' => $item['preco']
        ]);
    }

    $conn->commit();

    // Limpa o carrinho
    unset($_SESSION['carrinho']);

} catch (Exception $e) {
    $conn->rollBack();
    die("Erro ao confirmar pedido: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - BijuTech</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <!-- Fontes e estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <div class="confirmacao">
        <h1>Pedido Confirmado! ✅</h1>
        <p>Seu pedido nº <strong><?php echo $id_compra; ?></strong> foi registrado com sucesso.</p>
        <p>O pagamento será realizado presencialmente via <strong>PIX</strong> no dia do evento.</p>
        <a href="index.php">Voltar à loja</a>
    </div>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>
</html>
