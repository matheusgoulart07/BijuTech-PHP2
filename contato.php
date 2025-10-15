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
    <title>Contato - BijuTech</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom-layout.css"> </head>

<body>
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="container">
            <div class="content-wrapper">
                <form> 
                    <h1 class="page-title">Entre em Contato</h1>

                    <div class="form-group">
                        <input type="text" id="txtNomeCompleto" class="form-input" placeholder=" " autofocus>
                        <label for="txtNomeCompleto" class="form-label">Nome Completo</label>
                    </div>

                    <div class="form-group">
                        <input type="email" id="txtEmail" class="form-input" placeholder=" ">
                        <label for="txtEmail" class="form-label">E-mail</label>
                    </div>

                    <div class="form-group">
                        <textarea id="txtMensagem" class="form-textarea" placeholder=" "></textarea>
                        <label for="txtMensagem" class="form-label">Mensagem</label>
                    </div>

                    <div class="btn-wrapper">
                        <button type="button" onclick="window.location.href='confirmcontato.html'" class="btn">Enviar Mensagem</button>
                    </div>

                    <p style="margin-top: 1.5rem;">Faremos nosso melhor para responder sua mensagem no mesmo dia.</p>
                    <p style="margin-top: 1.5rem;">
                        Atenciosamente,<br>
                        Central de Relacionamento Biju Tech Online - Tel: (14) 98145-3093.
                    </p>
                </form>
            </div>
        </div>
    </main>
    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>
</body>
</html>