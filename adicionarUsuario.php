<html>
  <body>
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

       
      <button type="submit">Cadastrar usuario</button>

    </form>
  </body>
</html>