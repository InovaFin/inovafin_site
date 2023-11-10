
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
    <link rel="stylesheet" href="css/Style.css">
    <link rel="shortcut icon" href="img/favicon-inovafin.png" type="image/x-icon">
    <title>Fale Conosco - InovaFin</title>
</head>

<body class="fundoFaleConosco">

    <section class="faleConosco">
        <div class="formulario">

            <form action="php/envioFaleConosco.php" method="post">

                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" class="txtNome" maxlength="50">
                <br>

                <label for="email">Email:</label><br>
                <input type="email" name="email" class="txtEmail" maxlength="75">
                <br>

                <label for="mensagem">Deixe sua mensagem:</label><br>
                <textarea name="mensagem" class="txtMsg" maxlength="200"></textarea>

                <p>Aguarde sua resposta!</p>

                <input type="submit" name="enviarContato" class="botao">

                <a href="php/loginAdm.php">Responder fale conosco</a>
            </form>
            <div class="barra-central"></div>
            <img src="img/imagemFC.png" alt="imagem personagem inovafin">
        </div>

    </section>
</body>

</html>