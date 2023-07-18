<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_vehicles'])){
		$name = trim($_POST['name']);
		$model = trim($_POST['model']);
		$description = trim($_POST['description']);
		$photo = trim($_POST['photo']);

		// Verificar se o veículo já existe
		$existingLabQuery = $conn->query("SELECT * FROM vehicles WHERE name = $name and model = $model and description = $description and photo = $photo'");
		if ($existingLabQuery->num_rows > 0) {
			// Laboratório já existe, informar ao usuário
			echo '<p style="text-align: center; color: red;">Este veículo já existe.</p>';
		} else {

			$conn->query("INSERT INTO `vehicles` (name, model, description, photo) VALUES('$name', '$model', '$description', '$photo')") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 29, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
			echo "<script>alert('Veículo inserido com sucesso!'); window.location.href = 'reservlab.php?editvei';</script>";
		}
	}
?>