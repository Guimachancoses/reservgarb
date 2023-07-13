<?php
	// Função responsável por  editar informações do laboratório
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['edit_equip'])){
		$equipment = $_POST['equipment'];
		$description = $_POST['description'];
		$sector = $_POST['sector'];
		$conn->query("UPDATE `equipment` SET `equipment` = '$equipment', `description` = '$description', `sector` = '$sector' WHERE `equip_id` = '$_REQUEST[equip_id]'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 34, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		echo "<script>alert('As alterações no equipamento foram feitas com sucesso!!!'); window.location.href = 'reservlab.php?editequip';</script>";
	}
?>