<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["controleAdm"]) && $_SESSION["controleAdm"] == "logado") {
    header("Location: /inovafin_site/php/painelAdm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/inovafin_site/img/favicon-inovafin.png" type="image/x-icon">
    <link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
    <title>Login ADM - Inovafin</title>
</head>

<body class="fundoFaleConosco">
    <section class="container-loginADM">

        <div class="form-loginADM">

            <div class="menu-FC">
                <a href="/inovafin_site/faleConosco.php">
                    <div class="btnVoltarIndex"></div>
                </a>
            </div>

            <form action="logadoAdm.php" method="POST">
                <div class="form-top-loginADM">
                    <div class="titulo-loginADM">
                        <img src="/inovafin_site/img/iconPainelAdmVerde.png" alt="">
                        <p>Login ADM</p>
                    </div>
                    <p class="txt-restrito">*Acesso restrito, apenas administradores</p>
                </div>

                <div class="form-campo">
                    <label for="Usuários">Usuário:</label>
                    <input type="email" placeholder="Preencher E-mail" name="usuario_login" maxlength="50">
                </div>

                <div class="form-campo">
                    <label for="Senha">Senha:</label>
                    <input type="password" placeholder="Preencher Senha" name="senha_login" maxlength="8">
                </div>

                <div class="baixoForm-loginADM">
                    <div class="imgBaixoForm"><img src="/inovafin_site/img/InovafinTrans.png" alt=""></div>
                    <input type="submit" value="Logar" name="botao" class="botao">
                </div>

            </form>
        </div>
    </section>
</body>

</html>