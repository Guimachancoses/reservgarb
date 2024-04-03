<?php
	require_once 'connect.php';
	require_once 'validate.php';
	require_once 'send_mail_per.php';

	$users_id = $_SESSION['users_id'];

    // Buscar o id do aprovador do grupo de aprovadores:
    $stmt = $conn->prepare("SELECT gp_approver_id FROM gp_approver as gp WHERE gp.users_id = ?");
    $stmt->bind_param("i", $users_id);
    $stmt->execute();
    $stmt->bind_result($gp_approver_id);
    $stmt->fetch();
    $stmt->close();
    
	if(ISSET($_POST['save_period'])){
        $locacaoID = $_REQUEST['lc_period_id'];        
		$query = $conn->query("SELECT * FROM `locacao` as lc WHERE lc.lc_period_id = '$locacaoID' && lc.mensagens_id = 3 ") or die(mysqli_error($conn));
		$row = $query->num_rows;
		if($row > 0){
			echo "<script>alert('Reserva já existe')</script>";
            echo '<script>hideOverlay();</script>';
		}else{
			$conn->query("UPDATE `locacao` SET `status_id` = 2, `mensagens_id` = 3, `gp_approver_id` = '$gp_approver_id' WHERE `lc_period_id` = '$locacaoID'") or die(mysqli_error($conn));
			$conn->query("UPDATE `lc_period` SET `mensagens_id` = 3, `gp_approver_id` = '$gp_approver_id' WHERE `lc_period_id` = '$locacaoID'") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 3, users_id = '$users_id'") or die(mysqli_error($conn));

			// Busca nome e email do aprovador para enviar email de confirmação de reserva
            $admin = 'Aprovador';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ? && users_id = ?");
            $stmt->bind_param("si", $admin, $users_id);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nome = $fadname. " " . $ladname;
            $email= $ademail;

            $stmt2 = $conn->prepare("SELECT 
                                        us.firstname, 
                                        us.lastname, 
                                        us.email,
                                        COALESCE(lb.room_no, vs.model) as description,
                                        COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                        CASE lc.weekday
                                        WHEN 'Monday' THEN 'Segunda-feira'
                                        WHEN 'Tuesday' THEN 'Terça-feira'
                                        WHEN 'Wednesday' THEN 'Quarta-feira'
                                        WHEN 'Thursday' THEN 'Quinta-feira'
                                        WHEN 'Friday' THEN 'Sexta-feira'
                                        WHEN 'Saturday' THEN 'Sábado'
                                        WHEN 'Sunday' THEN 'Domingo'
                                        ELSE 'Todos os dias' END AS dia_semana,
                                        lc.checkin, 
                                        lc.checkout, 
                                        lc.checkin_time, 
                                        lc.checkout_time 
                                        FROM `lc_period` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                        LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                        INNER JOIN `users` as u ON u.users_id = lc.users_id
                                        LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                        LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                        WHERE lc.lc_period_id = ?");
            $stmt2->bind_param("i", $locacaoID);
            $stmt2->execute();
            $stmt2->bind_result($ftname, $ltname, $rpemail, $description, $locacao, $weekday, $checkin, $checkout, $checkin_time, $checkout_time);
            $stmt2->fetch();

            $firstname = $ftname;
            $lastname = $ltname;
            $dtemail = $rpemail;
            $dtnome = $firstname. " " . $lastname;

            // Mensagem
            $assunto = 'Confirmação de Reserva - Reserve Garbuio';
            $message = "Menssagem enviada de: \n \nAdministrador: " .$nome. "\nEmail: " .$ademail." \n \nSeu pedido de reserva foi confimado. \n \nInformações da reserva:\n \n - Locação: " . $locacao. "\n - Data de início: " .$checkin. "\n - Data de final: " .$checkout. "\n - Dia da semana: " . $weekday. "\n - Hora de início: " . $checkin_time. "\n - Hora final: " . $checkout_time;

            $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Dia da Semana#'. $weekday.' * Data de Início#'. $checkin.' * Data Final#'. $checkout.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';
            
            // Chama função para enviar email
            sendMailPer ($email, $nome, $assunto, $dtnome, $dtemail, $message, $dadosLocacao);

			// Fecha a conexão com o banco de dados
            $stmt2->close();
            $conn->close();

			header("location:reservlab.php?penlab");
		}
	}
?>
