<?php
session_start();
include "util.php";

verifica($_SESSION['admin']);

// Carrega os arquivos de pedidos
$arquivos = glob("pedidos/PEDIDO-*.txt");
$statusFiltro = isset($_GET['status']) ? $_GET['status'] : "";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - BijuTech</title>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <!-- Fontes e estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Lato:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include "cabecalho.php"; ?>

    <main class="painel-admin-container">
        <h1 class="titulo-painel">Painel Administrativo - Gestão de Pedidos</h1>

        <nav class="painel-links">
            <a href="produtos.php" class="btn painel">Gerenciar Produtos</a>
            <a href="usuarios.php" class="btn painel">Gerenciar Usuários</a>
            <a href="adminPedidos.php" class="btn painel">Painel Administrativo</a>
            <a href="Admin_compras.php" class="btn painel">Gerenciar Compras</a>
        </nav>

        <!-- Filtro de status de pedido -->
        <section class="filtro-status">
            <form method="GET" class="form-filtro">
                <label for="status">Filtrar por status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="Aguardando" <?= $statusFiltro=='Aguardando'?'selected':'' ?>>Aguardando</option>
                    <option value="Pago" <?= $statusFiltro=='Pago'?'selected':'' ?>>Pago</option>
                    <option value="Cancelado" <?= $statusFiltro=='Cancelado'?'selected':'' ?>>Cancelado</option>
                </select>
            </form>
        </section>

        <!-- Lista de pedidos -->
        <section class="lista-pedidos">
            <?php
            if (empty($arquivos)) {
                echo "<p class='mensagem-vazio'>Nenhum pedido encontrado.</p>";
            } else {
                $temPedido = false;

                foreach ($arquivos as $arquivo) {
                    $conteudo = file_get_contents($arquivo);

                    // Filtra por status, se selecionado
                    if ($statusFiltro && strpos($conteudo, "Status: $statusFiltro") === false) {
                        continue;
                    }

                    $temPedido = true;
                    $pedidoId = basename($arquivo, ".txt");
                    ?>
                    <div class="pedido-card">
                        <pre class="conteudo-pedido"><?= htmlspecialchars($conteudo) ?></pre>

                        <form method="POST" action="confirmarPedido.php" class="botoes-pedido">
                            <input type="hidden" name="arquivo" value="<?= htmlspecialchars($arquivo) ?>">
                            <button name="status" value="Pago" class="btn pagar">Marcar como Pago</button>
                            <button name="status" value="Cancelado" class="btn cancelar">Cancelar Pedido</button>
                        </form>
                    </div>
                    <?php
                }

                if (!$temPedido) {
                    echo "<p class='mensagem-vazio'>Nenhum pedido com este status.</p>";
                }
            }
            ?>
        </section>
    </main>

     <footer class="rodape"><?php include "rodape.php" ?></footer>

</body>
</html>
