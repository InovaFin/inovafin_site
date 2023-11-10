<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
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

<body>

<?php
include "protectAdm.php";
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviarResp'])) {

    $id_contato = $_SESSION['id_contato'];
    $resposta = $_POST["resposta_contato"];

    $query = "UPDATE TB_FALECONOSCO SET RESP_CONTATO = ? WHERE ID_CONTATO = ?";
    
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $resposta, $id_contato);
    
    if ($stmt->execute()) {
        echo "<script>exibirAlerta('Sucesso', 'Mensagem respondida com sucesso !!',
         'success', '#28B65A', '/inovafin_site/php/painelAdm.php?mode=respondidas');</script>";

    } else {
        echo "<script>exibirAlerta('Erro', 'Erro ao atualizar a resposta: " . $stmt->error . "', 'error',
         '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";

    }
    $stmt->close();
} else {
    echo "<script>exibirAlerta('Erro', 'Dados de formilário ausentes ou método de solicitação inválido',
     'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";

}

mysqli_close($conexao);
?>

</body>
</html>
