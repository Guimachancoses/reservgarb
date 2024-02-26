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
    header('location: user/reservlab.php');
    exit;
  } elseif ($_SESSION['funcao'] == 'Coordenador') {
	header('location: coord/reservlab.php');
	exit;
  } elseif ($_SESSION['funcao'] == 'Aprovador') {
    header('location: resp/reservlab.php');
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
		
		$email = AntiSqlInjection(trim(strtolower($_POST['ra'])), $conn);

		$password = AntiSqlInjection($_POST['password'], $conn);
		$status = "5";
		// Antes de executar qualquer código, define o tempo de espera em minutos
		$waitTime = 5;

		// Verifica se o usuário já fez 5 tentativas de login sem sucesso nos últimos 5 minutos
		$failedAttempts = 5; 

		// Definindo o fuso horário de Brasília
		date_default_timezone_set('America/Sao_Paulo');

		// Obtendo a data e hora atual em Brasília
		$dataHoraAtualBrasilia = date('Y-m-d H:i:s');

		$queryAttempts = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE email = ? AND attempt_time < ?");
		$queryAttempts->bind_param("ss", $email, $dataHoraAtualBrasilia);
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
			if ($dataHoraAtualBrasilia > $attempt_New) {
				// Se o passou os 5 minutos, delete a tentativa mal sucedida no banco de dados
				$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
				$queryDeleteAttempt->bind_param("s", $email);
				$queryDeleteAttempt->execute();
				$queryDeleteAttempt->close();

				// echo "<script>alert('Seu conta foi desbloqueada, tente acessar novamente!'); window.location.href = 'index.php';</script>";
				$mensagem = "Seu conta foi desbloqueada, tente acessar novamente!";
				header("Location: ../index.php?mensagem=".urlencode($mensagem));
			} else {

				// Se o usuário excedeu o número máximo de tentativas, bloqueie a nova tentativa
				// Verifica se a URL contém "index.php"
				if (strpos('../reservlab/', 'index.php') !== false) {
					// Remove tudo que está a frente de "index.php" na URL
					$urlBase = ('../index.php');

					// Acrescenta a mensagem na URL
					$mensagem = "Você excedeu o limite de tentativas. Tente novamente após $waitTime minutos.";
					$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

					// Redireciona para a URL com a mensagem
					header("Location: " . $urlFinal);
				} else {
					// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
					header("Location: " . $_SERVER['HTTP_REFERER']);
				}
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

			// verifica se encontra o ID do usuário
			$querycd = $conn->prepare("SELECT u.users_id, u.password FROM `users` as u	WHERE u.funcao = 'Coordenador' && u.email = ? && u.status = ? ") or die(mysqli_error($conn));
			$querycd->bind_param("ss", $email, $status);
			$querycd->execute();
			$querycd->bind_result($users_id, $passwordVerification);
			$fetchcd = $querycd->fetch();
			$querycd->close(); // Fecha a consulta

			$storedHashedPasswordCD = $passwordVerification;

	
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

					header('location: ../admin/splash.php');
				} else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();

					// Verifica se a URL contém "index.php"
					if (($_SERVER['HTTP_REFERER']) !== false) {
						// Remove tudo que está a frente de "index.php" na URL
						$urlBase = ('../index.php');

						// Acrescenta a mensagem na URL
						$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
						$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

						// Redireciona para a URL com a mensagem
						header("Location: " . $urlFinal);
					} else {
						// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
						header("Location:  ../index.php");
					}
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

					header('location: ../user/reservlab.php');
				} else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();

					// Verifica se a URL contém "index.php"
					if (($_SERVER['HTTP_REFERER']) !== false) {
						// Remove tudo que está a frente de "index.php" na URL
						$urlBase = ('../index.php');

						// Acrescenta a mensagem na URL
						$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
						$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

						// Redireciona para a URL com a mensagem
						header("Location: " . $urlFinal);
					} else {
						// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
						header("Location: " . $_SERVER['HTTP_REFERER']);
					}
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

					header('location:../resp/reservlab.php');
				}  else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();

					// Verifica se a URL contém "index.php"
					if (($_SERVER['HTTP_REFERER']) !== false) {
						// Remove tudo que está a frente de "index.php" na URL
						$urlBase = ('../index.php');

						// Acrescenta a mensagem na URL
						$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
						$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

						// Redireciona para a URL com a mensagem
						header("Location: " . $urlFinal);
					} else {
						// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
						header("Location: " . $_SERVER['HTTP_REFERER']);
					}
				}

			} elseif ($fetchcd) {
				if (password_verify($password, $storedHashedPasswordCD)) {
					session_start();
					$_SESSION['users_id'] = $users_id;
					$_SESSION['funcao'] = 'Coordenador';
					
					// Se o login for bem sucedido, delete a tentativa mal sucedida no banco de dados
					$queryDeleteAttempt = $conn->prepare("DELETE FROM login_attempts WHERE email = ?");
					$queryDeleteAttempt->bind_param("s", $email);
					$queryDeleteAttempt->execute();
					$queryDeleteAttempt->close();

					header('location:../coord/reservlab.php');
				}  else {

					// Se o login falhar, registre a tentativa mal sucedida no banco de dados
					$queryInsertAttempt = $conn->prepare("INSERT INTO login_attempts (email) VALUES (?)");
					$queryInsertAttempt->bind_param("s", $email);
					$queryInsertAttempt->execute();
					$queryInsertAttempt->close();

					// Verifica se a URL contém "index.php"
					if (($_SERVER['HTTP_REFERER']) !== false) {
						// Remove tudo que está a frente de "index.php" na URL
						$urlBase = ('../index.php');

						// Acrescenta a mensagem na URL
						$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
						$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

						// Redireciona para a URL com a mensagem
						header("Location: " . $urlFinal);
					} else {
						// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
						header("Location: " . $_SERVER['HTTP_REFERER']);
					}
				}

			} else {

				$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
				header("Location: ../index.php?mensagem=".urlencode($mensagem));
				
			}
						
		}
	}
	ob_end_flush();
?>