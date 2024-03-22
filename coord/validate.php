<?php 
    session_start();
    if (!isset($_SESSION['users_id'])) {
        header("Location:../index.php");
        exit();
    }

    // Verifica se o usuário é aprovador
    $users_id = $_SESSION['users_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE funcao = 'Coordenador' AND users_id = ?");
    $stmt->bind_param("i", $users_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        
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
        header("Location:../index.php");
        exit();
    }

?>