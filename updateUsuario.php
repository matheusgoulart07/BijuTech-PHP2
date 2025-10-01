<?php 
include "util.php";
$conn = conecta();

$id_usuario    = $_POST['id_usuario'];
$nome          = $_POST['nome'];
$email        = $_POST['email'];
$senha        = $_POST['senha'];
$telefone     = $_POST['telefone'];

$varSQL = "update usuario set nome = :nome, 
               email = :email, 
               senha = :senha, 
               telefone = :telefone
           where id_usuario = :id_usuario";

$update = $conn->prepare($varSQL);
$update->bindParam(':nome', $nome);
$update->bindParam(':email', $email);
$update->bindParam(':senha', $senha);
$update->bindParam(':telefone', $telefone);
$update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);


header("Location: usuario.php");
exit;
?>