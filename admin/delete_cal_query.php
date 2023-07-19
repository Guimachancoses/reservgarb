<?php
require_once "connect.php";
// Obtém o título do evento a ser excluído
$eventTitle = $_POST['title'];
$room_no = $_POST['room_no'];
$eventCheckin = $_POST["eventCheckin"];
$eventTimeFrom = $_POST["eventTimeFrom"];

// Converte a data para o formato do MySQL
$checkin_date = DateTime::createFromFormat('d/m/Y', $eventCheckin);
$mysql_date = $checkin_date->format('Y-m-d');

// converter as strings em um timestamp Unix
$timeFromUnix = strtotime($eventTimeFrom);

// formatar os timestamps Unix em formato TIME do MySQL
$timeFrom = date('H:i:s', $timeFromUnix);

$mensagens_id = 2;

// Verifica se ocorreu algum erro ao conectar ao banco de dados
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Executa a primeira consulta para obter o room_id
$stmt = $conn->prepare("SELECT room_id FROM laboratorios WHERE room_type = ?");
$stmt->bind_param("s", $eventTitle);
$stmt->execute();
$stmt->bind_result($room_id);
$stmt->fetch();
$stmt->close();

// Executa a primeira consulta para obter o vehicle_id
$stmt = $conn->prepare("SELECT vehicle_id FROM vehicles WHERE name = ?");
$stmt->bind_param("s", $eventTitle);
$stmt->execute();
$stmt->bind_result($vehicle_id);
$stmt->fetch();
$stmt->close();

// Executa a primeira consulta para obter o equip_id
$stmt = $conn->prepare("SELECT equip_id FROM equipment WHERE equipment = ?");
$stmt->bind_param("s", $eventTitle);
$stmt->execute();
$stmt->bind_result($equip_id);
$stmt->fetch();
$stmt->close();

// Executa a segunda consulta para obter o locacao_id
$stmt = $conn->prepare("SELECT locacao_id
                        FROM locacao
                        WHERE locacao_id IN (
                                SELECT locacao_id
                                FROM locacao 
                                WHERE room_id = ? AND checkin = ? AND checkin_time = ? AND mensagens_id = ?)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE vehicle_id = ? AND checkin = ? AND checkin_time = ? AND mensagens_id = ?)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE equip_id = ? AND checkin = ? AND checkin_time = ? AND mensagens_id = ?)");
$stmt->bind_param("issiissiissi", $room_id, $mysql_date, $timeFrom, $mensagens_id, $vehicle_id, $mysql_date, $timeFrom, $mensagens_id, $equip_id, $mysql_date, $timeFrom, $mensagens_id);
$stmt->execute();
$stmt->bind_result($locacao_id);

if ($stmt->fetch()) {
    $stmt->free_result();

    // Crie uma nova declaração preparada para a exclusão
    $stmt_delete = $conn->prepare("DELETE FROM `locacao` WHERE locacao_id = ?");
    $stmt_delete->bind_param("i", $locacao_id);
    
    if ($stmt_delete->execute()) {
        // Retorna uma resposta de sucesso
        echo "Evento excluído com sucesso.";
    } else {
        // Retorna uma resposta de erro
        echo "Erro ao excluir evento: " . $stmt_delete->error;
    }
    
    // Feche a nova declaração preparada
    $stmt_delete->close();

    // Fecha a conexão com o banco de dados
    $conn->close();

}
$stmt->close();
?>
