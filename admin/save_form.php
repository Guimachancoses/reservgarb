<?php
	require_once 'connect.php';
	require_once 'validate.php';
	require_once 'send_mail.php';

	$users_id = $_SESSION['users_id'];
	if(ISSET($_POST['add_form'])){
		$query = $conn->query("SELECT * FROM `locacao` as lc WHERE lc.locacao_id = '$_REQUEST[locacao_id]' && lc.status_id = 2 ") or die(mysqli_error());
		$row = $query->num_rows;
		if($row > 0){
			echo "<script>alert('Laboratório já reservado')</script>";
		}else{
			$conn->query("UPDATE `locacao` SET `status_id` = 2, `mensagens_id` = 3  WHERE `locacao_id` = '$_REQUEST[locacao_id]'") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 3, users_id = '$users_id'") or die(mysqli_error());

			// Busca nome e email para enviar email de chamado aberto
            $admin = 'Administrador';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ?");
            $stmt->bind_param("s", $admin);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nmadmin = $fadname. " " . $ladname;

            $stmt2 = $conn->prepare("SELECT firstname, lastname, email FROM `users` as us INNER JOIN `locacao` as lc ON lc.users_id = us.users_id WHERE lc.locacao_id = ?");
            $stmt2->bind_param("i", $_REQUEST['locacao_id']);
            $stmt2->execute();
            $stmt2->bind_result($ftname, $ltname, $rpemail);
            $stmt2->fetch();

            $firstname = $ftname;
            $lastname = $ltname;
            $email = $rpemail;

            $nome = $firstname. " " . $lastname;
            $assunto = 'Confirmação de Reserva - Reserve Lab';
            $message = "Menssagem enviada de: \nUsuário: " .$nome. "\nEmail: " .$email." \n - Seu pedido de reserva foi confimado.";

            // Chama função para enviar email
            sendMail($email, $nome, $assunto, $nmadmin, $ademail, $message);

			// Fecha a conexão com o banco de dados
            $stmt2->close();
            $conn->close();

			header("location:reservlab.php?penlab");
		}
	}
?>
