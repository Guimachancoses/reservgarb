<?php
	require_once 'connect.php';
	require_once 'validate.php';
	if(ISSET($_POST['alter_called'])){
		$chamado_id = $_REQUEST	['chamado_id'];
		$prioridade_id = $_POST['prioridade_id'];
		$menssagem = $_POST['menssagem'];

		$conn->query("UPDATE `chamados` SET `prioridade_id` = '$prioridade_id', `msg_chamado` = '$menssagem', `status_id` = 1  WHERE `chamado_id` = '$chamado_id'") or die(mysqli_error());
		$conn->query("INSERT INTO `activities` set mensagens_id = 24, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
		header("location:reservlab.php?listcall");
		echo "alert('Chamado alterado com sucesso');";
		}
?>
