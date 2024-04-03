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
	// Redirecionamento para pedidos de reserva de salas pendentes ou excluir caso desejado
	if(preg_match("~penlab~", $url)) {
    	$content = 'book/reservation.php';
	}
	// Redirecionamento para corfimar reserva de salas pendentes
	else if(preg_match("~confirm-reserve~", $url)) {
    	$content = 'book/confirm-reserve.php';
	}
	// Redirecionamento para mostrar reservas de salas e liberar reserva caso desejado
	else if(preg_match("~reslab~", $url)) {
    	$content = 'book/reserved.php';
	}
	// Redirecionamento para pedidos de reserva de salas pendentes
	else if(preg_match("~mybookp~", $url)) {
    	$content = 'mybook/my_reservation.php';
	}
	// Redirecionamento para listar histórico de reserva dos salas
	else if(preg_match("~mybookf~", $url)) {
    	$content = 'mybook/my_finalized.php';
	}
	// Redirecionamento para mostrar reservas de salas e liberar reserva caso desejado
	else if(preg_match("~mybookr~", $url)) {
    	$content = 'mybook/my_reserved.php';
	}
	// Redirecionamento para listar histórico de reserva dos salas
	else if(preg_match("~finlab~", $url)) {
    	$content = 'book/finalized.php';
	}
	// Redirecionamento para calendário
	else if(preg_match("~rscalender~", $url)) {
    	$content = 'rscalender/rscalender.php';
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
	// Redirecionamento para listar salas
	else if(preg_match("~listroom~", $url)) {
    	$content = 'labs/room_list.php';
	}
	// Redirecionamento para listar equipamentos
	else if(preg_match("~listequip~", $url)) {
    	$content = 'equips/equip_list.php';
	}
	// Redirecionamento para listar equipamentos
	else if(preg_match("~editequip~", $url)) {
    	$content = 'equip/equip.php';
	}
	// Redirecionamento para locar por periodo
	else if(preg_match("~addpd~", $url)) {
    	$content = 'periodus/addus-period.php';
	}
	// Redirecionamento para lista reservas por periodo pendente
	else if(preg_match("~perpen~", $url)) {
    	$content = 'periodus/periodus_reservation.php';
	}
	// Redirecionamento para lista reservas por periodo reservadas
	else if(preg_match("~perres~", $url)) {
    	$content = 'periodus/periodus_reserved.php';
	}
	// Redirecionamento para corfimar reserva de locações por periodo pendentes
	else if(preg_match("~confirm-locp~", $url)) {
    	$content = 'periodus/confirmus-locp.php';
	}
	// Redirecionamento para informações das reservas
	else if(preg_match("~info-reserve~", $url)) {
    	$content = 'book/info-reserve.php';
	}
	// Redirecionamento para informações das reservas por periodo
	else if(preg_match("~info-per~", $url)) {
		$content = 'periodus/info-per.php';
	}
	// Caso não for direcinado para nenhuma página, monte o HTML com a página principal
	else
		$content = 'main-content.php';
?>

		   
		   <!--------main-content------------->
<?php include_once($content);?>		   
		   
			 
			 <!---footer---->
<?php include_once('footer.php');?>			 
			 			