<?php
require_once "connect.php";
session_start(); // Inicia a sessão do usuário

if (isset($_SESSION['users_id'])) {
  // Se a variável de sessão 'users_id' estiver definida, o usuário já está logado
  // Redireciona o usuário para a página apropriada, dependendo do tipo de usuário
  if ($_SESSION['funcao'] == 'Administrador') {
    header('location: admin/reservlab.php');
    exit;
  } elseif ($_SESSION['funcao'] == 'Usuário') {
    header('location: profes/reservlab.php');
    exit;
  } elseif ($_SESSION['funcao'] == 'Aprovador') {
    header('location: resplab/reservlab.php');
    exit;
  }
}
// Se o usuário não estiver logado, exibe a página de login
// Seu código de login continua abaixo desta linha...
?>

<?php	 
	 
	ob_start();
	if(ISSET ($_POST['login'])){
		
		$email = $_POST['ra'];

		$password = $_POST['password'];
		$status = "5";

		// verifica se encontra o ID do admin		
		$queryad = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Administrador' && u.email = ? && u.status = ? ") or die(mysqli_error());
		$queryad->bind_param("ss", $email, $status);
		$queryad->execute();
		$queryad->bind_result($users_id, $passwordVerification);
		$fetchad = $queryad->fetch();
		$queryad->close(); // Fecha a consulta

		$storedHashedPasswordAD = $passwordVerification;

		// verifica se encontra o ID do usuário
		$querypr = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Usuário' && u.email = ? && u.status = ? ") or die(mysqli_error());
		$querypr->bind_param("ss", $email, $status);
		$querypr->execute();
		$querypr->bind_result($users_id, $passwordVerification);
		$fetchus = $querypr->fetch();
		$querypr->close(); // Fecha a consulta

		$storedHashedPasswordUS = $passwordVerification;

		// verifica se encontra o ID do aprovador
		$queryrl = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Aprovador' && u.email = ? && u.status = ? ") or die(mysqli_error());
		$queryrl->bind_param("ss", $email, $status);
		$queryrl->execute();
		$queryrl->bind_result($users_id, $passwordVerification);
		$fetchap = $queryrl->fetch();
		$queryrl->close(); // Fecha a consulta

		$storedHashedPasswordAP = $passwordVerification;
	
		// Verifica se o ID do usuário encontrado é o do administrador
		if ($fetchad) {
			if (password_verify($password, $storedHashedPasswordAD)) {
				session_start();
				$_SESSION['users_id'] = $users_id;
				$_SESSION['funcao'] = 'Administrador';
				header('location:admin/reservlab.php');
			}
		} elseif ($fetchus) {
			if (password_verify($password, $storedHashedPasswordUS)) {
				session_start();
				$_SESSION['users_id'] = $users_id;
				$_SESSION['funcao'] = 'Usuário';
				header('location:profes/reservlab.php');
			}
		} elseif ($fetchap) {
			if (password_verify($password, $storedHashedPasswordAP)) {
				session_start();
				$_SESSION['users_id'] = $users_id;
				$_SESSION['funcao'] = 'Aprovador';
				header('location:resplab/reservlab.php');
			}
		} else {
			echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
		}
					
	}
	ob_end_flush();
?>