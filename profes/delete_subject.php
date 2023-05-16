<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $conn->query("DELETE FROM `disciplinas` WHERE `disciplina_id` = '$_REQUEST[disciplina_id]'") or die(mysqli_error());
	 $conn->query("INSERT INTO `activities` set mensagens_id = 20, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	 header("location: reservlab.php");
?>