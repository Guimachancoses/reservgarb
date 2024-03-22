<?php
	 require_once 'connect.php';
	 require_once 'validate.php';
	 $session_id = $_SESSION['users_id'];
	 $approver_id = $_REQUEST['approver_id'];
	 $users_id = $_REQUEST['users_id'];

    //  // Verificar se existem informações vinculadas ao laboratório
	//  $query = $conn->query("SELECT * FROM `locacao` WHERE `gp_approver_id` = (SELECT
	// 																	gp_approver_id
	// 																FROM gp_approver
	// 																WHERE users_id = '$approver_id'
	// 																)
	// 			") or die(mysqli_error($conn));
	//  $valid = $query->num_rows;
 
	//  if ($valid > 0) {
	// 	 // Existem informações vinculadas ao laboratório
	// 	 echo '<script>alert("Não é possível excluir o aprovador. Existem informações vinculadas a ele.");';
	// 	 echo 'window.location.href = "reservlab.php?approver_id='.$approver_id.'add-approver";</script>';
	// 	 exit;
	//  }
	 

	 $conn->query("DELETE FROM `gp_approver` WHERE approver_id = '$approver_id' AND users_id = '$users_id'") or die(mysqli_error($conn));
	 $conn->query("INSERT INTO `activities` set mensagens_id = 36, users_id = '$session_id'") or die(mysqli_error($conn));
	 header('location: reservlab.php?approver_id='.$approver_id.'add-approver');
?>
