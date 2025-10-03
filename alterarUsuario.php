<?php 
session_start();
include "util.php";
$conn = conecta();
?>

<html>

<head>
  <meta charset="UTF-8">
    <title>Alterar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->
</head>

<body>

<?php include "cabecalho.php" ?>

<?php 
$id_usuario = $_GET['id_usuario'];

$varSQL = "select * from usuario where id_usuario = :id_usuario";
$select = $conn->prepare($varSQL);
$select->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$select->execute();

$linha = $select->fetch();

$nome = $linha['nome'];
$email = $linha['email'];
$senha = $linha['senha'];
$telefone = $linha['telefone'];


?>

<main class="form-crud form-alterarUsuario">
<form action="updateUsuario.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">

    Nome:
    <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>

    Email:
    <textarea name="email"><?php echo htmlspecialchars($email); ?></textarea><br><br>

    Senha:
    <input type="password" name="senha" value="<?php echo htmlspecialchars($senha); ?>"><br><br>

    Telefone:
    <input type="tel" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>"><br><br>


    <button type="submit">Salvar Alterações</button>
</form>
</main>

<footer class="rodape"><?php include "rodape.php" ?></footer>
<script src="js/script.js"></script>

</body>
</html>