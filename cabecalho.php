<header class="header">

<a href="index.php" class="cabecalho"> 
            <img src="imagens/Logo sem fundo.png" alt="Logo Bijutech" class="logo">
            <span>BijuTech</span>
        </a>

        <nav class="menu-nav">

            <a href="index.php">Início</a>
            <a href="#categoria">Categorias</a>
            <a href="#produtos">Produtos</a>
            <a href="#rodape">Sobre</a>

            <?php 
            
            if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado'] && isset($_SESSION['admin']) && $_SESSION['admin']) {
                echo "<a href='usuarios.php'>Gerenciar Usuários</a>";
                echo "<a href='produtos.php'>Gerenciar Produtos</a>";
            }
            
            ?>

        </nav>

        <div class="icones">

            <div class="fa fa-bars icone-simples" id="btn-menu"></div>
            <!--
            <div class="fa fa-search" id="btn-buscar"></div>
             -->
            <div id="btn-carrinho" class="icone-botao">
                <i class="fa fa-shopping-cart"></i>
                <span>Carrinho</span>
            </div>

            <?php 
    if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado']) {
        $login = isset($_SESSION['login']) ? $_SESSION['login'] : "Usuário";
        echo "
        <div id='btn-login' class='icone-botao' title='Logado como $login'>
            <i class='fa fa-user'></i>
            <span>Login</span>
        </div>";
    } else {
        echo "
        <div id='btn-login' class='icone-botao'>
            <i class='fa fa-user'></i>
            <span>Login</span>
        </div>";
    }
    ?>
</div>
</header>
        
        <!--
        <form class="form-buscar">

            <input type="search" id="caixa-buscar" placeholder="Pesquise aqui">
            
            <label for="caixa-buscar" class="fa fa-search"></label>

        </form>
            -->


        <form action="#" class="form-login">
            <h3>Acessar Conta</h3>

            <?php 
            
            if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado']) {
                $login = $_SESSION['login'];
                echo "<p>Olá, <b>$login</b></p>";
    
                echo "<a href='logout.php' class='btn' onclick='return confirmarLogout()'>Sair</a>";
            } else {
                echo "<a href='cadastro.php' class='btn'>Cadastro</a>";
                echo "<a href='login.php' class='btn'>Login</a>";
            }
            
            ?>
            
        </form>
<script src="js/logout.js"></script>