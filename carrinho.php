<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

=======
<?php
session_start();
include "util.php";
$conn = conecta();

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Atualizar quantidade
if (isset($_POST['atualizar'])) {
    $index = $_POST['index'];
    $quantidade = max(1, (int) $_POST['quantidade']);
    $_SESSION['carrinho'][$index]['quantidade'] = $quantidade;
    $_SESSION['carrinho'][$index]['total'] = $_SESSION['carrinho'][$index]['preco'] * $quantidade;
    header("Location: carrinho.php");
    exit();
}

// Remover item
if (isset($_GET['remover'])) {
    $index = $_GET['remover'];
    unset($_SESSION['carrinho'][$index]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // reorganiza índices
    header("Location: carrinho.php");
    exit();
}

// Calcular total geral
$totalGeral = array_sum(array_column($_SESSION['carrinho'], 'total'));
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - BijuTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Ícones e estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
>>>>>>> 78bb4e0c8b86cb900d95f58a3aec0e27ccb36f18
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<<<<<<< HEAD
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
=======
    <?php include "cabecalho.php"; ?>

    <main class="carrinho-container">
        <h1 class="titulo-carrinho">Carrinho de Compras</h1>

        <?php if (empty($_SESSION['carrinho'])): ?>
            <div class="mensagem-vazia">Seu carrinho está vazio.</div>
            <a href="index.php" class="btn botao-continuar">Continuar comprando</a>
        <?php else: ?>

            <div class="table-wrapper">
                <table class="tabela-carrinho">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                            <tr class="item-carrinho">
                                <td class="produto">
                                    <?php if (!empty($item['imagem'])): ?>
                                        <img src="img/produtos/<?= htmlspecialchars($item['imagem']) ?>" width="60" alt="<?= htmlspecialchars($item['nome']) ?>" class="imagem-produto">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/60x60?text=Sem+Foto" alt="Sem imagem" class="imagem-produto">
                                    <?php endif; ?>
                                    <span class="nome-produto"><?= htmlspecialchars($item['nome']) ?></span>
                                </td>
                                <td class="descricao"><?= htmlspecialchars($item['descricao']) ?></td>
                                <td class="preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                <td class="quantidade">
                                    <form method="post" class="form-quantidade">
                                        <input type="hidden" name="index" value="<?= $index ?>">
                                        <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1" class="input-quantidade">
                                        <button type="submit" name="atualizar" class="btn atualizar">Atualizar</button>
                                    </form>
                                </td>
                                <td class="total-item">R$ <?= number_format($item['total'], 2, ',', '.') ?></td>
                                <td class="acoes">
                                    <a href="carrinho.php?remover=<?= $index ?>" class="btn remover" onclick="return confirm('Deseja remover este item?')">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="total-geral">
                            <td colspan="4" class="texto-total">Total Geral:</td>
                            <td colspan="2" class="valor-total">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="acoes-carrinho">
                <a href="index.php" class="btn continuar">Continuar comprando</a>
               <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="finalizarCompra.php" class="btn finalizar">Finalizar Compra</a>
               <?php else: ?>
                    <a href="login.php?redirect=finalizarCompra.php" class="btn finalizar">Finalizar Compra</a>
               <?php endif; ?>
            </div>

        <?php endif; ?>
    </main>

    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="script.js"></script>
</body>
</html>
>>>>>>> 78bb4e0c8b86cb900d95f58a3aec0e27ccb36f18
