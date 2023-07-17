<?php
// Função responsável por deletar usuário
require_once 'connect.php';
require_once 'validate.php';

$users_id = $_REQUEST['users_id'];

// Verificar se existem informações vinculadas ao laboratório
$query = "SELECT *
			FROM activities as ac
			WHERE users_id = $users_id;";
$query2 = "SELECT *
	FROM gp_approver as gp
	WHERE users_id = $users_id";

$result1 = $conn->query($query);
$result2 = $conn->query($query2);

if ($result1->num_rows > 0 || $result2->num_rows > 0) {
	// Existem informações vinculadas ao laboratório
	echo '<script>alert("Não é possível excluir o usuário. Existem informações vinculadas a ele.");';
	echo 'window.location.href = "reservlab.php?edituser";</script>';
	exit;
}

// Não existem informações vinculadas, prosseguir com a exclusão
$conn->query("DELETE FROM `users` WHERE `users_id` = '$users_id'") or die(mysqli_error());
$conn->query("INSERT INTO `activities` set mensagens_id = 9, users_id = '$_SESSION[users_id]'") or die(mysqli_error());

header("location: reservlab.php?edituser");
?>
