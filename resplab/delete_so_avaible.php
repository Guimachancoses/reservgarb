<?php
	 require_once 'connect.php';
	 $room_id = $_REQUEST['room_id'];
	 $software_id = $_REQUEST['software_id'];
	 $conn->query("DELETE FROM `so_disponivel` WHERE room_id = '$room_id' AND software_id = '$software_id'") or die(mysqli_error());
	 $conn->query('INSERT INTO `activities` set mensagens_id = 17') or die(mysqli_error());
	 header('location: reservlab.php?room_id='.$room_id.'edit-avail');
?>