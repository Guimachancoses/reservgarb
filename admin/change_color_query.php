<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$session_id = $_SESSION['users_id'];
	if (isset($_GET['color'])) {
		$colorMode = $_GET['color'];
		echo $colorMode;

		$conn->query("UPDATE `set_color` SET `colorMode` = '$colorMode' WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
		// header("Location: {$_SERVER['HTTP_REFERER']}");	
	}
?>
