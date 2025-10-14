<?php 
    session_start();
    include 'util.php';
    $id_produto=$_GET['id_produto'];
    $conn = conecta();
    $varSQL = "SELECT descricao, nome, valor_unitario, imagem 
           FROM produto 
           WHERE id_produto = $id_produto";
    $select = $conn->prepare($varSQL);
    $select->execute();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
     <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
</head>
</head>
<body>
    <section class="produto">
        <div class="produto">
            <h2><?php echo $produto['nome']?></h2>
            <img src="<?php echo $produto['imagem']?>" alt="<?php echo $produto['nome']?>">
            <p><?php echo $produto['descricao']?></p>
            <p>R$<?php echo number_format($produto['valor_unitario'], 2, ',', '.');?></p>
            <a href="adicionarAoCarrinho.php?id_produto=<?php echo $id_produto; ?>" class="btn">Adicionar ao Carrinho</a>
        </div>
    </section>
</body>
</html>