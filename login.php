<?php
        session_start();    
        include "util.php"; 

        if ($_POST) {
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            if ($login == "admin" && $senha == "1234") {
                $_SESSION['sessaoConectado'] = true;
                $_SESSION['sessaoLogin'] = $login;
                header("Location: index.php");
                exit;
            } else {
                $erro = "Login ou senha invalidos!";
            }

        }
        
    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">
    

</head>
<body>
    
    <?php include "cabecalho.php"; ?>

    <main>
    <h1 class="heading"><span>Login</span></h1>

    <div class="box-cadastro">
    <form id="form-login" action="login.php" method="post">

        <div>
        <label for="email">Login:</label>
        <input type="text" name="login" id="login" placeholder="seu email" required> <br><br> 
        </div>

        <div>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="sua senha" required> <br><br>
        </div>
        
        <button type="submit" class="btn btn-center">Fazer Login</button>

        <?php if (isset($erro)) { ?>
                <p style="color:red;"><?php echo $erro; ?></p>
        <?php } ?>
        <!--<div id="erro-login"></div>-->
    </form>
    </div>

    <div class="links-login">

    <p>Não Possui uma Conta? <a href="cadastro.html">Crie Agora</a></p>
    <p>Esqueceu sua Senha? <a href="#">Clique Aqui</a></p>

    </div>
    </main>

    <script src="js/script.js"></script>
    <?php include "rodape.php" ?>

</body>
</html>