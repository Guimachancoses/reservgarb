<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$session_id = $_SESSION['users_id'];
	if (isset($_GET['color'])) {
		$colorMode = $_GET['color'];

		// Verifica se o usuário já tem cor padrão na tabela
		$query = $conn->query("SELECT *  FROM `set_color` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		$valid = $query->num_rows;
		if($valid > 0){
			// Se encontrou atualiza a preferência de cor
			$conn->query("UPDATE `set_color` SET `colorMode` = '$colorMode' WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
			exit;
		}else{
			// Se não insere uma prefenrência de cor
			$conn->query("INSERT INTO `set_color` (users_id, colorMode) VALUES('$_SESSION[users_id]', '$colorMode')") or die(mysqli_error($conn));
            echo "<script>window.location.reload();</script>";
		}
	}
?>
