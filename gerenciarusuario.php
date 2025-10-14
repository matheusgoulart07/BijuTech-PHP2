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
    <title>Gerenciar Usuário</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include "cabecalho.php" ?>

        <main class="flex-fill">
            <div class="container">
                <!-- Conteúdo da página gerenciarusuario.php -->
            </div>
        </main>
    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

</body>
</html>