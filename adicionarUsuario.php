<?php 
session_start();
include "util.php";
$conn = conecta();
?>

<html>

  <head>
  <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
  </head>

  <body>

    <?php include "cabecalho.php" ?>

    <main class="form-crud form-adicionarUsuario">
    <form action="insertUsuario.php" method="post" enctype="multipart/form-data">
      
      Nome:
      <input type="text" name="nome" required>
      <br><br>

      Email:
      <textarea name="email" required></textarea>
      <br><br>

      Senha:
      <input type="password" name="senha" required>
      <br><br>

      Telefone:
      <input type="tel" name="telefone" required>
      <br><br>

       
      <button type="submit">Cadastrar Usuário</button>

    </form>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

  </body>
</html>