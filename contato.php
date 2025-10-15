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
    <title>Contato</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="container py-5"> <div class="row justify-content-center">
                <form class="col-12 col-md-8 col-lg-6"> 
                    <h1>Entre em Contato</h1>

                    <div class="form-floating"> <input type="text" id="txtNomeCompleto" class="form-control" placeholder=" " autofocus>
                        <label for="txtNomeCompleto">Nome Completo</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" id="txtEmail" class="form-control" placeholder=" ">
                        <label for="txtEmail">E-mail</label>
                    </div>

                    <div class="form-floating">
                        <textarea id="txtMensagem" class="form-control" placeholder="Mensagem"></textarea>
                        <label for="txtMensagem">Mensagem</label>
                    </div>

                    <div class="d-grid"> <button type="button" onclick="window.location.href='confirmcontato.html'"
                            class="btn btn-lg btn-danger">Enviar Mensagem</button>
                    </div>

                    <p class="mt-4"> Faremos nosso melhor para responder sua mensagem no mesmo dia.
                    </p>

                    <p class="mt-3">
                        Atenciosamente,<br>
                        Central de Relacionamento Biju Tech Online - Tel: (14) 98145-3093.
                    </p>
                </form>
            </div>
        </div>
    </main>
    
    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    

</body>
</html>