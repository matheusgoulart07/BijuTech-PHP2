<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div id="cabecalho"></div>
    
    <main>
    <div class="pagina-carrinho"> 

        <h1 class="heading"><span>Carrinho</span></h1>

        <table>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>

            <tr>
                <td>
                    <div class="info-carrinho">
                        <img src="imagens/anel_dourado.png">
                        <div>
                            <p>Anel Dourado</p>
                            <small>Preço: R$15,00</small>
                            <br>
                            <a href="">Remover</a>
                        </div>
                    </div>
                </td>

                <td><input type="number" value="1"></td>
                <td>R$15,00</td>
            </tr>

            <tr>
                <td>
                    <div class="info-carrinho">
                        <img src="imagens/brinco_lua.png">
                        <div>
                            <p>Brinco de Lua</p>
                            <small>Preço: R$10,00</small>
                            <br>
                            <a href="">Remover</a>
                        </div>
                    </div>
                </td>

                <td><input type="number" value="1"></td>
                <td>R$10,00</td>
            </tr>

            <tr>
                <td>
                    <div class="info-carrinho">
                        <img src="imagens/colar_dourado.png">
                        <div>
                            <p>Colar Dourado</p>
                            <small>Preço: R$12,50</small>
                            <br>
                            <a href="">Remover</a>
                        </div>
                    </div>
                </td>

                <td><input type="number" value="1"></td>
                <td>R$12,50</td>
            </tr>

        </table>

        <div class="preco-total">

            <table>
                <tr> 
                    <td>Subtotal</td>
                    <td>R$37,50</td>
                </tr>

                 <tr>
                    <td>Taxa</td>
                    <td>R$00,00</td>
                </tr>

                 <tr>
                    <td>Total</td>
                    <td>R$37,50</td>
                </tr>
            </table>

            <a href="" class="btn">Confirmar</a>

        </div>
    </div>
    <?php
        function AtualizaGride(){
           echo $id_compra;
           $varSql="SELECT * FROM Compra_Produto where id_compra=$id_compra";
           foreach($varSql as $item){
               echo $item['id_compra'];
               if($status =="carrinho"){
                   echo"<tr>
                   <td>
                         <a href='incluirCarrinho.php?'>Incluir</a>
                        <a href='excluirCarrinho.php?'>Excluir</a>
                    </td>";
                }
                $total+=$subtotal;
            }
            echo"<tr>
                <td colspan=2>Total</td>
                <td>R$ $total</td>
                <td>Status</td>
                <td>$status</td>
                </tr>";
            if($_SESSION['STATUSCONECTADO']=="carrinho" and $total>0 and $status=="carrinho"){
                echo"<a href='finalizarCompra.php?id=$id_compra'>Finalizar Compra</a>";
            }
        }
        $SESSAO['SESSION_ID']=$session_id;
        $operacao=$_GET['operacao'];
        $id_produto=$_GET['id_produto'];
        $status="carrinho";
        $qt="Select count Compra where SESSAO=$session_id";
        $id_usuario=SESSAO["LOGIN"];
        if($qt==0){
            $hoje=date('Y-m-d');
            $conn=conecta();
            $varSql="INSERT INTO Compra (id,data_compra,id_sessao) values ($id_usuario, $hoje, $session_id)";
            $id_compra=$conn->lastInsertId();
        }
        else{
            if($SESSAO['CONECTADO']!=true){
                $varSql="SELECT id_compra, status FROM Compra where sessao=$id_usuario";
            }
            else{
                $varSql="SELECT id_compra, status FROM Compra where sessao=$session_id";
            }
                
        }
    ?>
    </main>

    <script src="js/script.js"></script>
     <footer class="rodape" id="rodape"></footer>

</body>
</html>