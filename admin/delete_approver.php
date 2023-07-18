<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $session_id = $_SESSION['users_id'];
	 $approver_id = $_REQUEST['approver_id'];
	 $users_id = $_REQUEST['users_id'];
	 $conn->query("DELETE FROM `gp_approver` WHERE approver_id = '$approver_id' AND users_id = '$users_id'") or die(mysqli_error($conn));
	 $conn->query("INSERT INTO `activities` set mensagens_id = 36, users_id = '$session_id'") or die(mysqli_error($conn));
	 header('location: reservlab.php?approver_id='.$approver_id.'add-approver');
?>