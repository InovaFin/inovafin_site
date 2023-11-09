<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/inovafin_site/css/styleFC.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
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

<body>

    <?php
    include "protectAdm.php";
    include "conexao.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['responderFC'])) {
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
                echo "<script>
                Swal.fire({
                    title: 'Erro',
                    text: 'Mensagem não encontrada.',
                    icon: 'error',
                    confirmButtonColor: '#db3c3c'
                }).then(function () {
                    window.location.href = '/inovafin_site/faleConosco.html';
                });
            </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Erro',
                text: 'Erro na consulta SQL.',
                icon: 'error',
                confirmButtonColor: '#db3c3c'
            }).then(function () {
                window.location.href = '/inovafin_site/faleConosco.html';
            });
        </script>";
        }

        $stmt->close();
        mysqli_close($conexao);
    }
    ?>

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
                                    <p><?php echo $_SESSION['email_contato']; ?></p>
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
                                <textarea class="campoForm" name="resposta_contato"></textarea>
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