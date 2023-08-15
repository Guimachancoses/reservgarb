<?php
	// Inicia a sessão
	session_start();
	
	// Apaga os dados da sessão
	session_unset();

	// Destroi a sessão
	session_destroy();

	// Limpa os cookies relacionados à sessão
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	// Redireciona para a página inicial
	header("location:../index.php");
?>
