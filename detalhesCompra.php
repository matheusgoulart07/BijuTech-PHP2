<?php
session_start();
include 'util.php';
$conn = conecta();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sel = $conn->prepare("SELECT cp.*, p.nome FROM compra_produto cp JOIN produto p ON cp.fk_produto = p.id_produto WHERE fk_compra = :id");
$sel->bindParam(':id',$id);
$sel->execute();
$itens = $sel->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes das Compras - BijuTech</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php" ?>

    <h1>Detalhes da Compra</h1>

    <h2>Itens da Compra #<?= $id ?></h2>
    <table border="1" cellpadding="6"><tr><th>Produto</th><th>Quantidade</th><th>Valor Unit.</th></tr>
    <?php foreach($itens as $it): ?>
    <tr>
    <td><?= htmlspecialchars($it['nome']) ?></td>
    <td><?= $it['quantidade'] ?></td>
    <td>R$ <?= number_format($it['valor_unitario'],2,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
    </table>

    <script src="js/script.js"></script>
    <footer class="rodape"><?php include "rodape.php"; ?></footer>

</body>

</html>