<?php
    // Função responsável por verificar dados recebidos para recuperar o acesso do usuário
    require_once "connect.php";
    require_once "send_mail.php";

    if(ISSET($_POST['forgot_key'])){
        // Recebe os dados do formulário
        $email = trim($_POST['email']);
        // remove a barra e o traço e deixa apenas os números
        $identid = $_POST['cpf'];
		$cpf = str_replace(array('.', '-'), '', $identid);
                
        // Consulta no banco se existe os dados do usuário
        $queryad = $conn->prepare("SELECT * FROM `users` WHERE email = ? && cpf = ?") or die(mysqli_error());
        $queryad->bind_param('ss', $email, $cpf);
        $queryad->execute();
        $queryad->store_result();
        $valid = $queryad->num_rows();
        // Se existe os dados do usuarios envia email com código para verificação
        if ($valid > 0){

            // Busca nome do adminsitrador para enviar email de solicitação pendente
            $admin = 'Administrador';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ? LIMIT 1");
            $stmt->bind_param("s", $admin);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nmadmin = $fadname. " " . $ladname;

            // Coleta os dados do usuários
            $stmt2 = $conn->prepare("SELECT users_id, firstname, lastname FROM `users` WHERE email = ?  && cpf = ?");
            $stmt2->bind_param("ss", $email, $cpf);
            $stmt2->execute();
            $stmt2->bind_result($usersId, $ftname, $ltname);
            $stmt2->fetch();

            $nmdestin = $ftname. " " . $ltname;
            $emailUser = $email;
            $users_id = $usersId;

            $stmt2->close();

            // Gera o código aleatório com 8 dígitos
            $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $lowercase = 'abcdefghijklmnopqrstuvwxyz';
            $numbers = '0123456789';
            $specialChars = '!@#$%^&*()';

            $hash = '';
            $hash .= $uppercase[random_int(0, strlen($uppercase) - 1)];
            $hash .= $lowercase[random_int(0, strlen($lowercase) - 1)];
            $hash .= $numbers[random_int(0, strlen($numbers) - 1)];
            $hash .= $specialChars[random_int(0, strlen($specialChars) - 1)];

            while (strlen($hash) < 8) {
                $characters = $uppercase . $lowercase . $numbers . $specialChars;
                $randomChar = $characters[random_int(0, strlen($characters) - 1)];
                $hash .= $randomChar;
            }

            // Embaralhar os caracteres do hash gerado
            $codigo = str_shuffle($hash);

            // Insere no banco de dados em uma tabela unica para código gerado e ID de usuário, para mudar a senha de acesso.
            $stmt = $conn->prepare("INSERT INTO pwdtemp (users_id, email, codigo) VALUES (?, ?, ?)") or die(mysqli_error());
            $stmt->bind_param("sss", $users_id, $email, $codigo);
			$stmt->execute();
			$stmt->close();

            $assunto = 'RESERVE GARBUIO - Recuperar sua senha';
            $message = "ESSA MENSAGEM É AUTOMÁTICA, FAVOR NÃO RESPONDER.\n \nOlá, ". $nmdestin."."."\n \nVocê tem uma mensagem enviada de:\n___________________________________________\n \n Administrador: " .$ademail. "\n Email: " .$email." \n___________________________________________\n \n - Para recuperar sua senha acesse o link abaixo.\n \nPor favor, acesse o seguinte link para validar seu código: http://localhost/reservgarb/forgot/validateuser.php\n" ."\nCódigo: ".$codigo;

            sendMail($ademail, $nmadmin, $assunto, $nmdestin, $emailUser, $message, $codigo);
        } else {
            echo "<script>alert('Usuário não cadastrado no sistema.') window.location.href = '../index.php';</script>";
        }
    }
?>

