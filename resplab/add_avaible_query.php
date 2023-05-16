<?php
	require_once 'connect.php';

	if (isset($_GET['software_id'])) {
		$software_id = $_GET['software_id'];
		$room_id = $_GET['room_id'];	
		$query = $conn->query("SELECT *  FROM `so_disponivel` WHERE `room_id` = '$room_id' AND `software_id` = '$software_id'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			$mensagem = "Software já inserido nesse laboratório";
			header("Location: {$_SERVER['HTTP_REFERER']}?room_id={$room_id}&edit-avail&mensagem=".urlencode($mensagem));
			exit;
		}else{
			$conn->query("INSERT INTO `so_disponivel` (room_id, software_id) VALUES('$room_id', '$software_id')") or die(mysqli_error());
			$conn->query('INSERT INTO `activities` set mensagens_id = 13') or die(mysqli_error());
			header('location: reservlab.php?room_id='.$room_id.'edit-avail');
		}
	}
?>