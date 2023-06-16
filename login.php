<?php
require_once "connect.php";
session_start(); // Inicia a sessão do usuário

if (isset($_SESSION['users_id'])) {
  // Se a variável de sessão 'users_id' estiver definida, o usuário já está logado
  // Redireciona o usuário para a página apropriada, dependendo do tipo de usuário
  if ($_SESSION['funcao'] == 'Administrador') {
    header('location: admin/reservlab.php');
    exit;
  } elseif ($_SESSION['funcao'] == 'Usuário') {
    header('location: profes/reservlab.php');
    exit;
  } elseif ($_SESSION['funcao'] == 'Aprovador') {
    header('location: resplab/reservlab.php');
    exit;
  }
}
// Se o usuário não estiver logado, exibe a página de login
// Seu código de login continua abaixo desta linha...
?>
<?php
	ob_start();
	if(ISSET ($_POST['login'])){
		
		$email = $_POST['ra'];

		$password = $_POST['password'];
		// verifica se encontra o ID do admin
		
		$queryad = $conn->query("SELECT * FROM `users` as u	WHERE u.funcao = 'Administrador' && u.email = '$email' && u.password = '$password' && u.status = 5 ") or die(mysqli_error());
		$fetch_ad = $queryad->fetch_array();
		// verifica se encontra o ID do professor
		$querypr = $conn->query("SELECT * FROM `users` as u	WHERE u.funcao = 'Usuário' && u.email = '$email' && u.password = '$password'") or die(mysqli_error());
		$fetch_pr = $querypr->fetch_array();
		// verifica se encontra o ID do responsável pelo laboratório
		$queryrl = $conn->query("SELECT * FROM `users` as u	WHERE u.funcao = 'Aprovador' && u.email = '$email' && u.password = '$password'") or die(mysqli_error());
		$fetch_rl = $queryrl->fetch_array();
		
		$admin_user_id = $queryad->num_rows;

		$professor_user_id = $querypr->num_rows;
		
		$responsavel_user_id = $queryrl->num_rows;
	
		// Verifica se o ID do usuário encontrado é o do administrador
		if ($fetch_ad) {
			session_start();
			$_SESSION['users_id'] = $fetch_ad['users_id'];
			$_SESSION['funcao'] = 'Administrador';
			header('location:admin/reservlab.php');
		} elseif ($fetch_pr) {
			session_start();
			$_SESSION['users_id'] = $fetch_pr['users_id'];
			$_SESSION['funcao'] = 'Usuário';
			header('location:profes/reservlab.php');
		} elseif ($fetch_rl) {
			session_start();
			$_SESSION['users_id'] = $fetch_rl['users_id'];
			$_SESSION['funcao'] = 'Aprovador';
			header('location:resplab/reservlab.php');
		} else {
			echo "<script>alert('Nome de usuário ou senha errados. Por favor tente outra vez.');</script>";
		}
					
	}
	ob_end_flush();
?>