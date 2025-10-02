<?php 
include "util.php"; 
$conn = conecta();

$varSQL = "select * from usuario";
$select = $conn->query($varSQL);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "cabecalho.php" ?>

<main class="pagina-crud pagina-usuarios">
<h2>Lista de Usuários</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while ($linha = $select->fetch()) {
            $id = $linha['id_usuario'];

                    echo "<tr>
            <td>".$linha['nome']."</td>
            <td>".$linha['email']."</td>
            <td>".$linha['senha']."</td>
            <td>".$linha['telefone']."</td>
            <td>
                <a href='alterarUsuario.php?id_usuario=$id'>Alterar</a>
                <a href='excluirUsuario.php?id_usuario=$id'>Excluir</a>
            </td>
        </tr>";
        }
        ?>
    </tbody>
</table>

<a href="adicionarUsuario.php" class="btn btn-add">Adicionar Usuário</a>
</main>

<?php include "rodape.php" ?>

</body>
</html>