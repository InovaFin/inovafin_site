<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["botao"]) && $_POST["botao"] == "Logar") {
    $usuario = $_POST['usuario_login'];
    $senha = $_POST['senha_login'];

    // Verifique se algum dos campos está vazio
    if (empty($usuario) || empty($senha)) {
        echo "<script>alert('Por favor, preencha tanto o e-mail quanto a senha.')</script>";
        echo '<script>window.location.href = "/inovafin_site/php/loginAdm.php";</script>';
    } else {

        include "conexao.php";

        if ($conexao) {
            $query = "SELECT * FROM TB_CADASTRO_ADM WHERE EMAIL_ADM = ? AND SENHA_ADM = ?";
            $stmt = $conexao->prepare($query);

            if ($stmt) {
                // Verifique se a consulta preparada foi bem-sucedida
                $stmt->bind_param("ss", $usuario, $senha);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result) {
                        if ($result->num_rows > 0) {
                            // Iniciar a sessão do usuário logado
                            $_SESSION["controleAdm"] = "logado";

                            while ($row = $result->fetch_assoc()) {
                                // Armazenar informações do usuário na sessão
                                $_SESSION['IdAdm'] = $row['ID_ADM'];
                                $_SESSION['nomeAdm'] = $row['NOME_ADM'];
                                $_SESSION['emailAdm'] = $row['EMAIL_ADM'];
                                $_SESSION['senhaAdm'] = $row['SENHA_ADM'];
                            }

                            header("Location: /inovafin_site/php/painelAdm.php");
                            exit();
                        } else {
                            echo "<script>alert('Usuário e/ou senha não confere!')</script>";
                            echo '<script>window.location.href = "/inovafin_site/php/loginAdm.php";</script>';
                        }
                    } else {
                        echo "<script>alert('Erro na execução da consulta.')</script>";
                    }
                } else {
                    echo "<script>alert('Erro na execução da consulta.')</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Erro na preparação da instrução.')</script>";
            }

            $conexao->close();

        } else {
            echo "<script>alert('Erro na conexão com o banco de dados.')</script>";
        }
    }
}
?>
