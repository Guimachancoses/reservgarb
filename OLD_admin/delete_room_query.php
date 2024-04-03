<?php
	require_once 'connect.php';
	require_once 'validate.php';

	$room_id = $_REQUEST['room_id'];
	
    // Verificar se existem informações vinculadas ao laboratório
    $query = ("SELECT * FROM `locacao` WHERE `room_id` = '$room_id'") or die(mysqli_error($conn));
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Existem informações vinculadas ao laboratório
        echo '<script>alert("Não é possível excluir a sala. Existem informações vinculadas a ela.");';
        echo 'window.location.href = "reservlab.php?editlab";</script>';
        exit;
    }

	$conn->query("DELETE FROM `laboratorios` WHERE `room_id` = '$room_id'") or die(mysqli_error($conn));
	$conn->query("INSERT INTO `activities` set mensagens_id = 10, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
	header("location:reservlab.php?editlab");
?>