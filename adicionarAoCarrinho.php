<?php
session_start();
require_once 'util.php';

// Cria conexão PDO
$pdo = conecta();

// Obtém parâmetros da URL
$id_produto = isset($_GET['id_produto']) ? (int) $_GET['id_produto'] : null;
$quantidade = isset($_GET['quantidade']) ? (int) $_GET['quantidade'] : 1;

if (!$id_produto || $id_produto <= 0) {
    die("ID do produto não informado.");
}

if ($quantidade <= 0) {
    $quantidade = 1;
}

// Consulta o produto no banco
$sql = "SELECT id_produto, nome, valor_unitario, descricao, imagem 
        FROM produto
        WHERE id_produto = :id_produto AND excluido = FALSE";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($produto) {
    // Cria item do carrinho
    $item = [
        'id' => $produto['id_produto'],
        'nome' => $produto['nome'],
        'descricao' => $produto['descricao'],
        'imagem' => $produto['imagem'],
        'preco' => $produto['valor_unitario'],
        'quantidade' => $quantidade,
        'total' => $produto['valor_unitario'] * $quantidade
    ];

    // Adiciona ao carrinho (ou atualiza quantidade se já existir)
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    $encontrado = false;
    foreach ($_SESSION['carrinho'] as &$prod) {
        if ($prod['id'] == $item['id']) {
            $prod['quantidade'] += $item['quantidade'];
            $prod['total'] = $prod['preco'] * $prod['quantidade'];
            $encontrado = true;
            break;
        }
    }
    unset($prod);

    if (!$encontrado) {
        $_SESSION['carrinho'][] = $item;
    }

    // Redireciona para o carrinho
    header("Location: carrinho.php");
    exit;
} else {
    echo "Produto não encontrado.";
}
?>