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

    // Executa a primeira consulta para obter o room_id
    $stmt = $conn->prepare("SELECT room_id, approver_id FROM laboratorios WHERE room_type = ?");
    $stmt->bind_param("s", $eventTitle);
    $stmt->execute();
    $stmt->bind_result($room_id, $approver_id);
    $stmt->fetch();
    $stmt->close();

    // Executa a primeira consulta para obter o vehicle_id
    $stmt = $conn->prepare("SELECT vehicle_id, approver_id FROM vehicles WHERE name = ?");
    $stmt->bind_param("s", $eventTitle);
    $stmt->execute();
    $stmt->bind_result($vehicle_id, $approver_id);
    $stmt->fetch();
    $stmt->close();

    // Executa a primeira consulta para obter o equip_id
    $stmt = $conn->prepare("SELECT equip_id, approver_id FROM equipment WHERE equipment = ?");
    $stmt->bind_param("s", $eventTitle);
    $stmt->execute();
    $stmt->bind_result($equip_id, $approver_id);
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
    $set_variables_query = $conn->query("
        SET @data_locacao = '$mysql_date'; 
        SET @hora_inicio = '$timeFrom'; 
        SET @hora_fim = '$timeTo'; 
        SET @room_id = $room_id; 
        SET @vehicle_id = $vehicle_id; 
        SET @equip_id = $equip_id;
    ");

    $select_query = $conn->query("
        SELECT locacao_id
        FROM locacao
        WHERE 
        (
            (room_id = @room_id OR vehicle_id = @vehicle_id OR equip_id = @equip_id)
            AND checkin = @data_locacao
            AND (
                (checkin_time < @hora_inicio AND checkout_time > @hora_inicio) OR
                (checkin_time >= @hora_inicio AND checkout_time <= @hora_fim) OR
                (checkin_time < @hora_fim AND checkout_time > @hora_fim)
            )
            AND mensagens_id != 4
            )");

    if (mysqli_num_rows($select_query) > 0) {   
        // Se a locação existe, retorne nada
        echo '';
    } else {

        // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
        $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
        $valid = $query->num_rows;
        if($valid > 0){
            $mensagens_id = 3;
            $status_id = 2;
        }else{
            $mensagens_id = 2;
            $status_id = 1;
        } 
        
        // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
        $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiisssi", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $mysql_date, $timeFrom, $timeTo, $approver_id);
        $stmt->execute();
        $stmt->close();

        $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));

        // Fecha a conexão com o banco de dados
        $conn->close();

        // Define a resposta
        echo 'Evento salvo com sucesso!'; 
    }
     
    
?>

