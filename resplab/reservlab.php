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
	// Redirecionamento para pedidos de reserva de laboratórios pendentes ou excluir caso desejado
	if(preg_match("~penlab~", $url)) {
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
	else if(preg_match("~page=~", $url)) {
    	$content = 'main-content.php';
	}
	// Redirecionamento para listar veículos
	else if(preg_match("~editvei~", $url)) {
    	$content = 'vehicles/vehicles.php';
	}
	// Redirecionamento para listar equipamentos
	else if(preg_match("~editequip~", $url)) {
    	$content = 'equip/equip.php';
	}
	// Caso não for direcinado para nenhuma página, monte o HTML com a página principal
	else
		$content = 'main-content.php';
?>

		   
		   <!--------main-content------------->
<?php include_once($content);?>		   
		   
			 
			 <!---footer---->
<?php include_once('footer.php');?>			 
			 			