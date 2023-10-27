<?php

    // Inclui as bibliotecas do PHPMailer.
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Procura a pasta necessaria do PHPmailer
    require 'PHPMailer/vendor/autoload.php';

    // Verifica se o formulário foi enviado (o botão "enviar" foi clicado).
    if (isset($_POST['enviar'])) {
        // Obtém os valores dos campos do formulário.
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $mensagem = $_POST["mensagem"];

        // Cria uma instância do PHPMailer.
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP para envio de e-mails.
            $mail->SMTPDebug = 0;                      // Habilita a depuração do servidor SMTP para fins de teste.
            $mail->isSMTP();                                            // Define que o envio de e-mails será via SMTP.
            $mail->Host = 'smtp.gmail.com';                             // Especifica o servidor SMTP do Gmail.
            $mail->SMTPAuth = true;                                     // Ativa a autenticação SMTP.
            $mail->Username = 'inovafincompany@gmail.com';              // Define o nome de usuário do e-mail remetente.
            $mail->Password = 'ufjc wnif bigk spgz';                    // Define a senha do e-mail remetente 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Define o tipo de criptografia para SMTP seguro.
            $mail->Port = 465;                                          // Define a porta de conexão SMTP.



            $mail->setFrom('inovafincompany@gmail.com', 'Inovafin');    //Remetende
            $mail->addAddress('jeancoelhoneves8@gmail.com', 'Jean');    //Ddestinatario

            $mail->isHTML(true);                                        // Define que o e-mail é em formato HTML.
            $mail->Subject = 'Teste - Resposta Fale Conosco';           // Assunto do e-mail.
            $mail->Body = $mensagem;                                    // Corpo do e-mail.

            // Envia o e-mail.
            $mail->send();
            echo 'Mensagem enviada com sucesso';
        } catch (Exception) {
            echo "Erro ao enviar a mensagem {$mail->ErrorInfo}";
        }
    } else {
        echo "Erro ao enviar email, acesso não foi via formulário";
    }
?>


