<?php include_once('header.php');?>
		
		<!-------------------------sidebar------------>
<?php include_once('sidebar.php');?>
		     <!-- Sidebar  -->
        
		
		<!--------page-content---------------->
		
		
		   
		   <!--top--navbar----design--------->

<?php include_once('top-header.php');?>

<?php 
	// Redirecionamento para adicinar usuários
	$url = $_SERVER["REQUEST_URI"];
	if(preg_match("~adduser~", $url)) {
    	$content = 'user/adduser-content.php';
	}
	// Redirecionamento para listar editção dos usuários
	else if(preg_match("~edituser~", $url)) {
    	$content = 'user/edituser-content.php';
	}
	// Redirecionamento para editar usuários
	else if(preg_match("~edit-account~", $url)) {
    	$content = 'user/edit-account.php';
	}
	// Redirecionamento para adicinar laboratórios
	else if(preg_match("~addlab~", $url)) {
    	$content = 'lab/add-room.php';
	}
	// Redirecionamento para listar edição de laboratórios
	else if(preg_match("~editlab~", $url)) {
    	$content = 'lab/room.php';
	}
	// Redirecionamento para editar laboatórios
	else if(preg_match("~edit-room~", $url)) {
    	$content = 'lab/edit-lab-content.php';
	}
	// Redirecionamento para pedidos de reserva de laboratórios pendentes ou excluir caso desejado
	else if(preg_match("~penlab~", $url)) {
    	$content = 'book/reservation.php';
	}
	// Redirecionamento para corfimar reserva de laboratórios pendentes
	else if(preg_match("~confirm-reserve~", $url)) {
    	$content = 'book/confirm-reserve.php';
	}
	// Redirecionamento para mostrar reservas de laboratórios e liberar reserva caso desejado
	else if(preg_match("~reslab~", $url)) {
    	$content = 'book/reserved.php';
	}
	// Redirecionamento para listar histórico de reserva dos laboratórios
	else if(preg_match("~finlab~", $url)) {
    	$content = 'book/finalized.php';
	}
	// Redirecionamento para calendário
	else if(preg_match("~calender~", $url)) {
    	$content = 'calender/calender.php';
	}
	// Redirecionamento para alterar a própria conta de usuário
	else if(preg_match("~alter-account~", $url)) {
    	$content = 'user/alter-account.php';
	}
	// Caso não for direcinado para nenhuma página, monte o HTML com a página principal
	else
		$content = 'main-content.php';
?>

		   
		   <!--------main-content------------->
<?php include_once($content);?>		   
		   
			 
			 <!---footer---->
<?php include_once('footer.php');?>			 
			 			