<?php 

date_default_timezone_set('America/Sao_Paulo');

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

function verifica($param){

    if($param == false){
        header("Location: index.php");
    }

}

function valorsql1 ($paramConn, $paramSQL) 
    {
      // com query vc nao passa parametros, apenas $conn e frase SQL  
      $select = $paramConn->query($paramSQL);
      $select->execute();
      $linha = $select->fetch();
      return $linha[0];
      /* a funcao precisa funcionar qquer q seja o campo que esta sendo pedido,
         nesse ponto vc nao saberá qual o nome do campo q deve retornar, 
         por isso, vc usa o indice ZERO -  a vantagem desse comando eh 
         receber um unico valor */
    }
?>
