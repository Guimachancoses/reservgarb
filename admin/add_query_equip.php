<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_equip'])){
		$equipment = $_POST['equipment'];
		$description = $_POST['description'];
		$sector = $_POST['sector'];
		$conn->query("INSERT INTO `equipment` (equipment, description, sector) VALUES('$equipment', '$description', '$sector')") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 32, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		echo "<script>alert('Equipamento inserido com sucesso!'); window.location.href = 'reservlab.php?editequip';</script>";
	}
?>