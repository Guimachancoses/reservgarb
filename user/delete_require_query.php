<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $disciplina_id = $_REQUEST['disciplina_id'];
	 $software_id = $_REQUEST['software_id'];
	 $conn->query("DELETE FROM `req_software` WHERE disciplina_id = '$disciplina_id' AND software_id = '$software_id'") or die(mysqli_error());
	 $conn->query("INSERT INTO `activities` set mensagens_id = 22, users_id = '$_SESSION[users_id]'") or die(mysqli_error());
	 header('location: reservlab.php?disciplina_id='.$disciplina_id.'require-content');
?>