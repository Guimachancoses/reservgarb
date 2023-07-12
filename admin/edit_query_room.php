<?php
	// Função responsável por  editar informações do laboratório
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_room'])){
		$room_type = $_POST['room_type'];
		$capacity = $_POST['capacity'];
		$room_no = $_POST['room_no'];
		$conn->query("UPDATE `laboratorios` SET `room_type` = '$room_type', `capacity` = '$capacity', `room_no` = '$room_no' WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 7, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		echo "<script>alert('As alterações de laboratório foram feitas com sucesso!!!'); window.location.href = 'reservlab?editlab.php';</script>";
	}
?>