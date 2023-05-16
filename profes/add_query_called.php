<?php
	require_once 'connect.php';
	require_once 'validate.php';
	require_once 'send_mail.php';

	if(ISSET($_POST['add_called'])){
		$room_id = $_POST['room_id'];
		$categoria_id = $_POST['categoria_id'];
		$assuntos = $_POST['assuntos'];
		$prioridade_id = $_POST['prioridade_id'];
		$menssagem = $_POST['menssagem'];
		$users_id = $_SESSION['users_id'];
		// Verifica se o chamado já está aberto
		$query = $conn->query("SELECT * FROM `chamados` WHERE `users_id` = '$users_id' AND `room_id` = '$room_id' AND `assuntos` = '$assuntos' AND `msg_chamado` = '$menssagem' AND `status_id` = 1 ") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Chamado já foi aberto.</label></center>";
		}else{
			$conn->query("INSERT INTO `chamados` (users_id, room_id, categoria_id, prioridade_id, assuntos, msg_chamado, status_id) VALUES('$users_id', '$room_id', '$categoria_id', '$prioridade_id', '$assuntos','$menssagem', 1)") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 23, users_id = '$users_id'") or die(mysqli_error());

			// Busca nome e email para enviar email de chamado aberto
            $respon = 'Responsável Laboratório';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ?");
            $stmt->bind_param("s", $respon);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nmadmin = $fadname. " " . $ladname;

            $stmt2 = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE users_id = ?");
            $stmt2->bind_param("i", $users_id);
            $stmt2->execute();
            $stmt2->bind_result($ftname, $ltname, $rpemail);
            $stmt2->fetch();

            $firstname = $ftname;
            $lastname = $ltname;
            $email = $rpemail;

            $nome = $firstname. " " . $lastname;
            $assunto = 'Chamado aberto - Reserve Lab';
            $message = "Menssagem enviada de: " .$nome. " - Email: " .$email." \n - Um chamado foi aberto para você.";

            // Chama função para enviar email
            sendMail($email, $nome, $assunto, $nmadmin, $ademail, $message);

			// Fecha a conexão com o banco de dados
            $stmt2->close();
            $conn->close();

		}
	}


?>