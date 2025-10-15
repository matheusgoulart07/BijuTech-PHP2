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
    <title>Quem Somos - BijuTech</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom-layout.css"> </head>
<body>
    
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="container">
            <div class="content-wrapper">

                <h2 class="page-title">Quem Somos</h2>
                
                <p class="intro-paragraph">BijuTech Ltda é uma loja virtual (e-commerce) fictícia, criada como estudo de caso para o trabalho em grupo "Desenvolvimento de um site de E-Commerce", dentro do Curso de Informática Noturno do CTI Bauru - INF2.</p>
                
                <hr>

                <h3>Sobre o Projeto</h3>
                <p>O código-fonte pode ser obtido via GitHub, conforme orientações apresentadas ao longo do curso nas aulas presenciais.</p>
                <p>Este estudo de caso pode ser utilizado livremente como base para outras lojas virtuais, sem ônus para o usuário.</p>
                
                <h3 style="margin-top: 1.5rem;">Agradecimentos</h3>
                <p>Gostaríamos de agradecer o apoio, orientações, instruções e coordenações recebidas dos Professores: Jovita Mercedes, Marcelo Cabello, José Vieira, André Luiz Bicudo, Debora Barbosa, e Vitor Assis. Que estiveram sempre com nossa equipe nos auxiliando em todo o projeto.</p>
                <p>Nossa equipe, formada pelos alunos Guilherme, Irineu, João Paes, João Vitor, Mateus e Pedro, agradecem a todos os participantes e colaboradores.</p>

                <div class="quote-block">
                    <p class="quote-text">MUITO OBRIGADO A TODOS!!</p>
                    <p class="quote-caption">Bons estudos e boa programação!</p>
                </div>

            </div>
        </div>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

</body>
</html>