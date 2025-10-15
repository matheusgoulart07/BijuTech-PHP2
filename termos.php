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
    <title>Política de Trocas e Devoluções - BijuTech</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include "cabecalho.php" ?>

    <main class="flex-fill">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">

                    <h2 class="mb-4">Política de Trocas e Devoluções</h2>
                    <p class="text-muted">Última atualização: 14 de outubro de 2025</p>

                    <p>A BijuTech Ltda utiliza tecnologia de ponta para a fabricação de seus produtos, primando pela qualidade e satisfação de seus clientes. Pelo respeito e para que seja mantida a credibilidade conquistada junto aos seus consumidores, a empresa criou uma política de troca e devolução de acordo com o Código de Defesa do Consumidor, e preocupada para que você (cliente) obtenha uma negociação eficaz, ágil e principalmente satisfatória.</p>
                    
                    <hr class="my-4">

                    <h3 class="h5">Instruções Gerais</h3>
                    <p>Caso opte pelo contato via correio eletrônico ou telefônico, será encaminhado a você o formulário para preenchimento e envio junto à(s) peça(s). O produto devolvido sem esse formulário e/ou sem a comunicação ao SAC será reenviado sem consulta prévia.</p>
                    <p>Ao efetuar o processo de devolução/troca o cliente deverá, no verso da nota fiscal a ser devolvida/trocada, informar o motivo da devolução/troca, o nome de quem está devolvendo, CPF e a data da devolução.</p>
                    <p>Caso receba algum produto com a embalagem violada, recuse-o no ato da entrega.</p>
                    <p>Se a quantidade recebida divergir da nota fiscal, entre em contato conosco através de um dos canais disponibilizados no rodapé deste site.</p>
                    <p class="fw-bold text-danger">*ATENÇÃO: Para efetuar o processo de troca, é necessário estar logado.</p>

                    <h3 class="h5 mt-4">Devolução por Arrependimento/Desistência</h3>
                    <p>Se ao receber o produto, você resolver devolvê-lo por arrependimento, deverá fazê-lo em até sete dias corridos, a contar da data de recebimento, observando as seguintes condições:</p>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fa fa-check-circle text-success me-2"></i>O produto não poderá ter indícios de uso.</li>
                        <li class="mb-2"><i class="fa fa-check-circle text-success me-2"></i>O produto deverá ser encaminhado preferencialmente na embalagem original, acompanhado de nota fiscal, etiquetas, tags (etiqueta com código de referência do produto) devidamente fixada no produto e todos os seus acessórios.</li>
                        <li><i class="fa fa-check-circle text-success me-2"></i>Ao efetuar o processo de devolução, o cliente deverá, no verso da nota fiscal a ser devolvida, informar o motivo da recusa/devolução, o nome e o CPF de quem está devolvendo e a data da devolução.</li>
                    </ul>

                </div>
            </div>
        </div>
    </main>
    
    <footer class="rodape"><?php include "rodape.php" ?></footer>
    <script src="js/script.js"></script>

</body>
</html>