<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['formFC']) || $_SESSION['formFC'] === 'enviado') {
    $_SESSION['formFC'] = 'nao-enviado';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleFC.css">
    <link rel="shortcut icon" href="img/favicon-inovafin.png" type="image/x-icon">
    <title>Fale Conosco - InovaFin</title>
</head>

<body class="fundoFaleConosco">

    <section class="faleConosco">
        <div class="content-FC">

            <div class="menu-FC">
                <a href="index.html">
                    <div class="btnVoltarIndex"></div>
                </a>
                <a href="php/loginAdm.php" class="irPainelAdm">
                    <img src="img/iconPainelAdmVerde.png" alt="icone painel adm">
                    <p>Painel ADM</p>
                </a>
            </div>

            <div class="formulario">
                <form action="php/envioFaleConosco.php" method="post">

                    <p class="tituloFormFC">Fale Conosco</p>

                    <div>
                        <label for="nome">Nome:</label><br>
                        <input type="text" name="nome" class="txtNome" maxlength="50">
                    </div>

                    <div>
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" class="txtEmail" maxlength="75">
                    </div>

                    <div>
                        <label for="mensagem">Deixe sua mensagem:</label><br>
                        <textarea name="mensagem" class="txtMsg" maxlength="200"></textarea>
                        <p class="txtAguarde">Aguarde sua resposta!</p>
                    </div>

                    <div class="baixoForm">
                        <div class="imgBaixoForm"><img src="img/InovaFinTrans.png" alt=""></div>
                        <input type="submit" name="enviarContato" class="botao">
                    </div>

                </form>
                <div class="barra-central"></div>
                <img src="img/imagemFC1.png" alt="imagem personagem inovafin">
            </div>
        </div>

    </section>
</body>

</html>