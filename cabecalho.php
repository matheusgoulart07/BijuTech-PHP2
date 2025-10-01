<header class="header">

<a href="index.php" class="cabecalho"> 
            <img src="imagens/Logo sem fundo.png" alt="Logo Bijutech" class="logo">
            <span>BijuTech</span>
        </a>

        <nav class="menu-nav">

            <a href="#banner">Início</a>
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

            <div class="fa fa-bars" id="btn-menu"></div>
            <!--
            <div class="fa fa-search" id="btn-buscar"></div>
             -->
            <div class="fa fa-shopping-cart" id="btn-carrinho"></div>

            <?php 
            
            if (isset($_SESSION['sessaoConectado']) && $_SESSION['sessaoConectado']) {
                $login = isset($_SESSION['login']) ? $_SESSION['login'] : "Usuário";
                echo "<div class='fa fa-user' id='btn-login' title='Logado como $login'></div>";
                } else {
                    echo "<div class='fa fa-user' id='btn-login'></div>";
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
    
                echo "<a href='logout.php' class='btn'>Sair</a>";
            } else {
                echo "<a href='cadastro.php' class='btn'>Cadastro</a>";
                echo "<a href='login.php' class='btn'>Login</a>";
            }
            
            ?>
            
        </form>