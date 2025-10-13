<?php  

session_start();
include "util.php";
$conn = conecta();

$varSQL = "SELECT id_produto, nome, valor_unitario, imagem 
           FROM produto 
           WHERE excluido = false AND nome LIKE '%Colar%'";
$select = $conn->prepare($varSQL);
$select->execute();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colares</title>
</head>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">

<body>

    <?php include "cabecalho.php" ?>

    <main>
    <section class="banner banner-colares" id="banner">
        <div class="conteudo"> 
            <h3><span>Colares</span></h3>
            <p>E-Commerce Desenvolvido pela Equipe BijuTech do Segundo Ano
                de Informática Noturno do CTI.</p>

            <a href="#produtos" class="btn">Ver Produtos</a>
        </div>
    </section>

    <section class="produtos" id="produtos">
        
        <h1 class="heading"><span>Colares</span></h1>

        <div class="produtos-grid">
            <?php while ($produto = $select->fetch()): ?>
                <div class="box">    
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                    <h1><?php echo $produto['nome']; ?></h1>
                    <div class="preco">R$<?php echo number_format($produto['valor_unitario'], 2, ',', '.'); ?></div>
                    <a href="adicionarAoCarrinho.php?id_produto=<?php echo $produto['id_produto']; ?>" class="btn">Adicionar ao Carrinho</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<footer class="rodape"><?php include "rodape.php" ?></footer>
<script src="js/script.js"></script>
</body>
</html>