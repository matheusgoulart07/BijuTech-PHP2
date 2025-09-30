<?php 

session_start();
include "util.php";
if($_POST){
    $conn = conecta();
    $varSQL = "insert into usuario (nome,email,senha,telefone)
            values (:nome,:email,:senha,:telefone)";
    $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $insert= $conn->prepare($varSQL);
    $insert -> bindParam(':nome',$_POST['nome']);
    $insert -> bindParam(':email',$_POST['email']);
    $insert->bindParam(':senha', $senha_hash);
    $insert -> bindParam(':telefone',$_POST['telefone']);
   
    if ($insert->execute()) {
        $_SESSION['sessaoConectado'] = true;
        $_SESSION['admin'] = false;
        $_SESSION['login'] = $_POST['nome'];
        header("Location: index.php");
        exit("Redirecionando...");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <?php 
        include "cabecalho.php";
    ?>

    <main>
    <h1 class="heading"><span>Cadastro</span></h1>

    <div class="box-cadastro">
    <form id="form-cadastro" action="cadastro.php" method="post">

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" placeholder="exemplo@dominio.com" required>
    
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" required>
    
    <label for="telefone">Telefone</label>
    <input type="tel" name="telefone" id="telefone" placeholder="(14) 12345-6789" required>
    
    <button type="submit" class="btn btn-center">Fazer Cadastro</button>
     
    <div id="erro-cadastro"></div>
    </form>
    </div>
   
    </main>

    <script src="js/script.js"></script>
    <?php 
        include "rodape.php";
    ?>
    
</body>
</html>

