<?php
    require_once 'connect.php';
    session_start();
    if (!isset($_SESSION['users_id'])) {
        header("Location:../index.php");
        exit();
    }
    // Verifica se o usuário é Administrador
    $users_id = $_SESSION['users_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE funcao = 'Administrador' AND users_id = ? && first_lg != '1'");
    $stmt->bind_param("i", $users_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location:../index.php");
        exit();
    }
    else{
        header("Location:../admin/change_password.php");
        exit(); 
    }
?>
