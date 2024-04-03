<?php
// Função responsável por deletar totas as informações do laboratório do banco de dados
require 'connect.php';
require_once 'validate.php';

    $room_id = $_REQUEST['room_id'];

    $sql = "
        USE locationlab_db;

        SET @room_id = $room_id;

        SET @disable_foreign_key_checks = 'SET FOREIGN_KEY_CHECKS = 0';
        PREPARE stmt1 FROM @disable_foreign_key_checks;
        EXECUTE stmt1;
        DEALLOCATE PREPARE stmt1;

        DELETE FROM locacao WHERE room_id = @room_id;

        SET @enable_foreign_key_checks = 'SET FOREIGN_KEY_CHECKS = 1';
        PREPARE stmt2 FROM @enable_foreign_key_checks;
        EXECUTE stmt2;
        DEALLOCATE PREPARE stmt2;
    ";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Todas as informações sobre esse laboratório foram excluídas permanentemente!!'); window.location.href = 'reservlab.php?dellab';</script>";
    } else {
        echo "Erro ao executar a consulta: " . mysqli_error($conn);
    }

?>
