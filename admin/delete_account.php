<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $conn->query("DELETE FROM `users` WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error());
	 $conn->query("INSERT INTO `activities` set mensagens_id = 9, users_id = '$_SESSION[users_id]'") or die(mysqli_error());

	 header("location: reservlab.php?edituser");
?>