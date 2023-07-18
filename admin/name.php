<?php
	require 'connect.php';
	$query = $conn->query("SELECT * FROM `users` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['firstname']." ".$fetch['lastname'];
?>