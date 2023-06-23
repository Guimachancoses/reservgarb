<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $conn->query("UPDATE `users` SET `status` = '6' WHERE `users_id` = '$_REQUEST[users_id]'") or die(mysqli_error());
	 header("location: reservlab.php?edituser");
?>