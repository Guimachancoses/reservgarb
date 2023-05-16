<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_room'])){
		$room_type = $_POST['room_type'];
		$capacity = $_POST['capacity'];
		$room_no = $_POST['room_no'];
		$status_id = 3;
		$conn->query("UPDATE `laboratorios` SET `status_id` = '$status_id', `room_type` = '$room_type', `capacity` = '$capacity', `room_no` = '$room_no' WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 7, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	}
?>