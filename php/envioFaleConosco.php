<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "<script>alert('Por favor, preencha todos os campos.')</script>";
    } else {

        include "conexao.php";

        if ($conexao) {
            $query = "INSERT INTO TB_FALECONOSCO (NOME_CONTATO, EMAIL_CONTATO, MSG_CONTATO) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sss", $nome, $email, $mensagem);

                if ($stmt->execute()) {
                    echo "<script>alert('Mensagem enviada com sucesso!')</script>";
                    echo '<script>window.location.href = "/inovafin-jean/index.html";</script>';

                } else {
                    echo "<script>alert('Ocorreu um erro ao enviar a mensagem.')</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Erro na preparação da instrução.')</script>";
            }

            $close = $conexao->close();
            if (!$close) {
                echo "<script>alert('Erro no fechamento da conexão com o banco de dados.')</script>";
            }
        } else {
            echo "<script>alert('Erro na conexão com o banco de dados.')</script>";
        }
    }
}
?>
