<?php
// Função responsável por adicionar um novo laboratório
require_once 'connect.php';
require_once 'validate.php';

	if(ISSET($_POST['add_room'])){
		$room_type = $_POST['room_type'];
		$capacity = $_POST['capacity'];
		$room_no = $_POST['room_no'];

		// Verificar se o laboratório já existe
		$existingLabQuery = $conn->query("SELECT * FROM laboratorios WHERE room_type = '$room_type' AND room_no = '$room_no'");
		if ($existingLabQuery->num_rows > 0) {
			// Laboratório já existe, informar ao usuário
			echo '<p style="text-align: center; color: red;">Esse sala já existe.</p>';
		} else {

			$conn->query("INSERT INTO `laboratorios` (room_type, capacity, room_no) VALUES('$room_type', '$capacity', '$room_no')") or die(mysqli_error($conn));
			$conn->query("INSERT INTO `activities` set mensagens_id = 5, users_id = '$_SESSION[users_id]'") or die(mysqli_error($sonn));
			echo "<script>alert('Sala inserida com sucesso!'); window.location.href = 'reservlab.php?editlab';</script>";
		}
	}
?>