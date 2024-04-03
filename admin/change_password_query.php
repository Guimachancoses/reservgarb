<?php
	function AntiSqlInjection($str, $conn) {
		$str = mysqli_real_escape_string($conn, $str);
		return $str;
	}
?>

<?php
	require_once 'connect.php';
	require_once 'validate.php';

	if(ISSET($_POST['change_password'])){
        $users_id = $_SESSION['users_id'];
        $password_old = AntiSqlInjection(trim($_POST['password_old']), $conn);
		$password = AntiSqlInjection(trim($_POST['password_new']), $conn);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// verifica se encontra o ID do admin
		$queryrl = $conn->prepare("SELECT u.password FROM `users` as u	WHERE u.funcao = 'Administrador' && u.users_id = ?") or die(mysqli_error($conn));
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
			if (password_verify($password_old, $storedHashedPasswordAP)) {
				if (password_verify($password, $storedHashedPasswordAP)){
					$urlBase = ('../admin/change_password.php');

					// Acrescenta a mensagem na URL
					$mensagem = "Troque a senha, senha digitada é igual a anterior.";
					$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

					// Redireciona para a URL com a mensagem
					header("Location: " . $urlFinal);					
				}else {
					$stmt = $conn->prepare("UPDATE `users` SET `password` = ?, `first_lg` = '1', `time_uppass` = ? WHERE `users_id` = ?");
					$stmt->bind_param("ssi", $hashedPassword, $time_uppass, $users_id);
					$stmt->execute();
					$conn->query("INSERT INTO `activities` set mensagens_id = 28, users_id = '$users_id'") or die(mysqli_error($conn));
					echo "<script>alert('Senha alterada com sucesso!'); window.location.href = 'reservlab.php';</script>";
				}				
			}
			else{
				// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
				// Remove tudo que está a frente de "index.php" na URL
				$urlBase = ('../admin/change_password.php');

				// Acrescenta a mensagem na URL
				$mensagem = "Senha antiga errada. Por favor tente outra vez.";
				$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

				// Redireciona para a URL com a mensagem
				header("Location: " . $urlFinal);
		}
	}
}
?>
