<?php
	// Função responsável por  editar informações do laboratório
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_room'])){
		$room_type = ucwords(strtolower(trim($_POST ['room_type'])));
		$capacity = trim($_POST['capacity']);
		$room_no = trim($_POST['room_no']);
		$conn->query("UPDATE `laboratorios` SET `room_type` = '$room_type', `capacity` = '$capacity', `room_no` = '$room_no' WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error($conn));
		$conn->query("INSERT INTO `activities` set mensagens_id = 7, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		echo "<script>alert('As alterações da sala foram feitas com sucesso!!!'); window.location.href = 'reservlab?editlab.php';</script>";
	}
?>