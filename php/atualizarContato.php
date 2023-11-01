<?php
include "protectAdm.php";
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviar'])) {

    $id_contato = $_SESSION['id_contato'];
    $resposta = $_POST["resposta_contato"];

    $query = "UPDATE TB_FALECONOSCO SET RESP_CONTATO = ? WHERE ID_CONTATO = ?";
    
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $resposta, $id_contato);
    
    if ($stmt->execute()) {
        echo '<script>alert("Mensagem enviada com sucesso.");</script>';
        echo '<script>window.location.href = "/inovafin_site/php/painelAdm.php";</script>';

    } else {
        echo '<script>alert("Erro ao atualizar a resposta: ' . $stmt->error . '");</script>';
    }
    
    $stmt->close();
} else {
    echo '<script>alert("Erro: Dados de formulário ausentes ou método de solicitação inválido.");</script>';
}

mysqli_close($conexao);
?>
