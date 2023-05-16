<?php include_once('header.php');?>
		
		<!-------------------------sidebar------------>
<?php include_once('sidebar.php');?>
		     <!-- Sidebar  -->
        
		
		<!--------page-content---------------->
		
		
		   
		   <!--top--navbar----design--------->

<?php include_once('top-header.php');?>

<?php
	// Redirecionamento para adicionar softwares 
	$url = $_SERVER["REQUEST_URI"];
	if(preg_match("~addsof~", $url)) {
    	$content = 'soft/addsoft-content.php';
	}
	// Redirecionamento para listar softwares e alterar ou excluir
	else if(preg_match("~editsoft~", $url)) {
    	$content = 'soft/soft-content.php';
	}
	// Redirecionamento para editar softwares
	else if(preg_match("~edit-software~", $url)) {
    	$content = 'soft/edit-software.php';
	}
	// Redirecionamento para escolher qual laboratório adicionar os softwares
	else if(preg_match("~addrequire~", $url)) {
    	$content = 'require/add-requirements.php';
	}
	// Redirecionamento para adicionar softwares ao laboratório escolhido
	else if(preg_match("~edit-avail~", $url)) {
    	$content = 'require/edit-availability.php';
	}
	// Redirecionamento para alterar a própria conta, limita ao usuário
	else if(preg_match("~alter-account~", $url)) {
    	$content = 'user/alter-account.php';
	}
	// Redirecionamento para visualizar chamados pendentes
	else if(preg_match("~callpen~", $url)) {
    	$content = 'called/called-pending.php';
	}
	// Redirecionamento para listar chamados finalizados
	else if(preg_match("~callclose~", $url)) {
    	$content = 'called/callclose.php';
	}
	else if(preg_match("~view-called~", $url)) {
    	$content = 'called/view-called.php';
	}
	else if(preg_match("~confirm-reserve~", $url)) {
    	$content = 'book/confirm-reserve.php';
	}
	else if(preg_match("~finlab~", $url)) {
    	$content = 'book/finalized.php';
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
			 			