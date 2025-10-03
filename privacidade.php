<?php 
session_start();
include "util.php";
$conn = conecta();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colares</title>
</head>

    <!--Link dos ícones (busca, carrinho, login, etc)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Link dos ícones (busca, carrinho, login, etc)-->

    <link rel="stylesheet" href="css/style.css">

<body>

    <?php include "cabecalho.php" ?>

        <main class="flex-fill">
            <div class="container">
                <h2>Política Privacidade</h2>
                <p>A sua privacidade é importante para nós. É política do BijuTech Ltda respeitar a sua privacidade em
                    relação a qualquer informação sua que possamos coletar no site <a
                        href=http://www.dominio.com>BijuTech </a>, e outros sites que possuímos e operamos.</p>
                <p>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um
                    serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também
                    informamos por que estamos coletando e como será usado. </p>
                <p>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado.
                    Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas
                    e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</p>
                <p>Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando
                    exigido por lei.</p>
                <p>O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que
                    não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade
                    por suas respectivas <a href='https://politicaprivacidade.com' target='_BLANK'>políticas de
                        privacidade</a>.</p>
                <p>Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não
                    possamos fornecer alguns dos serviços desejados.</p>
                <p>O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de
                    privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do
                    usuário e informações pessoais, entre em contacto connosco.</p>
   </div>
        </main>
    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

</body>
</html>