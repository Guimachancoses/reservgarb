<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/SMTP.php';
    function sendMail ($email, $nome, $assunto, $dtname, $dtemail, $message){
        // Cria uma nova instância do PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'guilherme.machancoses@gmail.com';
            $mail->Password = 'wntdhflnzjcnnwjj';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurações do email
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($dtemail, $dtname);
            $mail->addAddress( $email, $nome);
            $mail->Subject = $assunto;
            $mail->Body = $message;

            // Envia o email
            $mail->send();

            echo 'Email enviado com sucesso!';
        } catch (Exception $e) {
            echo 'Erro ao enviar o email: ', $mail->ErrorInfo;
        }
    }

?>