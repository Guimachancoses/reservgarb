<?php
require_once 'connect.php';
require_once 'validate.php';
// Obtém os dados do evento a partir da requisição POST
$eventTitle = $_POST['title'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$eventCheckin = $_POST['eventCheckin'];
$eventTimeFrom = $_POST['eventTimeFrom'];
$eventTimeTo = $_POST['eventTimeTo'];

// Converte a data para o formato do MySQL
$checkin_date = DateTime::createFromFormat('d/m/Y', $eventCheckin);
$mysql_date = $checkin_date->format('Y-m-d');

// converter as strings em um timestamp Unix
$timeFromUnix = strtotime($eventTimeFrom);
$timeToUnix = strtotime($eventTimeTo);

// formatar os timestamps Unix em formato TIME do MySQL
$timeFrom = date('H:i:s', $timeFromUnix);
$timeTo = date('H:i:s', $timeToUnix);

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

// Executa a segunda consulta para obter o users_id
$stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
$stmt->bind_param("ss", $firstname, $lastname);
$stmt->execute();
$stmt->bind_result($users_id);
$stmt->fetch();
$stmt->close();

// Verifica se a locação já exite no banco de dados com base nos dados recebidos.
$verif = $conn->prepare("SELECT * FROM locacao WHERE room_id = ? OR vehicle_id = ? OR equip_id = ? AND checkin = ? AND checkin_time >= ? AND checkout_time <= ? and mensagens_id != 4");
$verif->bind_param("iiisss", $room_id, $vehicle_id, $equip_id, $mysql_date, $timeFrom, $timeTo);
$verif->execute();
$verif->store_result();
$valid = $verif->num_rows();

if ($valid > 0) {
     // Se a locação existe retorne nada
     echo '';
    }
else {
    $mensagens_id = 2;
    $status_id = 1;

    // Realiza o INSERT no banco de dados usando as variáveis `room_id` e `disciplina_id`
    $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiisss", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $mysql_date, $timeFrom, $timeTo);
    $stmt->execute();
    $stmt->close();

    $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$_SESSION[users_id]'") or die(mysqli_error());

    // Fecha a conexão com o banco de dados
    $conn->close();

    // Define a resposta
    echo 'Evento salvo com sucesso!'; 
    }
?>
