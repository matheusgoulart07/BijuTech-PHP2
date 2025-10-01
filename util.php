<?php 

function conecta($param = "")
{
    if ($param == "")
    {
        $param = "pgsql:host=projetoscti.com.br;port=54432;dbname=eq3.inf2;user=eq3.inf2;password=eq32596";
    }

    try {
        $varConn = new PDO($param);
        $varConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $varConn;
    } catch (PDOException $e) {
        echo "<strong>Erro ao conectar ao banco de dados:</strong><br>";
        echo $e->getMessage(); 
        exit;
    }
}
?>
