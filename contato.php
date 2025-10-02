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

        <main class="flex-fill">
            <div class="container">
                <div class="row justify-content-center">
                    <form class="col-sm-10 col-md-8 col-lg-6">
                        <h1>Entre em Contato</h1>

                        <div class="form-floating mb-3">
                            <input type="text" id="txtNomeCompleto" class="form-control" placeholder=" " autofocus>
                            <label for="txtNomeCompleto">Nome Completo</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" id="txtEmail" class="form-control" placeholder=" ">
                            <label for="txtEmail">E-mail</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea id="txtMensagem" class="form-control" placeholder=" "
                                style="height: 200px;"></textarea>
                            <label for="txtMensagem">Mensagem</label>
                        </div>

                        <button type="button" onclick="window.location.href='confirmcontato.html'"
                            class="btn btn-lg btn-danger">Enviar Mensagem</button>

                        <p class="mt-3">
                            Faremos nosso melhor para responder sua mensagem no mesmo dia.
                        </p>

                        <p class="mt-3">
                            Atenciosamente,<br>
                            Central de Relacionamento Biju Tech Online - Tel: (14) 98145-3093.
                        </p>
                    </form>
                </div>
            </div>
        </main>
    
    <?php include "rodape.php" ?>
    <script src="js/script.js"></script>

</body>
</html>