<?php
	require_once 'connect.php';
	require_once 'validate.php';
	$session_id = $_SESSION['users_id'];
	if (isset($_GET['users_id'])) {
		$users_id = $_GET['users_id'];
		$approver_id = $_GET['approver_id'];
		$query = $conn->query("SELECT *  FROM `gp_approver` WHERE `users_id` = '$users_id' AND `approver_id` = '$approver_id'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			$mensagem = "Usuário já foi adicionado ao grupo.";
			header("Location: {$_SERVER['HTTP_REFERER']}?room_id={$approver_id}&add-approver&mensagem=".urlencode($mensagem));
			exit;
		}else{
			$conn->query("INSERT INTO `gp_approver` (users_id, approver_id) VALUES('$users_id', '$approver_id')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 35, users_id = '$session_id'") or die(mysqli_error());
			header('location: reservlab.php?approver_id='.$approver_id.'add-approver');
		}
	}
?>