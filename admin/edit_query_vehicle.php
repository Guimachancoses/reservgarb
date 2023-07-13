<?php
	// Função responsável por  editar informações do laboratório
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit-vehicle'])){
		$name = $_POST['name'];
		$model = $_POST['model'];
		$description = $_POST['description'];
		$photo = $_POST['photo'];
		$conn->query("UPDATE `vehicles` SET `name` = '$name', `model` = '$model', `description` = '$description', `photo` = '$photo' WHERE `vehicle_id` = '$_REQUEST[vehicle_id]'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 30, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		echo "<script>alert('As alterações no veículo foram feitas com sucesso!!!'); window.location.href = 'reservlab?vehicles.php?editvei';</script>";
	}
?>