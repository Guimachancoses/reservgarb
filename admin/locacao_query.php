<?php 
    require_once 'connect.php';
    require_once 'validate.php';
    require_once 'send_mail_loc.php';
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

    // Verifica se a locação ká existe, se existe retorne (echo '';). Caso não insira a locação no banco de dados
    $select_query = $conn->prepare("
                                SELECT locacao_id
                                FROM locacao
                                WHERE 
                                (
                                    (room_id = ? OR vehicle_id = ? OR equip_id = ?)
                                    AND checkin = ? 
                                    AND (
                                        (checkin_time < ? AND checkout_time > ?) OR
                                        (checkin_time >= ? AND checkout_time <= ?) OR
                                        (checkin_time < ? AND checkout_time > ?)
                                    )
                                    AND mensagens_id != 4
                                    );");
    $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $mysql_date, $timeFrom, $timeFrom, $timeFrom, $timeTo, $timeTo, $timeTo);
    $select_query->execute();
    $select_query->store_result();

    if ($select_query->num_rows > 0) {
        $select_query->close();
        exit;
    } else {

        $select_query->close();
        // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
        $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
        $valid = $query->num_rows;
        if($valid > 0){
            $mensagens_id = 3;
            $status_id = 2;
            $query->close();
        }else{
            $mensagens_id = 2;
            $status_id = 1;
            $query->close();
        } 
        
        // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
        $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiisssi", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $mysql_date, $timeFrom, $timeTo, $approver_id);
        $stmt->execute();
        $locacao_id = $stmt->insert_id;
        $stmt->close();

        $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));

        //-----------------------------------------------------------------------------------------------//
        // Buscar dados do usuário que fez a locação, e os dados da locação para concatenar na mensagem
        $stmt2 = $conn->prepare("SELECT 
                                    COALESCE(lb.room_no, vs.model) as description,
                                    COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                    lc.checkin,  
                                    lc.checkin_time, 
                                    lc.checkout_time 
                                    FROM `locacao` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                    LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                    INNER JOIN `users` as u ON u.users_id = lc.users_id
                                    LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                    LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                    WHERE lc.locacao_id = ?");
        $stmt2->bind_param("i", $locacao_id);
        $stmt2->execute();
        $stmt2->bind_result($description, $locacao, $checkin, $checkin_time, $checkout_time);
        $stmt2->fetch();
        $stmt2->close();

        // Busca dados do usuário para qual foi solicitado a reserva
        $stmt2 = $conn->prepare("SELECT firstname, lastname, email FROM users WHERE users_id = ?");
        $stmt2->bind_param("i", $users_id);
        $stmt2->execute();
        $stmt2->bind_result($ftname, $ltname, $rpemail);
        $stmt2->fetch();
        $stmt2->close();

        $firstname = $ftname;
        $lastname = $ltname;
        $email = $rpemail;

        $nome = $firstname . " " . $lastname;
        $assunto = 'Solicitação de Locação Pendente - Reserve Garbuio';
        $message = "ESSA MENSAGEM É AUTOMÁTICA, FAVOR NÃO RESPONDER.\n \nOlá, " . $fadname . " " . $ladname . ".\n \nVocê tem uma mensagem enviada de:\n___________________________________________\n \n Usuário: " . $nome . "\n Email: " . $email . " \n___________________________________________\n \n - Locação de laboratório solicitada.\n \nAguardando sua aprovação.";

        $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Data de Início#'. $checkin.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';

        // Busca dados dos aprovadores de acordo com o $approver_id
        $stmt = $conn->prepare("SELECT
                                    u.firstname
                                    ,u.lastname
                                    ,u.email
                                FROM gp_approver as gp
                                LEFT JOIN users as u
                                ON u.users_id = gp.users_id
                                WHERE gp.approver_id = ? OR gp.approver_id = 1");
        $stmt->bind_param("i", $approver_id);
        $stmt->execute();
        $stmt->bind_result($fadname, $ladname, $ademail);
        // Laço para enviar um email para cada usuário encontrado
        while ($stmt->fetch()) {
            $nmadmin = $fadname . " " . $ladname;

            // Chama função para enviar email
            sendMailLoc ($email, $nome, $assunto, $nmadmin, $ademail, $message, $dadosLocacao);
        }
        // Fecha a conexão com o banco de dados
        $stmt->close();

        //-----------------------------------------------//

        // Fecha a conexão com o banco de dados
        $conn->close();

        // Define a resposta
        echo 'Evento salvo com sucesso!'; 
    }
?>

