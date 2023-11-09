<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
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

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviarContato'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $mensagem = $_POST['mensagem'];

        if (empty($nome) || empty($email) || empty($mensagem)) {
            echo "<script>
                Swal.fire({
                    title: 'Erro',
                    text: 'Por favor, preencha todos os campos.',
                    icon: 'error',
                    confirmButtonColor: '#db3c3c'
                }).then(function () {
                    window.location.href = '/inovafin_site/faleConosco.html';
                });
            </script>";
        } else {

            include "conexao.php";

            if ($conexao) {
                $query = "INSERT INTO TB_FALECONOSCO (NOME_CONTATO, EMAIL_CONTATO, MSG_CONTATO) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($query);

                if ($stmt) {
                    $stmt->bind_param("sss", $nome, $email, $mensagem);

                    if ($stmt->execute()) {
                        echo "<script>
                            Swal.fire({
                                title: 'Sucesso',
                                text: 'Mensagem enviada com sucesso !!',
                                icon: 'success',
                                confirmButtonColor: '#28B65A'
                            }).then(function () {
                                window.location.href = '/inovafin_site/faleConosco.html';
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Erro',
                                text: 'Ocorreu um erro ao enviar a mensagem.',
                                icon: 'error',
                                confirmButtonColor: '#db3c3c'
                            }).then(function () {
                                window.location.href = '/inovafin_site/faleConosco.html';
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
                            window.location.href = '/inovafin_site/faleConosco.html';
                        });
                    </script>";
                }

                $close = $conexao->close();
                if (!$close) {
                    echo "<script>
                        Swal.fire({
                            title: 'Erro',
                            text: 'Erro no fechamento da conexão com o banco de dados.',
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
                        text: 'Erro na conexão com o banco de dados.',
                        icon: 'error',
                        confirmButtonColor: '#db3c3c'
                    }).then(function () {
                        window.location.href = '/inovafin_site/faleConosco.html';
                    });
                </script>";
            }
        }
    }
    ?>
</body>

</html>
