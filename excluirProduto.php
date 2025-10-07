<?php 
include "util.php";
$conn = conecta();

$id_produto = $_GET['id_produto'];

$varSQL = "update produto 
           set excluido = true, data_exclusao = now() 
           where id_produto = :id_produto";

$delete = $conn->prepare($varSQL);
$delete->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);

$delete->execute();

header("Location: produtos.php");
exit;
?>