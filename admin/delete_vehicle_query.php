<?php
	require_once 'connect.php';
	require_once 'validate.php';

	$vehicle_id = $_REQUEST['vehicle_id'];
	
    // Verificar se existem informações vinculadas ao laboratório
    $query = ("SELECT * FROM `locacao` WHERE `vehicle_id` = '$vehicle_id'") or die(mysqli_error($conn));
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Existem informações vinculadas ao laboratório
        echo '<script>alert("Não é possível excluir o veículo. Existem informações vinculadas a ele.");';
        echo 'window.location.href = "reservlab.php?editlab";</script>';
        exit;
    }

	$conn->query("DELETE FROM `vehicles` WHERE `vehicle_id` = '$vehicle_id'") or die(mysqli_error($conn));
	$conn->query("INSERT INTO `activities` set mensagens_id = 31, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
	header("location:reservlab.php?vehicles");
?>