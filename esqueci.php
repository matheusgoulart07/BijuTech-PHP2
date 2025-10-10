<html>

     <!-- para usar o "esqueci a senha"
          coloque um link pra esse arquivo no login.php 
          abaixo do form de login  -->

     <form action='' method='post'>
        Enviar recuperacao da senha para<br>
        <input type='email' name='email'>
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
</html>