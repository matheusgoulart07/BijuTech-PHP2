<?php 
session_start();
include "util.php";
verifica($_SESSION['admin']); 

$conn = conecta();
$varSQL = "SELECT * FROM produto WHERE excluido = false";
$select = $conn->query($varSQL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - BijuTech</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pgs-admin.css">
</head>
<body>
    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="admin-container">
            <div class="admin-content">
                <h1 class="admin-title">Lista de Produtos</h1>

                <a href="adicionarProduto.php" class="admin-button" style="margin-bottom: 1.5rem;">Adicionar Novo Produto</a>

                <div class="table-responsive-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Valor Unitário</th>
                                <th>Qtd. Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                                <?php $id = $linha['id_produto']; ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($linha['imagem'])): ?>
                                            <img src="<?= htmlspecialchars($linha['imagem']) ?>" alt="<?= htmlspecialchars($linha['nome']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($linha['nome']) ?></td>
                                    <td><?= htmlspecialchars($linha['descricao']) ?></td>
                                    <td>R$ <?= number_format($linha['valor_unitario'], 2, ',', '.') ?></td>
                                    <td><?= (int)$linha['qtd_estoque'] ?></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="alterarProduto.php?id_produto=<?= $id ?>" class="admin-button">Alterar</a>
                                            <a href="excluirProduto.php?id_produto=<?= $id ?>" class="admin-button admin-button-delete" onclick="return confirm('Deseja realmente excluir este produto?');">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>
</body>
</html>