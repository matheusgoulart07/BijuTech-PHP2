<?php 
session_start();
include "util.php";
$conn = conecta();
?>

<html>

  <head>
  <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="css/style.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
  </head>

  <body>

    <?php include "cabecalho.php" ?>

    <main class="form-crud form-adicionarProduto">
    <form action="insertProduto.php" method="post" enctype="multipart/form-data">
      
      Nome:
      <input type="text" name="nome" required>
      <br><br>

      Descrição:
      <textarea name="descricao" required></textarea>
      <br><br>

      Valor unitário:
      <input type="number" name="valor_unitario" step="0.01" required>
      <br><br>

      Quantidade em estoque:
      <input type="number" name="qtd_estoque" min="0" required>
      <br><br>

       Selecione uma imagem do produto (*.jpg, *.png):
      <input type="file" name="imagem" accept="image/*" required>
      <br><br>

      <button type="submit" class="btn btn center">Cadastrar Produto</button>

    </form>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

  </body>
</html>