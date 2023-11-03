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
                <form method="post" action="respFaleConosco.php">
                    <p>Nome: <?php echo $_SESSION['nome_contato']; ?></p>
                    <p>Email: <?php echo $_SESSION['email_contato']; ?></p>
                    <p>Mensagem: <?php echo $_SESSION['msg_contato']; ?></p>

                    <textarea name="resposta_contato"></textarea>
                    <button type="submit" name="enviar">Enviar Resposta</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>