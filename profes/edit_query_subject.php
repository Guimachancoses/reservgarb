<?php
	require_once 'connect.php';
	require_once 'validate.php';
	// Verifica se ocorreu algum erro ao conectar ao banco de dados
	if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
	}
	$users_id = $_SESSION['users_id'];
	if(ISSET($_POST['edit_query_subject'])){
		$nm_disciplina = $_POST['nm_disciplina'];
		$curso = $_POST['curso'];
		$semestre = $_POST['semestre'];
		$qtd_users = $_POST['qtd_users'];
		$date = $_POST['date'];
		
		// Consulta o ID do curso passado por parâmetro
		$stmt = $conn->prepare("SELECT curso_id  FROM cursos WHERE curso = ?") or die(mysqli_error());
		$stmt->bind_param("s", $curso);
		$stmt->execute();
		$stmt->bind_result($curso_id_result);
		$stmt->fetch();
		$stmt->close();

		// Consulta o ID do semestre passado por parâmetro
		$stmt = $conn->prepare("SELECT semester_id  FROM semestre WHERE semestre = ?") or die(mysqli_error());
		$stmt->bind_param("s", $semestre);
		$stmt->execute();
		$stmt->bind_result($semester_id_result);
		$stmt->fetch();
		$stmt->close();

		// Verifica se a disciplina já foi cadastrada no banco de dados
		$verif = $conn->prepare("SELECT *  FROM disciplinas WHERE users_id = ? AND curso_id = ? AND semester_id = ? AND nm_disciplina = ?") or die(mysqli_error());
		$verif->bind_param("iiis", $users_id, $curso_id_result, $semester_id_result, $nm_disciplina);
		$verif->execute();
		$verif->store_result();
		$valid = $verif->num_rows();

		if($valid > 0){
			echo "<center><label style = 'color:red;'>Disciplina já existe</label></center>";
		}else{
			$curso_id = $curso_id_result;
			$semester_id = $semester_id_result;

			$stmt = $conn->prepare("UPDATE disciplinas SET users_id = ?, curso_id = ?, semester_id = ?, nm_disciplina = ?, qtd_users = ?, date = ? WHERE disciplina_id = '$_REQUEST[disciplina_id]'");
			$stmt->bind_param("iiisss", $users_id, $curso_id, $semester_id, $nm_disciplina, $qtd_users, $date);
			$stmt->execute();
			$stmt->close();	

			$conn->query("INSERT INTO `activities` set mensagens_id = 19, users_id = '$users_id'") or die(mysqli_error());

			// Fecha a conexão com o banco de dados
			$conn->close();
			header('location: reservlab.php');	
		}
	}
?>