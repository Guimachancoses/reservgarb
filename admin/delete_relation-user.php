<?php
// Função responsável por deletar todas as informações do usuário do banco de dados
require 'connect.php';

    $users_id = $_REQUEST['users_id'];

    $sql = "
        USE locationlab_db;

        SET @user_id = $users_id;

        SET @disable_foreign_key_checks = 'SET FOREIGN_KEY_CHECKS = 0';
        PREPARE stmt1 FROM @disable_foreign_key_checks;
        EXECUTE stmt1;
        DEALLOCATE PREPARE stmt1;

        DELETE FROM gp_approver WHERE users_id = @user_id;

        DELETE FROM activities WHERE users_id = @user_id;

        DELETE FROM locacao WHERE users_id = @user_id

        SET @enable_foreign_key_checks = 'SET FOREIGN_KEY_CHECKS = 1';
        PREPARE stmt2 FROM @enable_foreign_key_checks;
        EXECUTE stmt2;
        DEALLOCATE PREPARE stmt2;
    ";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Todas as informações sobre esse usuário foram excluídas permanentemente!!'); window.location.href = 'reservlab.php?deluser';</script>";
    } else {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
    }

?>
