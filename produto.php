<?php 
    session_start();
    include 'util.php';
    // É uma boa prática validar e "limpar" a entrada do usuário
    $id_produto = filter_input(INPUT_GET, 'id_produto', FILTER_SANITIZE_NUMBER_INT);
    
    if ($id_produto) {
        $conn = conecta();
        $varSQL = "SELECT id_produto, descricao, nome, valor_unitario, imagem 
                   FROM produto 
                   WHERE id_produto = :id_produto";
        $select = $conn->prepare($varSQL);
        $select->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $select->execute();
        $produto_detalhe = $select->fetch(PDO::FETCH_ASSOC);
    } else {
        // Redireciona ou mostra erro se não houver ID
        $produto_detalhe = null;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produto_detalhe ? htmlspecialchars($produto_detalhe['nome']) : 'Produto não encontrado'; ?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php" ?>

    <main>
        <section class="pagina-produto">
            <?php if ($produto_detalhe): ?>
                <div class="produto-container">
                    <div class="produto-imagem-wrapper">
                        <img class="produto-imagem" src="<?php echo htmlspecialchars($produto_detalhe['imagem']); ?>" alt="<?php echo htmlspecialchars($produto_detalhe['nome']); ?>">
                    </div>
                    <div class="produto-detalhes">
                        <h2 class="produto-titulo"><?php echo htmlspecialchars($produto_detalhe['nome']); ?></h2>
                        <p class="produto-descricao"><?php echo htmlspecialchars($produto_detalhe['descricao']); ?></p>
                        <p class="produto-preco">R$<?php echo number_format($produto_detalhe['valor_unitario'], 2, ',', '.'); ?></p>
                       <div class="botao carrinho">
                            <a class="btn" href="adicionarAoCarrinho.php?id_produto=<?php echo $produto_detalhe['id_produto']; ?>">
                                Adicionar ao Carrinho
                            </a>
                       </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="mensagem-vazio">Produto não encontrado!</p>
            <?php endif; ?>
        </section>
    </main>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>

    </body>
</html>