<?php
include "util.php";
    $conn = conecta();
    $varSQL = "insert into (nome,email,senha,telefone)
            values (:nome,:email,:senha,:telefone)";
    $insert= $conn->prepare($varSQL);
    $insert -> bindParam(':nome',$_POST['nome']);
    $insert -> bindParam(':email',$_POST['email']);
    $insert -> bindParam(':senha',$_POST['senha']);
    $insert -> bindParam(':telefone',$_POST['telefone']);
    $insert ->execute();

?>