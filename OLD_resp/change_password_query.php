<?php
	require_once 'connect.php';
	require_once 'validate.php';

	if(ISSET($_POST['change_password'])){
        $users_id = $_SESSION['users_id'];
        $password_old = trim($_POST['password_old']);
		$password = trim($_POST['password_new']);

		// Gera um hash criptográfico da senha usando o algoritmo bcrypt
		$hashedPassword_old = password_hash($password_old, PASSWORD_DEFAULT);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$query = $conn->query("SELECT * FROM `users` WHERE `password` = '$hashedPassword_old' && `users_id` = '$users_id'") or die(mysqli_error($conn));
		$valid = $query->num_rows;
		if($valid > 0){
			// Verifica se a URL contém "index.php"
			if (($_SERVER['HTTP_REFERER']) !== false) {
				// Remove tudo que está a frente de "index.php" na URL
				$urlBase = ('../change_password.php');

				// Acrescenta a mensagem na URL
				$mensagem = "Nome de usuário ou senha errados. Por favor tente outra vez.";
				$urlFinal = $urlBase . "?mensagem=" . urlencode($mensagem);

				// Redireciona para a URL com a mensagem
				header("Location: " . $urlFinal);
			} else {
				// Caso "index.php" não esteja presente na URL, redireciona para a URL original sem mensagem
				header("Location:  ../change_password.php");
			}
			// echo "<script>alert('Senha antiga está errada!'); window.location.href = 'change_password.php';</script>";
		}else{
			$conn->query("UPDATE `users` SET `password` = '$hashedPassword', `first_lg` = '1' WHERE `users_id` = '$users_id'") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 28, users_id = '$users_id'") or die(mysqli_error($conn));
			echo "<script>alert('Senha alterada com sucesso!'); window.location.href = 'reservlab.php';</script>";
		}
	}
?>
