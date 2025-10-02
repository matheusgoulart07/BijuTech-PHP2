<?php 
session_start();
include "util.php";
$conn = conecta();

$varSQL = "select id_produto, nome, valor_unitario, imagem from produto";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BijuTech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <?php include "cabecalho.php" ?>

    <main>
    <section class="banner" id="banner">
        <div class="conteudo">   
            <h3>Bijuteria de <span>Qualidade</span> para você!</h3>
            <p>E-Commerce Desenvolvido pela Equipe BijuTech do Segundo Ano
                de Informática Noturno do CTI.</p>


        </div>
    </section>



    <section class="categoria" id="categoria">
        <h1 class="heading"><span>Categorias</span></h1>

        <div class="box-container">

            <a href="aneis.php" class="box">
                <img src="imagens/anel_dourado.png">
                <h3>Anéis</h3>
                <p>Anéis que completam seu visual com elegância e sofisticação.</p>
                </a>

            <a href="brincos.php" class="box">
                <img src="imagens/brinco_ponto_de_luz.png">
                <h3>Brincos</h3>
                <p>Um acessório versátil que valoriza sua beleza de forma sutil e refinada.</p>
                </a>

            <a href="colares.php" class="box">
                <img src="imagens/colar_dourado.png">
                <h3>Colares</h3>
                <p>Colares que valorizam seu visual, trazendo sofisticação em modelos clássicos e modernos.</p>
            </a>

            <a href="pulseiras.php" class="box">
                <img src="imagens/pulseira_prata.png">
                <h3>Pulseiras</h3>
                <p>Pulseiras que combinam com todos os momentos.</p>
            </a>

        </div>

    </section>


    <section class="produtos" id="produtos">
        <h1 class="heading"><span>Produtos</span></h1>

        <div class="swiper carrossel-produtos">
                <div class="swiper-wrapper">
                    
                    <div class="swiper-slide">
                        <div class="box"> 
                            <img src="imagens/anel_dourado2.png">
                            <h1>Anel Dourado</h1>
                            <div class="preco">R$50,00</div>
                            <a class="btn" href="carrinhoSub.php?id_produto=1">Adicionar ao Carrinho</a>
                        </div>
                    </div>

                      <div class="swiper-slide">
                        <div class="box"> 
                            <img src="imagens/brinco_coracao_dourado.png">
                            <h1>Brinco Coração</h1>
                            <div class="preco">R$70,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="box"> 
                            <img src="imagens/colar_prata.png">
                            <h1>Colar Prata</h1>
                            <div class="preco">R$45,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="box"> 
                           <img src="imagens/pulseira_estrela.png">
                            <h1>Pulseira Estrela</h1>
                            <div class="preco">R$45,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="box"> 
                             <img src="imagens/anel_branco.png">
                            <h1>Anel Branco</h1>
                            <div class="preco">R$70,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>

                     <div class="swiper-slide">
                        <div class="box"> 
                           <img src="imagens/brinco_ponto_de_luz.png">
                            <h1>Brinco Preto</h1>
                            <div class="preco">R$45,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>

                     <div class="swiper-slide">
                        <div class="box"> 
                            <img src="imagens/pulseira_dourada2.png">
                            <h1>Pulseira Dourada</h1>
                            <div class="preco">R$70,00</div>
                            <button class="btn">Adicionar ao Carrinho</button>
                        </div>
                    </div>
                     
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>

        </div>

    </section>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/script.js"></script>
    <script src="js/carrinho.js"></script>

</body>
</html>