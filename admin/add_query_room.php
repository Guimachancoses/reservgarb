<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_room'])){
		$room_type = $_POST['room_type'];
		$capacity = $_POST['capacity'];
		$room_no = $_POST['room_no'];
		$conn->query("INSERT INTO `laboratorios` (room_type, capacity, room_no) VALUES('$room_type', '$capacity', '$room_no')") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 5, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	}
?>