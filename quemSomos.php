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
    <title>Colares</title>
</head>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">

<body>
    
    <?php include "cabecalho.php" ?>

         <main class="pagina-quemSomos">
            <div class="container">
                <h1>Quem Somos</h1>
                <hr>
                <p>
                    BijuTech Ltda é uma loja virtual (e-commerce) fictícia, criada como estudo de caso para o trabalho em grupo
                    "Desenvolvimento de um site de E-Commerce", dentro do Curso de Informática Noturno do CTI Bauru - INF2.
   	<p>
 	  Gostaríamos de agradecer o apoio, orientações, instruções e coordenações recebidas dos
                    Profs.: Jovita Mercedes, Marcelo Cabello, José Vieira, André Luiz Bicudo, Debora Barbosa, e Vitor Assis. Que estiveram sempre com nossa equipe nos auxiliando em todo o projeto.
                </p>
                <p>
                    O código-fonte pode ser obtido via GitHub, conforme orientações apresentadas ao longo do 
                    curso nas aulas presenciais. 
	<p>
	Este estudo de caso pode ser utilizado livremente como base para outras lojas virtuais, sem ônus para o usuário.
                </p>
                <p>
                    Nossa equipe formada pelos alunos: Guilherme, Irineu, João Paes, João Vitor, Mateus e Pedro, agradecem a todos os participantes e colaboradores. 
    	 </p>
  	 <p>
	MUITO OBRIGADO a TODOS!!
                </p>
                <p>
                    Bons estudos e boa programação!
                </p>
            </div>
        </main>

    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

</body>
</html>