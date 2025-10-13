<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BijuTech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
  
  <?php include "cabecalho.php" ?>

  <main class="esqueci-container">

     <!-- para usar o "esqueci a senha"
          coloque um link pra esse arquivo no login.php 
          abaixo do form de login  -->

     <form class="esqueci-form" action='' method='post'>
        <h2>Esqueci a Senha</h2>
        <p class="esqueci-texto">Enviar recuperação da senha para</p><br>
        <input type='email' name='email' placeholder="seu email">
        <input type='submit' value='Enviar'>
     </form>
     
     <?php
        include "util.php";
        include "emails.php";
        
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
          }

        if ( $_POST ) {   
          /*
            O usuario devera saber qual eh o seu email 
            para poder receber um link de recuperacao.
            O link de recuperacao eh uma chamada GET para um codigo php
            que vai receber um token, o token recebido na vdd eh a senha antiga 
            criptografada que foi obtida do email valido informado. 
            Essa senha sera trocada em redefinir.php.
            Ao receber o token e verificar se bate com a senha atual, 
            estamos assegurando que nao houve uma tentativa de quebra de seguranca. 
            Ai o programa pede nova senha e altera      
          */
          $conn = conecta();
          $email = $_POST['email'];
          $select = $conn->prepare("select nome,senha from usuario where email=:email ");
          $select->bindParam(':email',$email);
          $select->execute();
          $linha = $select->fetch();
          
          if ( $linha ) {
            
            $token = $linha['senha']; 
            
            $nome = $linha['nome'];
            
            $seusite = "eq3.inf2"; // por exemplo - mude para o nome do seu site ecommerce !!
            
            $html="<h4>Redefinir sua senha</h4><br>
                  <b>Oi $nome</b>, <br>
                  Clique no link para redefinir sua senha:<br>
                  http://$seusite.projetoscti.com.br/redefinir.php?token=$token";
            
            // guarda o email pra recuperar a senha em redefinir.php
            $_SESSION["email"] = $email;

            if ( EnviaEmail ( $email, '* Recupere a sua senha !! *', $html ) ) {
                  echo "<br><b>Email enviado com sucesso</b> (verifique sua caixa de spam se nao encontrar)";
            }   

          } else {
            echo "<br>Email não cadastrado";
          }

          echo "<br><br><a href='login.php'>Voltar</a>";
        }    
     ?>
     </main>

        <script src="js/script.js"></script>
        <footer class="rodape"><?php include "rodape.php" ?></footer>

     </body>
</html>