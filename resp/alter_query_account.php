<?php
	function AntiSqlInjection($str, $conn) {
		$str = mysqli_real_escape_string($conn, $str);
		return $str;
	}
?>

<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['alter_query_account'])){
		// $email = $_POST['email'];
		$users_id = $_SESSION['users_id'];
		$fone = $_POST['contactno'];
        $contactno = preg_replace('/[\s()-]+/', '', $fone);
		$password = AntiSqlInjection(trim($_POST['password']), $conn);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// verifica se encontra o ID do admin
		$queryrl = $conn->prepare("SELECT u.password FROM `users` as u	WHERE u.funcao = 'Aprovador' && u.users_id = ?") or die(mysqli_error($conn));
		$queryrl->bind_param("i", $users_id);
		$queryrl->execute();
		$queryrl->bind_result($passwordVerification);
		$fetchap = $queryrl->fetch();
		$queryrl->close(); // Fecha a consulta
		
		$storedHashedPasswordAP = $passwordVerification;

		date_default_timezone_set('America/Sao_Paulo');

		// Obter a data e hora atual
		$time_uppass = date('Y-m-d H:i:s');

		// Verifica se o ID do usuário encontrado é o do administrador
		if ($fetchap) {
			if (password_verify($password, $storedHashedPasswordAP)) {
				// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
				// Remove tudo que está a frente de "index.php" na URL
				$urlBase = ('../resp/reservlab.php?alter-account.php');

				// Acrescenta a mensagem na URL
				$mensagem = "Troque a senha, senha digitada é igual a anterior.";
				$urlFinal = $urlBase . "&mensagem=" . urlencode($mensagem);

				// Redireciona para a URL com a mensagem
				header("Location: " . $urlFinal);
			} else {

				$conn->query("UPDATE `users` SET `contactno` = '$contactno', `password` = '$hashedPassword', `time_uppass` = '$time_uppass' WHERE `users_id` = '$users_id'") or die(mysqli_error($conn));
				$conn->query("INSERT INTO `activities` set mensagens_id = 28, users_id = '$users_id'") or die(mysqli_error($conn));
				echo "<script>alert('Seus dados foram alterados com sucesso!'); window.location.href = 'reservlab.php';</script>";
			}
		}

	}


?>