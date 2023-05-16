<?php
	require_once 'connect.php';
	if(ISSET($_POST['add_soft'])){
		$name = $_POST['name'];
		$editor = $_POST['editor'];
		$version = $_POST['version'];
		$realesed = $_POST['realesed'];
		$query = $conn->query("SELECT *  FROM `softwares` WHERE `name` = '$name' AND `version` = '$version'") or die(mysqli_error());
		$valid = $query->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Usuário já existe</label></center>";
		}else{
			$conn->query("INSERT INTO `softwares` (name, editor, version, realesed) VALUES('$name', '$editor', '$version', '$realesed')") or die(mysqli_error());
			$conn->query('INSERT INTO `activities` set mensagens_id = 11') or die(mysqli_error());
		}
	}

?>