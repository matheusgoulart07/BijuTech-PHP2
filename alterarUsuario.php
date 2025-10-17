<?php 
session_start();
include "util.php";
$conn = conecta();
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alterar Usuário - Produto</title>
  <link rel="stylesheet" href="css/style.css">
  <!--Link dos ícones (busca, carrinho, login, etc)-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include "cabecalho.php"; ?>

<?php 
$id_usuario = $_GET['id'] ?? null; // <-- Corrigido

if (!$id_usuario) {
    die("<p style='color:red'>Erro: ID do usuário não informado.</p>");
}

try {
    $varSQL = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
    $select = $conn->prepare($varSQL);
    $select->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $select->execute();
    $linha = $select->fetch(PDO::FETCH_ASSOC);

    if (!$linha) {
        die("<p style='color:red'>Erro: Usuário não encontrado.</p>");
    }

    $nome = $linha['nome'];
    $email = $linha['email'];
    $senha = $linha['senha'];
    $telefone = $linha['telefone'];

} catch (PDOException $e) {
    die("Erro ao buscar dados do usuário: " . $e->getMessage());
}
?>

    <main class="form-crud form-alterarUsuario">
        <form action="updateUsuario.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
            Nome:<br>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>
            Email:<br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>
            Senha:<br>
            <input type="password" name="senha" value="<?php echo htmlspecialchars($senha); ?>"><br><br>
            Telefone:<br>
            <input type="tel" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>"><br><br>
            <button type="submit">Salvar Alterações</button>
        </form>
    </main>

  <script src="js/script.js"></script>
  <footer class="rodape"><?php include "rodape.php"; ?></footer>

</body>

</html>