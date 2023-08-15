<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if (isset($_GET['software_id'])) {
		$software_id = $_GET['software_id'];
		$disciplina_id = $_GET['disciplina_id'];	
		$query = $conn->query("SELECT *  FROM `req_software` WHERE `disciplina_id` = '$disciplina_id' AND `software_id` = '$software_id'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			$mensagem = "Software já inserido nesse diciplina";
			header("Location: {$_SERVER['HTTP_REFERER']}?room_id={$disciplina_id}&edit-avail&mensagem=".urlencode($mensagem));
			exit;
		}else{
			$conn->query("INSERT INTO `req_software` (disciplina_id, software_id) VALUES('$disciplina_id', '$software_id')") or die(mysqli_error());
			$conn->query("INSERT INTO `activities` set mensagens_id = 21, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
			header('location: reservlab.php?disciplina_id='.$disciplina_id.'require-content');
		}
	}
?>