<?php 
	session_start();
	if(!ISSET($_SESSION['users_id'])){
		header("location:../index.php");
	}
?>