<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulseiras</title>
</head>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">

<body>

    <?php include "cabecalho.php" ?>

    <main>
    <section class="banner banner-pulseiras" id="banner">
        <div class="conteudo"> 
            <h3><span>Pulseiras</span></h3>
            <p>E-Commerce Desenvolvido pela Equipe BijuTech do Segundo Ano
                de Informática Noturno do CTI.</p>

            <a href="#produtos" class="btn">Ver Produtos</a>
        </div>
    </section>

    <section class="produtos" id="produtos">
        
        <h1 class="heading"><span>Pulseiras</span></h1>

        <div class="produtos-grid">

        <div class="box">    
                <img src="imagens/pulseira_prata.png">
                <h1>Pulseira Prata</h1>
                <div class="preco">R$50,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

            <div class="box">    
                <img src="imagens/pulseira_estrela.png">
                <h1>Pulseira Estrela Prata</h1>
                <div class="preco">R$45,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

            <div class="box">    
                <img src="imagens/pulseira_coracao.png">
                <h1>Pulseira Coração</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

             <div class="box">    
                <img src="imagens/pulseira_branca.png">
                <h1>Pulseira com Pedras Branca</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

             <div class="box">    
                <img src="imagens/pulseira_dourada2.png">
                <h1>Pulseira Dourada</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>


        </div>

    </section>
    </main>

    <?php include "rodape.php" ?>
    <script src="js/script.js"></script>

</body>
</html>