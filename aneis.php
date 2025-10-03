<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anéis</title>
</head>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">

<body>

    <?php include "cabecalho.php" ?>

    <main>
    <section class="banner banner-aneis" id="banner">
        <div class="conteudo"> 
            <h3><span>Anéis</span></h3>
            <p>E-Commerce Desenvolvido pela Equipe BijuTech do Segundo Ano
                de Informática Noturno do CTI.</p>

            <a href="#produtos" class="btn">Ver Produtos</a>
        </div>
    </section>

    <section class="produtos" id="produtos">
        
        <h1 class="heading"><span>Anéis</span></h1>

        <div class="produtos-grid">

        <div class="box">    
                <img src="imagens/anel_dourado2.png">
                <h1>Anel Dourado</h1>
                <div class="preco">R$50,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

            <div class="box">    
                <img src="imagens/anel_prata.png">
                <h1>Anel Prata</h1>
                <div class="preco">R$45,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

            <div class="box">    
                <img src="imagens/anel_pedra_azul.png">
                <h1>Anel Pedra Azul</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

             <div class="box">    
                <img src="imagens/anel_vermelho.png">
                <h1>Anel Vermelho</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>

             <div class="box">    
                <img src="imagens/anel_branco.png">
                <h1>Anel Branco</h1>
                <div class="preco">R$70,00</div>
                <a href="#" class="btn">Adicionar ao Carrinho</a>
            </div>


        </div>

    </section>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>
</body>
</html>