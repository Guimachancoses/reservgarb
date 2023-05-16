<?php include_once('header.php');?>
		
		<!-------------------------sidebar------------>
<?php include_once('sidebar.php');?>
		     <!-- Sidebar  -->
        
		
		<!--------page-content---------------->
		
		
		   
		   <!--top--navbar----design--------->

<?php include_once('top-header.php');?>

<?php
	// Redirecionamento para adicionar disciplinas
	$url = $_SERVER["REQUEST_URI"];
	if(preg_match("~addsubj~", $url)) {
    	$content = 'subject/add-subject.php';
	}
	// Redirecionamento para listar conteúdo das disciplinas podendo aterar ou remover
	else if(preg_match("~editsubj~", $url)) {
    	$content = 'subject/subject-content.php';
	}
	// Redirecionamento para editar disciplinas
	else if(preg_match("~edit-subject~", $url)) {
    	$content = 'subject/edit-subject.php';
	}
	// Redirecionamento para escolher disciplina que deseja adicionar requisitos
	else if(preg_match("~addreq~", $url)) {
    	$content = 'subject/add-requirements.php';
	}
	// Redirecionamento para adicionar requisitos a disciplina
	else if(preg_match("~require-content~", $url)) {
    	$content = 'subject/require-content.php';
	}
	// Redirecionamento para alterar a propria conta limitada ao tipo de usuário
	else if(preg_match("~alter-account~", $url)) {
    	$content = 'user/alter-account.php';
	}
	// Redirecionamento para abrir chamado
	else if(preg_match("~addcalled~", $url)) {
    	$content = 'called/add-called.php';
	}
	// Redirecionamento para listar chamados
	else if(preg_match("~listcall~", $url)) {
    	$content = 'called/list-called.php';
	}
	// Redirecionamento para reabrir chamados
	else if(preg_match("~reopen-called~", $url)) {
    	$content = 'called/reopen-called.php';
	}
	// Redirecionamento para pedidos de reserva de laboratórios pendentes ou excluir caso desejado
	else if(preg_match("~penlab~", $url)) {
    	$content = 'book/reservation.php';
	}
	else if(preg_match("~confirm-reserve~", $url)) {
    	$content = 'book/confirm-reserve.php';
	}
	// Redirecionamento para mostrar reservas de laboratórios
	else if(preg_match("~reslab~", $url)) {
    	$content = 'book/reserved.php';
	}
	// Redirecionamento para mostrar reservas de laboratórios finalizadas
	else if(preg_match("~finlab~", $url)) {
    	$content = 'book/finalized.php';
	}
	// Redirecionamento para listar laboratórios
	else if(preg_match("~labscontent~", $url)) {
    	$content = 'labs/labs-content.php';
	}
	// Redirecionamento para listas laboratórios e softwares disponiveis
	else if(preg_match("~view-content~", $url)) {
    	$content = 'labs/view-content.php';
	}
	// Redirecionamento para locar laboratório por periodo
	else if(preg_match("~period~", $url)) {
    	$content = 'period/add-period.php';
	}
	else if(preg_match("~calender~", $url)) {
    	$content = 'calender/calender.php';
	}
	else
		$content = 'main-content.php';
?>

		   
		   <!--------main-content------------->
<?php include_once($content);?>		   
		   
			 
			 <!---footer---->
<?php include_once('footer.php');?>			 
			 			