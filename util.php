<?php 

function conecta($param = "")
{
    if ($param == "")
    {
        $param = "pgsql:host=localhost;port=5432;dbname=ecommerce;user=postgres;password=postgres";
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