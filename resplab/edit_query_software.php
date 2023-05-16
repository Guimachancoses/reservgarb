<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_software'])){
		$name = $_POST['name'];
		$editor = $_POST['editor'];
		$version = $_POST['version'];
		$realesed = $_POST['realesed'];
		$conn->query("UPDATE `softwares` SET `name` = '$name', `editor` = '$editor', `version` = '$version', `realesed` = '$realesed' WHERE `software_id` = '$_REQUEST[software_id]'") or die(mysqli_error());
		$conn->query('INSERT INTO `activities` set mensagens_id = 12') or die(mysqli_error());
		header("location:reservlab.php");
	}
?>	