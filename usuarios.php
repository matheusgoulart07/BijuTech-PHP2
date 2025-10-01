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
</head>
<body>

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
                <td>";

            echo "</td>
                <td>
                    <a href='alterarUsuario.php?id_usuario=$id'>Alterar</a>
                    <a href='excluirUsuario.php?id_usuario=$id'>Excluir</a>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<a href="adicionarUsuario.php">Adicionar Usuário</a>

</body>
</html>