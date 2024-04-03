<?php
	function AntiSqlInjection($str, $conn) {
		$str = mysqli_real_escape_string($conn, $str);
		return $str;
	}
?>

<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_account_users'])){
		$firstname = AntiSqlInjection(ucwords(strtolower(trim($_POST['firstname']))), $conn);
		$lastname = AntiSqlInjection(ucwords(strtolower(trim($_POST['lastname']))), $conn);
		$status = $_POST['status'];
		$funcao = $_POST['funcao'];
		$email = trim($_POST['email']);
		$fone = $_POST['contactno'];
		$contactno = preg_replace('/[\s()-]+/', '', $fone);
		$identid = $_POST['cpf'];
		$cpf = str_replace(array('.', '-'), '', $identid);
		$password = AntiSqlInjection(trim($_POST['password']), $conn);
		$gp_approver_id = isset($_POST['manager_name']) && !empty($_POST['manager_name']) ? $_POST['manager_name'] : NULL;
		$first_lg = isset($_POST['checkbox']) ? NULL : 1; // Verifica se a caixa de seleção está marcada
		$session_id = $_SESSION['users_id'];
		$requestID = AntiSqlInjection($_REQUEST['users_id'], $conn);

		// verifica se encontra o ID do aprovador
		$queryrl = $conn->prepare("SELECT u.password FROM `users` as u	WHERE email = ? and users_id = ?") or die(mysqli_error($conn));
		$queryrl->bind_param("si", $email, $requestID);
		$queryrl->execute();
		$queryrl->bind_result($passwordVerification);
		$fetchap = $queryrl->fetch();
		$queryrl->close(); // Fecha a consulta
		
		$storedHashedPasswordAP = $passwordVerification;

		if ($fetchap) {
			// Verifica se o ID do usuário encontrado é o do administrador
			if ($password === $storedHashedPasswordAP) {
				$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `status` = '$status', `funcao` = '$funcao', `email` = '$email', `contactno` = '$contactno', `cpf` = '$cpf', `first_lg` = '$first_lg', `gp_approver_id` = '$gp_approver_id' WHERE `users_id` = '$requestID'") or die(mysqli_error($conn));
				$conn->query("INSERT INTO `activities` SET mensagens_id = 6, users_id = '$session_id'") or die(mysqli_error($conn));

				$query = $conn->query("SELECT * FROM `gr_approved` WHERE users_id = '$requestID'") or die(mysqli_error($conn));
				$valid = $query->num_rows;
				if($valid > 0){
					$conn->query("UPDATE `gr_approved` SET gp_approver_id = '$gp_approver_id' WHERE users_id = '$requestID'") or die(mysqli_error($conn));
				}else{
					$conn->query("INSERT INTO `gr_approved` SET gp_approver_id = '$gp_approver_id', users_id = '$requestID'") or die(mysqli_error($conn));
				}

				header("location:reservlab.php?edituser");
			}else{

				// Gera um hash criptográfico da senha usando o algoritmo bcrypt
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

				$conn->query("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `status` = '$status', `funcao` = '$funcao', `email` = '$email', `contactno` = '$contactno', `cpf` = '$cpf', `password` = '$hashedPassword', `first_lg` = '$first_lg', `gp_approver_id` = '$gp_approver_id' WHERE `users_id` = '$requestID'") or die(mysqli_error($conn));
				$conn->query("INSERT INTO `activities` SET mensagens_id = 6, users_id = '$session_id'") or die(mysqli_error($conn));
				
				$query = $conn->query("SELECT * FROM `gr_approved` WHERE users_id = '$requestID'") or die(mysqli_error($conn));
				$valid = $query->num_rows;
				if($valid > 0){
					$conn->query("UPDATE `gr_approved` SET gp_approver_id = '$gp_approver_id' WHERE users_id = '$requestID'") or die(mysqli_error($conn));
				}else{
					$conn->query("INSERT INTO `gr_approved` SET gp_approver_id = '$gp_approver_id', users_id = '$requestID'") or die(mysqli_error($conn));
				}

				header("location:reservlab.php?edituser");
			}
		}
	}
?>	