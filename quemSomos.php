<?php 
session_start();
include "util.php";
$conn = conecta();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="quem-somos">
    
            <!-- TEXTO QUEM SOMOS -->
            <h1 class="titulo-principal">Quem Somos</h1>
            <hr class="linha-titulo">

            <p class="texto">
                BijuTech Ltda é uma loja virtual (e-commerce) fictícia, criada como estudo de caso para o trabalho em grupo
                "Desenvolvimento de um site de E-Commerce", dentro do Curso de Informática Noturno do CTI Bauru - INF2.
            </p>
            <p class="texto">
                Gostaríamos de agradecer o apoio, orientações, instruções e coordenações recebidas dos
                Profs.: Jovita Mercedes, Marcelo Cabello, José Vieira, André Luiz Bicudo, Debora Barbosa, e Vitor Assis. 
            </p>
            <p class="texto">
                O código-fonte pode ser obtido via GitHub, conforme orientações apresentadas ao longo do curso nas aulas presenciais. 
            </p>
            <p class="texto">
                Este estudo de caso pode ser utilizado livremente como base para outras lojas virtuais, sem ônus para o usuário.
            </p>

            <!-- EQUIPE -->
            <h2 class="titulo-equipe">Nossa Equipe</h2>
            <div class="team-cards">
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="Guilherme">
                    <h3>Guilherme</h3>
                    <p>Gerente de Vendas e Marketing</p>
                </div>
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="Irineu">
                    <h3>Irineu</h3>
                    <p>Gerente Financeiro</p>
                </div>
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="João Vitor">
                    <h3>João Vitor</h3>
                    <p>Gerente de Recursos Humanos</p>
                </div>
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="João Vitor da Paz">
                    <h3>João Vitor da Paz</h3>
                    <p>Gerente de Qualidade</p>
                </div>
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="Matheus Goulart">
                    <h3>Matheus Goulart</h3>
                    <p>Gerente de Informática</p>
                </div>
                <div class="team-card">
                    <img src="imagens/foto_padrao.jpg" alt="Pedro">
                    <h3>Pedro</h3>
                    <p>Gerente de Produção</p>
                </div>
            </div>

            <section class="secao-mvv">
            <h2 class="titulo-mvv">Missão, Visão e Valores</h2>
            <hr class="linha-titulo">

                    <div class="mvv-bloco">
                        <h3>Missão</h3>
                        <p>Encantar o cliente, oferecendo uma experiência de compra agradável e
                        formando memórias com nossas vendas de bijuterias na caixinha de presente.</p>
                    </div>

                    <div class="mvv-bloco">
                        <h3>Visão</h3>
                        <p>Ser líder de mercado em vendas de bijuterias finas e acessórios com peças de
                        design exclusivas e modernas.</p>
                    </div>

                    <div class="mvv-bloco">
                        <h3>Valores</h3>
                        <ul>
                            <li>Honestidade</li>
                            <li>Respeito ao cliente</li>
                            <li>Valorização da autoestima pessoal</li>
                        </ul>
                    </div>

            </section>

            <p class="texto-destaque">
                MUITO OBRIGADO a TODOS!!
            </p>
        </div>
    </main>

    <?php include "rodape.php" ?>
    <script src="js/script.js"></script>

</body>
</html>
