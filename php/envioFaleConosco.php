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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
    <script src="/inovafin_site/script/alerta.js"></script>
    <title>Fale Conosco - Inovafin</title>

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviarContato'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Verifica se algum campo está vazio
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "<script>exibirAlerta('Erro', 'Por favor, preencha todos os campos.',
            'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
    } else {
        if ($_SESSION['formFC'] === 'nao-enviado') {

            include "conexao.php";

            if ($conexao) {
                $query = "INSERT INTO tb_faleconosco (NOME_CONTATO, EMAIL_CONTATO, MSG_CONTATO) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($query);

                if ($stmt) {
                    $stmt->bind_param("sss", $nome, $email, $mensagem);

                    if ($stmt->execute()) {
                        echo "<script>exibirAlerta('Sucesso', 'Mensagem enviada com sucesso !!',
                            'success', '#28B65A', '/inovafin_site/faleConosco.php');</script>";
                        // Marcar o formulário como enviado
                        $_SESSION['formFC'] = 'enviado';
                    } else {
                        echo "<script>exibirAlerta('Erro', 'Ocorreu um erro ao enviar a mensagem.',
                            'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
                    }
                    $stmt->close();
                } else {
                    echo "<script>exibirAlerta('Erro', 'Erro na preparação da instrução.',
                        'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
                }

                $close = $conexao->close();
                if (!$close) {
                    echo "<script>exibirAlerta('Erro', 'Erro no fechamento da conexão com o banco de dados.',
                        'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
                }
            } else {
                echo "<script>exibirAlerta('Erro', 'Erro na conexão com o banco de dados.',
                    'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
            }
        } else {
            echo "<script>exibirAlerta('Erro', 'Você já enviou esta mensagem.',
                'error', '#db3c3c', '/inovafin_site/faleConosco.php');</script>";
        }
    }
}
?>
</body>

</html>