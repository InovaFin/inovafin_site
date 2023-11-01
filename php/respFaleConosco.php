<?php
include "protectAdm.php";
include "conexao.php";

// Inclui as bibliotecas do PHPMailer.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Procura a pasta necessária do PHPmailer
require 'PHPMailer/vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}

// Verifica se o formulário foi enviado (o botão "enviar" foi clicado).
if (isset($_POST['enviar'])) {
    // Obtém os valores dos campos do formulário.
    $nome = $_SESSION['nome_contato'];
    $email = $_SESSION['email_contato'];
    $mensagem = $_SESSION['msg_contato'];

    $resposta = $_POST['resposta_contato'];

    // Cria uma instância do PHPMailer.
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP para envio de e-mails.
        $mail->SMTPDebug = 0;                                       // Habilita a depuração do servidor SMTP para fins de teste.
        $mail->isSMTP();                                            // Define que o envio de e-mails será via SMTP.
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth = true;                                     // Ativa a autenticação SMTP.
        $mail->Host = 'smtp.office365.com';                         // Especifica o servidor SMTP do Gmail.
        $mail->Username = 'inovafin@outlook.com';                   // Define o nome de usuário do e-mail remetente.
        $mail->Password = 'Papaga!olistrado7';                      // Define a senha do e-mail remetente 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Define o tipo de criptografia para SMTP seguro.
        $mail->Port = 587;                                          // Define a porta de conexão SMTP.

        $mail->setFrom('inovafin@outlook.com', 'Inovafin');         // Remetente
        $mail->addAddress($email, $nome);                           // Destinatário

        $mail->isHTML(true);                                        // Define que o e-mail é em formato HTML.
        $mail->Subject = 'Inovafin - Resposta Fale Conosco';        // Assunto do e-mail.
        $mail->Body = $resposta;                                    // Corpo do e-mail.

        // Envia o e-mail.
        if ($mail->send()) {
            echo '<script>alert("Mensagem enviada com sucesso");</script>';
        } else {
            echo '<script>alert("Erro ao enviar a mensagem ' . $mail->ErrorInfo . '");</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("Erro ao enviar a mensagem ' . $e->getMessage() . '");</script>';
    }
} else {
    echo '<script>alert("Erro ao enviar email, acesso não foi via formulário");</script>';
}
?>