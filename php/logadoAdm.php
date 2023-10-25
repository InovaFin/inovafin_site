<?php
//verifica se ja existe uma session iniciada
if (!isset($_SESSION)) {
    session_start();
}

$usuario = $_POST['usuario_login'];
$senha = $_POST['senha_login'];

// Verifique se algum dos campos está vazio
if (empty($usuario) || empty($senha)) {
    echo "<script> alert('Por favor, preencha tanto o e-mail quanto a senha.')</script>";
    echo '<script>window.location.href = "/inovafin-jean/loginAdm.html";</script>';
} else {
    include "conexao.php";

    $query = "SELECT * FROM TB_CADASTRO_ADM WHERE EMAIL_ADM = '$usuario' AND SENHA_ADM = '$senha'";
    $result = $conexao->query($query);

    if ($result) {
        if ($result->num_rows > 0) {

            $_SESSION["controleAdm"] = "logado";

            while ($row = $result->fetch_assoc()) {

                $id_adm = $row['ID_ADM'];
                $_SESSION['IdAdm'] = $id_adm;

                $nome_adm = $row['NOME_ADM'];
                $_SESSION['nomeAdm'] = $nome_adm;

                $email_adm = $row['EMAIL_ADM'];
                $_SESSION['emailAdm'] = $email_adm;

                $senha_adm = $row['SENHA_ADM'];
                $_SESSION['senhaAdm'] = $senha_adm;

                header("Location: /inovafin-jean/php/painelAdm.php");
            }
        } else {
            echo "<script> alert('Usuário e/ou senha não confere!')</script>";
            echo '<script>window.location.href = "/inovafin-jean/loginAdm.html";</script>';
        }
    } else {
        echo "Erro na execução da consulta: " . $conexao->error;
    }

    $conexao->close();
}
?>
