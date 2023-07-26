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
	else if(preg_match("~page=~", $url)) {
    	$content = 'main-content.php';
	}
	// Redirecionamento para deltetar todas as informações no banco de dados dos usuarios
	else if(preg_match("~deluser~", $url)) {
    	$content = 'relation/relation-user.php';
	}
	// Redirecionamento para deltetar todas as informações no banco de dados dos laboratórios
	else if(preg_match("~dellab~", $url)) {
    	$content = 'relation/relation-room.php';
	}
	// Redirecionamento para deltetar todas as informações no banco de dados dos veículos
	else if(preg_match("~delvei~", $url)) {
    	$content = 'relation/relation-vehicles.php';
	}
	// Redirecionamento para deltetar todas as informações no banco de dados dos equipamentos
	else if(preg_match("~delequi~", $url)) {
    	$content = 'relation/relation-equip.php';
	}
	// Redirecionamento para adicionar veículos
	else if(preg_match("~addvei~", $url)) {
    	$content = 'vehicles/add-vehicles.php';
	}
	// Redirecionamento para listar veículos
	else if(preg_match("~editvei~", $url)) {
    	$content = 'vehicles/vehicles.php';
	}
	// Redirecionamento para editar veículos
	else if(preg_match("~edit-vehicles~", $url)) {
    	$content = 'vehicles/edit-vehicles.php';
	}
	// Redirecionamento para adicionar equipamentos
	else if(preg_match("~add-equip~", $url)) {
    	$content = 'equip/add-equip.php';
	}
	// Redirecionamento para listar equipamentos
	else if(preg_match("~editequip~", $url)) {
    	$content = 'equip/equip.php';
	}
	// Redirecionamento para editar equipamentos
	else if(preg_match("~edit-equip~", $url)) {
    	$content = 'equip/edit-equip.php';
	}
	// Redirecionamento para listar grupo de aprovadores
	else if(preg_match("~gpapp~", $url)) {
    	$content = 'user/gp-approver.php';
	}
	// Redirecionamento para adicionar aprovadores
	else if(preg_match("~add-approver~", $url)) {
    	$content = 'user/add-approver.php';
	}
	// Redirecionamento para locar por periodo
	else if(preg_match("~addpd~", $url)) {
    	$content = 'period/add-period.php';
	}
	// Redirecionamento para lista reservas por periodo pendente
	else if(preg_match("~perpen~", $url)) {
    	$content = 'period/period_reservation.php';
	}
	// Redirecionamento para lista reservas por periodo reservadas
	else if(preg_match("~perres~", $url)) {
    	$content = 'period/period_reserved.php';
	}
	// Redirecionamento para corfimar reserva de locações por periodo pendentes
	else if(preg_match("~confirm-locp~", $url)) {
    	$content = 'period/confirm-locp.php';
	}
	// Caso não for direcinado para nenhuma página, monte o HTML com a página principal
	else
		$content = 'main-content.php';
?>

		   
		   <!--------main-content------------->
<?php include_once($content);?>		   
		   
			 
			 <!---footer---->
<?php include_once('footer.php');?>			 
			 			