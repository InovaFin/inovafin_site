<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/inovafin_site/img/favicon-inovafin.png" type="image/x-icon">
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
    include "secret.php";

    // Inclui as bibliotecas do PHPMailer.
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Procura a pasta necessária do PHPmailer
    require 'PHPMailer/vendor/autoload.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['enviarResp'])) {

        // Obtém os valores dos campos do formulário.
        $nome = $_SESSION['nome_contato'];
        $email = $_SESSION['email_contato'];
        $mensagem = $_SESSION['msg_contato'];
        $resposta = $_POST['resposta_contato'];

        if (!empty($resposta)) {

            if ($_SESSION['formFC'] === 'nao-enviado') {

                $body = "
                <p>Prezado(a) $nome,</p>
                <p><strong>Esta mensagem é referente ao seu contato:</strong></p>
                <p>$mensagem</p>
                <p><strong>Resposta:</strong><br>$resposta</p>
                <hr style='border: 1px solid #ccc;'>
                <p>Estamos à disposição para fornecer qualquer assistência adicional que você possa necessitar.</p>
                <p>Atenciosamente, Inovafin.</p>
            ";

                // Cria uma instância do PHPMailer.
                $mail = new PHPMailer(true);

                try {
                    // Configurações do servidor SMTP para envio de e-mails.
                    $mail->SMTPDebug = 0;                                        // SMTP::DEBUG_SERVER. Achar erro DEBUG  
                    $mail->isSMTP();                                            // Define que o envio de e-mails será via SMTP.
                    $mail->CharSet = "UTF-8";
                    $mail->SMTPAuth = true;                                     // Ativa a autenticação SMTP.
                    $mail->Host = 'smtp.office365.com';                         // Especifica o servidor SMTP do Gmail.
                    $mail->Username = 'inovafin@outlook.com';                   // Define o nome de usuário do e-mail remetente.
                    $mail->Password = $senhaEmail;                               // Define a senha do e-mail remetente 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Define o tipo de criptografia para SMTP seguro.
                    $mail->Port = 587;                                          // Define a porta de conexão SMTP.

                    $mail->setFrom('inovafin@outlook.com', 'Inovafin');         // Remetente
                    $mail->addAddress($email, $nome);                           // Destinatário

                    $mail->isHTML(true);                                        // Define que o e-mail é em formato HTML.
                    $mail->Subject = 'Resposta Fale Conosco';                     // Assunto do e-mail.
                    $mail->Body = $body;                                          // Corpo do e-mail.

                    // Envia o e-mail.
                    if ($mail->send()) {
                        include "atualizarContato.php";
                    } else {
                        echo "<script>exibirAlerta('Erro', 'Erro ao enviar a mensagem: " . $mail->ErrorInfo . "',
                     'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";
                    }
                } catch (Exception $e) {
                    echo "<script>exibirAlerta('Erro', 'Erro ao enviar a mensagem: " . $e->getMessage() . "',
                 'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";
                }
            } else {
                echo "<script>exibirAlerta('Erro', 'Você já respondeu esta mensagem.',
                'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";
            }
        } else {
            echo "<script>exibirAlerta('Erro', 'O campo resposta está vazio. Por favor, insira uma resposta antes de enviar o e-mail.', 'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";
        }
    } else {
        echo "<script>exibirAlerta('Erro', 'Erro ao enviar email, acesso não foi via formulário.',
         'error', '#db3c3c', '/inovafin_site/php/painelAdmResp.php');</script>";
    }
    ?>
</body>

</html>