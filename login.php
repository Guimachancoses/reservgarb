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
function AntiSqlInjection($str, $conn) {
    $str = mysqli_real_escape_string($conn, $str);
    return $str;
}
?>

<?php

	ob_start();
	if(ISSET ($_POST['login'])){
		
		$email = AntiSqlInjection($_POST['ra'], $conn);

		$password = AntiSqlInjection($_POST['password'], $conn);
		$status = "5";
		// Antes de executar qualquer código, define o tempo de espera em minutos
		$waitTime = 5;

		// Verifica se o usuário já fez 5 tentativas de login sem sucesso nos últimos 5 minutos
		$failedAttempts = 5;
		$blockTime = date('Y-m-d H:i:s', strtotime("-$waitTime minutes"));

		$queryAttempts = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE email = ? AND attempt_time < ?");
		$queryAttempts->bind_param("ss", $email, $blockTime);
		$queryAttempts->execute();
		$queryAttempts->bind_result($numAttempts);
		$queryAttempts->fetch();
		$queryAttempts->close();

		if ($numAttempts >= $failedAttempts) {

			$queryAttempts = $conn->prepare("SELECT attempt_time FROM login_attempts WHERE email = ? ORDER BY id DESC LIMIT 1");
			$queryAttempts->bind_param("s", $email);
			$queryAttempts->execute();
			$queryAttempts->bind_result($attempt_User);
			$queryAttempts->fetch();
			$queryAttempts->close();

			// Converter a string para um objeto DateTime
			$attempt_DateTime = new DateTime($attempt_User);

			// Adicionar 5 minutos ao objeto DateTime
			$attempt_DateTime->add(new DateInterval('PT5M'));

			// Formatar a nova data para o formato desejado (opcional)
			$attempt_New = $attempt_DateTime->format('Y-m-d H:i:s');

			// Verifica se passou o tempor dos 5 minutos
			if ($blockTime <= $attempt_New) {
				// Se o passou os 5 minutos, delete a tentativa mal sucedida no banco de dados
				$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
				$queryDeleteAttempt->bind_param("s", $email);
				$queryDeleteAttempt->execute();
				$queryDeleteAttempt->close();

				echo "<script>alert('Sua conta foi desbloqueada, tente novamente. \nCaso contrário contate o administrador do sistema.');</script>";
			} else {
				// Se o usuário excedeu o número máximo de tentativas, bloqueie a nova tentativa
				echo "<script>alert('Você excedeu o limite de tentativas. Tente novamente após $waitTime minutos.');</script>";
			}
		} else {

			// verifica se encontra o ID do admin		
			$queryad = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Administrador' && u.email = ? && u.status = ? ") or die(mysqli_error($conn));
			$queryad->bind_param("ss", $email, $status);
			$queryad->execute();
			$queryad->bind_result($users_id, $passwordVerification);
			$fetchad = $queryad->fetch();
			$queryad->close(); // Fecha a consulta

			$storedHashedPasswordAD = $passwordVerification;

			// verifica se encontra o ID do usuário
			$querypr = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Usuário' && u.email = ? && u.status = ? ") or die(mysqli_error($conn));
			$querypr->bind_param("ss", $email, $status);
			$querypr->execute();
			$querypr->bind_result($users_id, $passwordVerification);
			$fetchus = $querypr->fetch();
			$querypr->close(); // Fecha a consulta

			$storedHashedPasswordUS = $passwordVerification;

			// verifica se encontra o ID do aprovador
			$queryrl = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Aprovador' && u.email = ? && u.status = ? ") or die(mysqli_error($conn));
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
					

					// Se o login for bem sucedido, delete a tentativa mal sucedida no banco de dados
					$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
					$queryDeleteAttempt->bind_param("s", $email);
					$queryDeleteAttempt->execute();
					$queryDeleteAttempt->close();

					header('location:admin/reservlab.php');
				} else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();
					echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
				}

			} elseif ($fetchus) {
				if (password_verify($password, $storedHashedPasswordUS)) {
					session_start();
					$_SESSION['users_id'] = $users_id;
					$_SESSION['funcao'] = 'Usuário';

					// Se o login for bem sucedido, delete a tentativa mal sucedida no banco de dados
					$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
					$queryDeleteAttempt->bind_param("s", $email);
					$queryDeleteAttempt->execute();
					$queryDeleteAttempt->close();

					header('location:profes/reservlab.php');
				} else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();
					echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
				}

			} elseif ($fetchap) {
				if (password_verify($password, $storedHashedPasswordAP)) {
					session_start();
					$_SESSION['users_id'] = $users_id;
					$_SESSION['funcao'] = 'Aprovador';
					
					// Se o login for bem sucedido, delete a tentativa mal sucedida no banco de dados
					$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
					$queryDeleteAttempt->bind_param("s", $email);
					$queryDeleteAttempt->execute();
					$queryDeleteAttempt->close();

					header('location:resplab/reservlab.php');
				}  else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();
					echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
				}

			} else {

				echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
				
			}
						
		}
	}
	ob_end_flush();
?>