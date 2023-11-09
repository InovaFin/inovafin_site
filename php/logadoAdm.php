
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
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
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["botao"]) && $_POST["botao"] == "Logar") {
    $usuario = $_POST['usuario_login'];
    $senha = $_POST['senha_login'];

    // Verifique se algum dos campos está vazio
    if (empty($usuario) || empty($senha)) {
        echo "<script>
                Swal.fire({
                    title: 'Erro',
                    text: 'Por favor, preencha tanto o e-mail quanto a senha.',
                    icon: 'error',
                    confirmButtonColor: '#db3c3c'
                }).then(function () {
                    window.location.href = '/inovafin_site/php/loginAdm.php';
                });
            </script>";
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

                            echo "<script>
                                    Swal.fire({
                                        title: 'Sucesso',
                                        text: 'Login realizado com sucesso!',
                                        icon: 'success',
                                        confirmButtonColor: '#28B65A'
                                    }).then(function () {
                                        window.location.href = '/inovafin_site/php/painelAdm.php';
                                    });
                                </script>";
                            exit();
                        } else {
                            echo "<script>
                                    Swal.fire({
                                        title: 'Erro',
                                        text: 'Usuário e/ou senha não confere!',
                                        icon: 'error',
                                        confirmButtonColor: '#db3c3c'
                                    }).then(function () {
                                        window.location.href = '/inovafin_site/php/loginAdm.php';
                                    });
                                </script>";
                        }
                    } else {
                        echo "<script>
                                Swal.fire({
                                    title: 'Erro',
                                    text: 'Erro na execução da consulta.',
                                    icon: 'error',
                                    confirmButtonColor: '#db3c3c'
                                }).then(function () {
                                    window.location.href = '/inovafin_site/php/loginAdm.php';
                                });
                            </script>";
                    }
                } else {
                    echo "<script>
                            Swal.fire({
                                title: 'Erro',
                                text: 'Erro na execução da consulta.',
                                icon: 'error',
                                confirmButtonColor: '#db3c3c'
                            }).then(function () {
                                window.location.href = '/inovafin_site/php/loginAdm.php';
                            });
                        </script>";
                }

                $stmt->close();
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Erro',
                            text: 'Erro na preparação da instrução.',
                            icon: 'error',
                            confirmButtonColor: '#db3c3c'
                        }).then(function () {
                            window.location.href = '/inovafin_site/php/loginAdm.php';
                        });
                    </script>";
            }

            $conexao->close();

        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Erro',
                        text: 'Erro na conexão com o banco de dados.',
                        icon: 'error',
                        confirmButtonColor: '#db3c3c'
                    }).then(function () {
                        window.location.href = '/inovafin_site/php/loginAdm.php';
                    });
                </script>";
        }
    }
}
?>
</body>

</html>