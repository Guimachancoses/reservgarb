<?php

require_once 'connect.php';
require_once 'validate.php';
require_once 'send_mail.php';

// Obtém os dados do evento a partir da requisição POST
$eventTitle = $_POST['title'];
$room_no = $_POST['room_no'];
$eventDisc = $_POST['eventDisc'];
$eventCheckin = $_POST['eventCheckin'];
$eventTimeFrom = $_POST['eventTimeFrom'];
$eventTimeTo = $_POST['eventTimeTo'];
$users_id = $_SESSION['users_id'];

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
$stmt = $conn->prepare("SELECT room_id, capacity FROM laboratorios WHERE room_type = ? && room_no = ?");
$stmt->bind_param("ss", $eventTitle, $room_no);
$stmt->execute();
$stmt->bind_result($room_id, $capacity);
$stmt->fetch();
$stmt->close();

// Executa a segunda consulta para obter o disciplina_id
$stmt = $conn->prepare("SELECT disciplina_id, qtd_users FROM disciplinas WHERE nm_disciplina = ?");
$stmt->bind_param("s", $eventDisc);
$stmt->execute();
$stmt->bind_result($disciplina_id, $qtd_users);
$stmt->fetch();
$stmt->close();

$capacity = intval($capacity);
$qtd_users = intval($qtd_users);

// Verifica se a capacidade do laboratório não foi ultrapassada
if($qtd_users > $capacity){
    echo '';
}

else{

    //Verificas se o requisitos que o laboratório contem atendem a diciplina escolhida
    $softwares_disponiveis = array();
    $requisitos_disciplina = array();
    // Primeiro consulta do banco de dados todos os softwares disponiveis no laboratório = $room_id
    $stmt = $conn->prepare("SELECT software_id FROM so_disponivel WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->bind_result($software_id_disponivel);
    while ($stmt->fetch()) {
        $softwares_disponiveis[] = $software_id_disponivel;
    }
    $stmt->close();

    // depois consulta do banco de dados todos os softwares que são requisitos da disciplina = $disciplina_id
    $stmt = $conn->prepare("SELECT software_id FROM req_software WHERE disciplina_id = ?");
    $stmt->bind_param("i", $disciplina_id);
    $stmt->execute();
    $stmt->bind_result($software_id_requisitos);
    while ($stmt->fetch()) {
        $requisitos_disciplina[] = $software_id_requisitos;
    }
    $stmt->close();
    
    $softwares_comuns = array_intersect($softwares_disponiveis, $requisitos_disciplina);

    if (empty($softwares_comuns)) {
        echo ''; // Os requisitos da disciplina não estão disponíveis no laboratório. (retorne nada)
    } else {
  
        // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
        $verif = $conn->prepare("SELECT * FROM locacao WHERE room_id = ? AND checkin = ? AND checkin_time >= ? AND checkout_time <= ? and mensagens_id != 4");
        $verif->bind_param("isss", $room_id, $mysql_date, $timeFrom, $timeTo);
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
            $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, mensagens_id, disciplina_id, status_id ,checkin, checkin_time, checkout_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiisss", $users_id, $room_id, $mensagens_id, $disciplina_id, $status_id, $mysql_date, $timeFrom, $timeTo);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$users_id'") or die(mysqli_error());

            // Busca nome e email para enviar email de solicitação pendente
            $admin = 'Administrador';
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE funcao = ?");
            $stmt->bind_param("s", $admin);
            $stmt->execute();
            $stmt->bind_result($fadname, $ladname, $ademail);
            $stmt->fetch();
            // Fecha a conexão com o banco de dados
            $stmt->close();

            $nmadmin = $fadname. " " . $ladname;

            $stmt2 = $conn->prepare("SELECT firstname, lastname, email FROM `users` WHERE users_id = ?");
            $stmt2->bind_param("i", $users_id);
            $stmt2->execute();
            $stmt2->bind_result($ftname, $ltname, $rpemail);
            $stmt2->fetch();

            $firstname = $ftname;
            $lastname = $ltname;
            $email = $rpemail;

            $stmt2->close();

            $nome = $firstname. " " . $lastname;
            $assunto = 'Solicitação de Locação Pendente - Reserve Lab';
            $message = "ESSA MENSAGEM É AUTOMÁTICA, FAVOR NÃO RESPONDER.\n \nOlá, ". $fadname." ".$ladname."."."\n \nVocê tem uma mensagem enviada de:\n___________________________________________\n \n Usuário: " .$nome. "\n Email: " .$email." \n___________________________________________\n \n - Locação de laboratório solicitada.\n \nAguardando sua aprovação."; 
            // Chama função para enviar email
            sendMail($email, $nome, $assunto, $nmadmin, $ademail, $message);

            // Fecha a conexão com o banco de dados
            $conn->close();
            
            // Define a resposta
            echo 'Evento salvo com sucesso!'; 
        }
    }
}
?>
