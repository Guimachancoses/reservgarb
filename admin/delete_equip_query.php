<?php
	require_once 'connect.php';
	require_once 'validate.php';

	$equip_id = $_REQUEST['equip_id'];
	
    // Verificar se existem informações vinculadas ao equipment
    $query = ("SELECT * FROM `locacao` WHERE `equip_id` = '$equip_id'") or die(mysqli_error($conn));
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Existem informações vinculadas ao laboratório
        echo '<script>alert("Não é possível excluir o equipamento. Existem informações vinculadas a ele.");';
        echo 'window.location.href = "reservlab.php?editlab";</script>';
        exit;
    }

	$conn->query("DELETE FROM `equipment` WHERE `equip_id` = '$equip_id'") or die(mysqli_error());
	$conn->query("INSERT INTO `activities` set mensagens_id = 33, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	header("location:reservlab.php?editequip");
?>