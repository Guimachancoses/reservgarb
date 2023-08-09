<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
	require_once 'connect.php';
	require_once 'validate.php';
	require_once 'send_mail.php';

	$users_id = $_SESSION['users_id'];
	if(ISSET($_POST['add_form'])){
		$query = $conn->query("SELECT * FROM `locacao` as lc WHERE lc.locacao_id = '$_REQUEST[locacao_id]' && lc.status_id = 2 ") or die(mysqli_error($conn));
		$row = $query->num_rows;
		if($row > 0){
			echo "<script>alert('Laboratório já reservado')</script>";
            echo "<script>hideOverlay();</script>";
		}else{
			$conn->query("UPDATE `locacao` SET `status_id` = 2, `mensagens_id` = 3  WHERE `locacao_id` = '$_REQUEST[locacao_id]'") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 3, users_id = '$users_id'") or die(mysqli_error($conn));

			// Busca nome e email do administrador
            $admin = 'Administrador';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ?");
            $stmt->bind_param("s", $admin);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nmadmin = $fadname. " " . $ladname;
            $email = $ademail;

            // Buscar dados do usuário que fez a locação, e os dados da locação para concatenar na mensagem
            $stmt2 = $conn->prepare("SELECT 
                                        us.firstname, 
                                        us.lastname, 
                                        us.email,
                                        COALESCE(lb.room_no, vs.model) as description,
                                        COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                        lc.checkin,  
                                        lc.checkin_time, 
                                        lc.checkout_time 
                                        FROM `locacao` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                        LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                        INNER JOIN `users` as u ON u.users_id = lc.users_id
                                        LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                        LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                        WHERE lc.locacao_id = ?");
            $stmt2->bind_param("i", $_REQUEST['locacao_id']);
            $stmt2->execute();
            $stmt2->bind_result($ftname, $ltname, $rpemail, $description, $locacao, $checkin, $checkin_time, $checkout_time);
            $stmt2->fetch();

            $firstname = $ftname;
            $lastname = $ltname;
            $dtemail = $rpemail;

            $dtnome = $firstname. " " . $lastname;
            $assunto = 'Confirmação de Reserva - Reserve Garbuio';
            $message = "Menssagem enviada de: \n \nAdministrador: " .$nmadmin. "\nEmail: " .$email." \n \nSeu pedido de reserva foi confimado. \n \nInformações da reserva:\n \n - Locação: " . $locacao. "\n - Data de início: " .$checkin. "\n - Hora de início: " . $checkin_time. "\n - Hora final: " . $checkout_time;

            $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Data de Início#'. $checkin.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';
            
            // Chama função para enviar email
            sendMail($email, $nmadmin, $assunto, $dtnome, $dtemail, $message, $dadosLocacao);

			// Fecha a conexão com o banco de dados
            $stmt2->close();
            $conn->close();

            echo "<script>hideOverlay();</script>";
			header("location:reservlab.php?penlab");
		}
	}
?>
