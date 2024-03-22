<?php
function AntiSqlInjection($str, $conn) {
    $str = mysqli_real_escape_string($conn, $str);
    return $str;
}
?>

<?php
	require_once 'connect.php';
	if(ISSET($_POST['alter_query_pwd'])){
		$email = AntiSqlInjection(trim(strtolower($_POST['email'])), $conn);
		$codigo = AntiSqlInjection($_POST['codigo'], $conn);
		$password = AntiSqlInjection($_POST['password'], $conn);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $conn->prepare("SELECT * FROM `pwdtemp` WHERE `email` = ? AND `codigo` = ?") or die(mysqli_error($conn));
		$stmt->bind_param("ss", $email, $codigo);
		$stmt->execute();
		$result = $stmt->get_result();
		$valid = $result->num_rows;
		$stmt->close();

		if ($valid > 0) {
			// Atulaiza na tabela users a nova senha para acesso do usuário
			$stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ?") or die(mysqli_error($conn));
			$stmt->bind_param("ss", $hashedPassword, $email);
			$stmt->execute();
			$stmt->close();
			// Atulaiza na tabela pwdtemp o coluna 'codigo' em NULL, para não ser ultilizada mais de uma vez pelo usuário.

			// Gera um novoo código aleatório com 8 dígitos para não ser posivel usuário acertar
			$uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$lowercase = 'abcdefghijklmnopqrstuvwxyz';
			$numbers = '0123456789';
			$specialChars = '!@#$%^&*()';

			$hash = '';
			$hash .= $uppercase[random_int(0, strlen($uppercase) - 1)];
			$hash .= $lowercase[random_int(0, strlen($lowercase) - 1)];
			$hash .= $numbers[random_int(0, strlen($numbers) - 1)];
			$hash .= $specialChars[random_int(0, strlen($specialChars) - 1)];

			while (strlen($hash) < 16) {
				$characters = $uppercase . $lowercase . $numbers . $specialChars;
				$randomChar = $characters[random_int(0, strlen($characters) - 1)];
				$hash .= $randomChar;
			}

			// Embaralhar os caracteres do hash gerado
			$newCodigo = str_shuffle($hash);

			// Executa a consulta para obter o users_id
			$stmt = $conn->prepare("SELECT users_id FROM users WHERE email = ?") or die(mysqli_error($conn));
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result($users_id);
			$stmt->fetch();
			$stmt->close();
			
			// Atualiza na tabela users a nova senha para acesso do usuário
			$stmt = $conn->prepare("UPDATE `pwdtemp` SET `codigo` = ? WHERE `email` = ? AND `codigo` = ?") or die(mysqli_error($conn));
			$stmt->bind_param("sss", $newCodigo, $email, $codigo);
			$stmt->execute();
			$stmt->close();
			
			// Inserir atividade 
			$stmt = $conn->prepare("INSERT INTO `activities` set mensagens_id = 27, users_id = ?") or die(mysqli_error($conn));
			$stmt->bind_param("s", $users_id);
			$stmt->execute();
			$stmt->close();
			
			echo "<script>alert('Sua senha foi alterada com sucesso!\\nVolte para a página de login e entre com sua nova senha.'); window.location.href = 'index.php';</script>";
		}else{
			echo "<script>alert('Código de verificação expirado.\\nCaso o erro persiste contacte o administrador.'); window.location.href = 'index.php'</script>";
		}
	}
?>