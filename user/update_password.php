<?php
// Arquivo: update_password.php
// Estabelece a conexão com o banco de dados
require_once "connect.php";
require_once 'validate.php';

$sessionID = $_SESSION['users_id'];

// Define horário de Brasilia
date_default_timezone_set('America/Sao_Paulo');

// Obter a data e hora atual
$data_atual = date('Y-m-d H:i:s');
$first_lg = 0;

// Consulta a última data e hora em que o usuário trocou a senha
$query = $conn->prepare("SELECT time_uppass FROM `users` WHERE users_id = ?");
$query->bind_param("i", $sessionID);
$query->execute();
$query->bind_result($time_uppass);
$query->fetch();
$query->close();

// Verifica se a última troca de senha foi há mais de 90 dias
if ($time_uppass !== null) {
    // Calcular a diferença em dias
    $diff = floor((strtotime($data_atual) - strtotime($time_uppass)) / (60 * 60 * 24)); // Diferença em dias

    if ($diff >= 90) {
        // Se a diferença for maior ou igual a 90 dias, exibir mensagem e fazer ações necessárias
        // Atualiza a locação com mensagens_id = 4 e checkout_time igual ao valor encontrado na consulta SOMENTE SALAS
        $sql = $conn->prepare("UPDATE users SET first_lg = $first_lg  WHERE users_id = ?");
        $sql->bind_param("s", $sessionID);
        $sql->execute();
        $sql->close();
        // mensagem de senha expirada
        $conn->query("INSERT INTO `activities` set mensagens_id = 39, users_id = '$sessionID'") or die(mysqli_error($conn));

        // echo 'Trocar a senha';

    } else if ($diff == 85 && $diff < 90) {
        // mensagem de senha expirará em 5 dias
        // Verifica se já foi enviada a senha uma vez se sim não envia mais
        $mensagemID = 40;
        $query = $conn->prepare("SELECT * FROM `activities` WHERE users_id = ? and mensagens_id = ?");
        $query->bind_param("ii", $sessionID, $mensagemID);
        $query->execute();
        $query->store_result();
        $valid = $query->num_rows();

        if ($valid == 0) {
            $conn->query("INSERT INTO `activities` set mensagens_id = 40, users_id = '$sessionID'") or die(mysqli_error($conn));
            $query->close();
            // echo 'Senha irá expirar em 5 dias';
        }

    } else if ($diff == 86 && $diff < 89) {
        // mensagem de senha expirará em 4 dias
        // Verifica se já foi enviada a senha uma vez se sim não envia mais
        
        $mensagemID = 41;
        $query = $conn->prepare("SELECT * FROM `activities` WHERE users_id = ? and mensagens_id = ?");
        $query->bind_param("ii", $sessionID, $mensagemID);
        $query->execute();
        $query->store_result();
        $valid = $query->num_rows();

        if ($valid == 0) {
            $conn->query("INSERT INTO `activities` set mensagens_id = 41, users_id = '$sessionID'") or die(mysqli_error($conn));
            // echo 'Senha irá expirar em 4 dias';
        }

    } else if ($diff == 87 && $diff < 88) {
        // mensagem de senha expirará em 3 dias
        // Verifica se já foi enviada a senha uma vez se sim não envia mais
        $mensagemID = 42;
        $query = $conn->prepare("SELECT * FROM `activities` WHERE users_id = ? and mensagens_id = ?");
        $query->bind_param("ii", $sessionID, $mensagemID);
        $query->execute();
        $query->store_result();
        $valid = $query->num_rows();

        if ($valid == 0) {
            $conn->query("INSERT INTO `activities` set mensagens_id = 42, users_id = '$sessionID'") or die(mysqli_error($conn));
            $query->close();
            // echo 'Senha irá expirar em 3 dias';
        }

    } else if ($diff == 88 && $diff < 89) {
        // mensagem de senha expirará em 2 dias
        // Verifica se já foi enviada a senha uma vez se sim não envia mais
        $mensagemID = 43;
        $query = $conn->prepare("SELECT * FROM `activities` WHERE users_id = ? and mensagens_id = ?");
        $query->bind_param("ii", $sessionID, $mensagemID);
        $query->execute();
        $query->store_result();
        $valid = $query->num_rows();

        if ($valid == 0) {
            $conn->query("INSERT INTO `activities` set mensagens_id = 43, users_id = '$sessionID'") or die(mysqli_error($conn));
            $query->close();
            // echo 'Senha irá expirar em 2 dias';
        }

    } else if ($diff == 89) {
        // mensagem de senha expirará em 1 dia
        // Verifica se já foi enviada a senha uma vez se sim não envia mais
        $mensagemID = 44;
        $query = $conn->prepare("SELECT * FROM `activities` WHERE users_id = ? and mensagens_id = ?");
        $query->bind_param("ii", $sessionID, $mensagemID);
        $query->execute();
        $query->store_result();
        $valid = $query->num_rows();

        if ($valid == 0) {
            $conn->query("INSERT INTO `activities` set mensagens_id = 44, users_id = '$sessionID'") or die(mysqli_error($conn));
            $query->close();
            // echo 'Senha irá expirar em 1 dia';
        }

    } else {
        // echo 'Senha em dia';
    }
} else {
    // Se a data de última troca de senha não estiver definida, exibir mensagem de erro ou fazer outras ações necessárias
    // echo 'Erro: data de última troca de senha não encontrada';
}
?>
