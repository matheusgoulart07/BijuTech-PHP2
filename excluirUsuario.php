<?php 
include "util.php";
$conn = conecta();

$id_usuario = $_GET['id_usuario'];

$varSQL = "update usuario
           set excluido = true 
           where id_usuario = :id_usuario";

$delete = $conn->prepare($varSQL);
$delete->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

$delete->execute();

header("Location: usuario.php");
exit;
?>