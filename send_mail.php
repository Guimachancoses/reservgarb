<?php
    // Função responsável por enviar os e-mails
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/Exception.php';
    require './phpmailer/src/SMTP.php';

    function sendMail ($email, $nome, $assunto, $dtname, $dtemail, $message){
        // Verifica se a internet está disponível
        if (!checkInternetAvailability()) {
            echo "<script>alert('Internet indisponível no momento, tente mais tarte!'); window.location.href = 'index.php';</script>";
            return;
        }

        // Define o tempo máximo de execução em 1 minuto (60 segundos)
        set_time_limit(60);

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
            $mail->setFrom($email, $nome);
            $mail->addAddress($dtemail, $dtname);
            $mail->Subject = $assunto;
            $mail->Body = $message;

            // Envia o email
            $mail->send();

            echo "<script>alert('Foi encaminhado um e-mail com as instruções para recuperar o seu acesso!'); window.location.href = 'index.php';</script>";
        } catch (Exception $e) {
            echo 'Erro ao enviar o email: ', $mail->ErrorInfo;
        }
    }

    // Função para verificar a disponibilidade da internet
    function checkInternetAvailability() {
        $dns = 'www.google.com';
        $timeout = 1;

        if (checkdnsrr($dns, 'A') || checkdnsrr($dns, 'AAAA')) {
            return true;
        }

        return false;
    }
?>
