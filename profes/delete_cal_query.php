<?php
require_once "connect.php";
require_once "validate.php";

// Obtém o título do evento a ser excluído
$eventTitle = $_POST['title'];
$room_no = $_POST['room_no'];
$eventCheckin = $_POST["eventCheckin"];
$eventTimeFrom = $_POST["eventTimeFrom"];
$users_id = $_SESSION['users_id'];

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
$stmt = $conn->prepare("SELECT room_id FROM laboratorios WHERE room_type = ? && room_no = ?");
$stmt->bind_param("ss", $eventTitle, $room_no);
$stmt->execute();
$stmt->bind_result($room_id);
$stmt->fetch();
$stmt->close();

// Executa a segunda consulta para obter o disciplina_id
$stmt = $conn->prepare("SELECT locacao_id FROM locacao WHERE locacao_id = (SELECT locacao_id FROM locacao WHERE room_id = ? && checkin = ? && checkin_time = ? && mensagens_id = ? && users_id = ?)");
$stmt->bind_param("sssii", $room_id, $mysql_date, $timeFrom, $mensagens_id, $users_id);
$stmt->execute();
$stmt->bind_result($locacao_id);

if ($stmt->fetch()) {
    
    // fecha o conjunto de resultados para liberar a conexão com o banco de dados
    $stmt->free_result();

    // Executa uma consulta SQL para excluir a locação com o ID fornecido
    $stmt = $conn->prepare("DELETE FROM `locacao` WHERE locacao_id = ?");
    $stmt->bind_param("i", $locacao_id);
    if ($stmt->execute()) {
        // Retorna uma resposta de sucesso
        echo "Evento excluído com sucesso.";
        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Retorna uma resposta de erro
        echo "Erro ao excluir evento: " . mysqli_error($conn);
    }
}

$stmt->close();
?>
