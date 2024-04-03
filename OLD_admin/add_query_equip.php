<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['add_equip'])){
		$equipment = trim($_POST['equipment']);
		$description = trim($_POST['description']);
		$sector = trim($_POST['sector']);

		// Verificar se o equipamento já existe
		$existingLabQuery = $conn->query("SELECT * FROM equipment WHERE equipment = $equipment and sector = $sector and description = $description");
		if ($existingLabQuery->num_rows > 0) {
			// Equipamento já existe, informar ao usuário
			echo '<p style="text-align: center; color: red;">Este equipamento já existe.</p>';
		} else {

			$conn->query("INSERT INTO `equipment` (equipment, description, sector) VALUES('$equipment', '$description', '$sector')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 32, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
			echo "<script>alert('Equipamento inserido com sucesso!'); window.location.href = 'reservlab.php?editequip';</script>";
		}
	}
?>