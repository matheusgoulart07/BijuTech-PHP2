<html>
  <body>
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

      <button type="submit">Cadastrar Produto</button>

    </form>
  </body>
</html>