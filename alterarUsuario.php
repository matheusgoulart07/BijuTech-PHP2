<html>
<body>
<?php 
include "util.php";
$conn = conecta();

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
</body>
</html>