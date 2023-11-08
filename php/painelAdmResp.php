<?php
include "protectAdm.php";
include "conexao.php";

$_SESSION['id_contato'] = $_POST['id_contato'];

$query = "SELECT * FROM TB_FALECONOSCO WHERE ID_CONTATO = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("s", $_SESSION['id_contato']);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $contato = $result->fetch_assoc();

    if ($contato) {
        $_SESSION['nome_contato'] = $contato['NOME_CONTATO'];
        $_SESSION['email_contato'] = $contato['EMAIL_CONTATO'];
        $_SESSION['msg_contato'] = $contato['MSG_CONTATO'];
    } else {
        echo '<script>alert("Mensagem não encontrada.");</script>';
    }
} else {
    echo '<script>alert("Erro na consulta SQL.");</script>';
}

$stmt->close();
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel ADM - InovaFin</title>
    <link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
</head>

<body class="fundoPainelAdm">
    <header>
        <div class="logo">
            <a href="/inovafin_site/index.html"><img src="/inovafin_site/img/InovaFin.png" alt="logoInovafin"></a>
        </div>
        <div class="painelAdm">
            <img src="/inovafin_site/img/iconPainelAdm.png" alt="">
            <p>Painel ADM</p>
        </div>
        <div class="btnSair">
            <button>
                <a href="logout.php"><img src="/inovafin_site/img/iconBtnSair.png" alt="logout">Sair</a>
            </button>
        </div>
    </header>

    <section class="main-painelAdm">
        <div class="container-adm">
            <div class="container-menuAdm">
                <p>Bem Vindo <?php echo $_SESSION['nomeAdm'] ?></p>

            </div>

            <div class="container-table">
                <div class="btnVoltarResp">
                    <a href="painelAdm.php"></a>
                </div>

                <p>Responder Mensagem</p>
                <div class="content-form">
                    <form method="post" action="respFaleConosco.php">
                        <div class="content-form1">
                            <div class="formResp-nome">
                                <p class="tituloForm">Nome:</p>
                                <div class="campoForm">
                                    <p><?php echo $_SESSION['nome_contato']; ?></p>
                                </div>
                            </div>
                            <div class="formResp-email">
                                <p class="tituloForm">Email:</p>
                                <div class="campoForm">
                                    <p ><?php echo $_SESSION['email_contato']; ?></p>
                                </div>
                            </div>  
                        </div>
                        <div class="content-form2">
                            <div class="formResp-mensagem">
                                <p class="tituloForm">Mensagem:</p>
                                <div class="campoForm">
                                    <p><?php echo $_SESSION['msg_contato']; ?></p>
                                </div>
                            </div>
                            <div class="formResp-resposta">
                                <p class="tituloForm">Resposta:</p>
                                <textarea class="campoForm" name="resposta_contato" required></textarea>
                            </div>
                        </div>
                        <button class="enviarResp" type="submit" name="enviarResp">Enviar Resposta</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>