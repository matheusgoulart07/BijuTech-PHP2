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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">

                    <h2 class="mb-4">Quem Somos</h2>
                    
                    <p class="lead">BijuTech Ltda é uma loja virtual (e-commerce) fictícia, criada como estudo de caso para o trabalho em grupo "Desenvolvimento de um site de E-Commerce", dentro do Curso de Informática Noturno do CTI Bauru - INF2.</p>
                    
                    <hr class="my-4">

                    <h3 class="h5">Sobre o Projeto</h3>
                    <p>O código-fonte pode ser obtido via GitHub, conforme orientações apresentadas ao longo do curso nas aulas presenciais.</p>
                    <p>Este estudo de caso pode ser utilizado livremente como base para outras lojas virtuais, sem ônus para o usuário.</p>
                    
                    <h3 class="h5 mt-4">Agradecimentos</h3>
                    <p>Gostaríamos de agradecer o apoio, orientações, instruções e coordenações recebidas dos Professores: Jovita Mercedes, Marcelo Cabello, José Vieira, André Luiz Bicudo, Debora Barbosa, e Vitor Assis. Que estiveram sempre com nossa equipe nos auxiliando em todo o projeto.</p>
                    <p>Nossa equipe, formada pelos alunos Guilherme, Irineu, João Paes, João Vitor, Mateus e Pedro, agradecem a todos os participantes e colaboradores.</p>

                    <figure class="text-center mt-5">
                        <blockquote class="blockquote">
                            <p class="display-6 fst-italic">MUITO OBRIGADO A TODOS!!</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Bons estudos e boa programação!
                        </figcaption>
                    </figure>

                </div>
            </div>
        </div>
    </main>

    
    <footer class="rodape"><?php include "rodape.php" ?></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>
</html>