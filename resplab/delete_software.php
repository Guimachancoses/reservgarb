<?php
	 require_once 'connect.php';
	 $conn->query("DELETE FROM `softwares` WHERE `software_id` = '$_REQUEST[software_id]'") or die(mysqli_error());
	 $conn->query('INSERT INTO `activities` set mensagens_id = 16') or die(mysqli_error());

	 header("location: reservlab.php");
?>