<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/inovafin_site/img/favicon-inovafin.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <script src="/inovafin_site/script/alerta.js"></script>
    <title>Painel ADM - Inovafin</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: radial-gradient(70% 65% at 50% 50%, #3ac069 0%, #075925 83.98%);
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="fundoFaleConosco">

    <?php
    include "protectAdm.php";
    include "conexao.php";

    if (!isset($_SESSION['formFC']) || $_SESSION['formFC'] === 'enviado') {
        $_SESSION['formFC'] = 'nao-enviado';
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['responderFC'])) {
        $_SESSION['id_contato'] = $_POST['id_contato'];

        $query = "SELECT * FROM tb_faleconosco WHERE ID_CONTATO = ?";
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
                echo "<script>exibirAlerta('Erro', 'Mensagem não encontrada.',
                 'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
            }
        } else {
            echo "<script>exibirAlerta('Erro', 'Erro na consulta SQL.',
             'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
        }

        $stmt->close();
        mysqli_close($conexao);
    }
    ?>

    <header>
        <div class="logo">
            <a href="/inovafin_site/index.html"><img src="/inovafin_site/img/inovafin.png" alt="logoInovafin"></a>
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
                <p>Bem Vindo, <?php echo $_SESSION['nomeAdm'] ?></p>
            </div>

            <div class="container-table">
                <div class="btnVoltarResp">
                    <a href="painelAdm.php"></a>
                </div>

                <p>Responder Mensagem</p>
                <div class="content-form-resp">
                    <form method="post" action="respFaleConosco.php">
                        <div class="content-form-resp1">
                            <div class="formResp-nome">
                                <p class="tituloForm">Nome:</p>
                                <div class="campoForm">
                                    <p><?php echo $_SESSION['nome_contato']; ?></p>
                                </div>
                            </div>
                            <div class="formResp-email">
                                <p class="tituloForm">Email:</p>
                                <div class="campoForm">
                                    <p><?php echo $_SESSION['email_contato']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="content-form-resp2">
                            <div class="formResp-mensagem">
                                <p class="tituloForm">Mensagem:</p>
                                <div class="campoForm">
                                    <p><?php echo $_SESSION['msg_contato']; ?></p>
                                </div>
                            </div>
                            <div class="formResp-resposta">
                                <p class="tituloForm">Resposta:</p>
                                <textarea class="campoForm" name="resposta_contato"></textarea>
                            </div>
                        </div>

                        <div class="baixoForm">
                            <div class="imgBaixoForm"><img src="/inovafin_site/img/InovaFinTrans.png" alt=""></div>
                            <button class="enviarResp" type="submit" name="enviarResp">Enviar Resposta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>