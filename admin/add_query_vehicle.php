<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_vehicles'])){
		$name = $_POST['name'];
		$model = $_POST['model'];
		$description = $_POST['description'];
		$photo = $_POST['photo'];
		$conn->query("INSERT INTO `vehicles` (name, model, description, photo) VALUES('$name', '$model', '$description', '$photo')") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 29, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	}
?>