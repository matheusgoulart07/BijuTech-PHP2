<?php   

        if ($_POST) {

            include "util.php";
            session_start();

            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            $redirect = $_GET['redirect'] ?? 'index.php';

            $conn = conecta();

            $select = $conn->prepare("select nome, senha, admin from usuario where email = :usuario");
            $select->bindParam(":usuario", $usuario);
            $select->execute();
            $linha = $select->fetch();

            if ($linha && password_verify($senha, $linha['senha']) ) {
                $_SESSION['sessaoConectado'] = true;
                $_SESSION['admin'] = $linha['admin'];
                $_SESSION['login'] = $linha['nome'];
                $_SESSION['usuario'] = [ 
                    'id' => $linha['id'],
                    'nome' => $linha['nome'],
                    'email' => $linha['email']
                ];
                header("Location: " . $redirect);
                exit;
            } else {
                $_SESSION['sessaoConectado'] = false;
                $_SESSION['admin'] = false;
                $_SESSION['login'] = "";
                $erro = "Usuário ou senha inválidos!";
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
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" placeholder="seu email" required> <br><br> 
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

    <p>Não Possui uma Conta? <a href="cadastro.php">Crie Agora</a></p>
    <p>Esqueceu sua Senha? <a href="esqueci.php">Clique Aqui</a></p>

    </div>
    </main>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>
</html>