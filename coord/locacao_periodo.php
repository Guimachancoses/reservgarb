<?php
    require_once 'connect.php';
    require_once 'validate.php';
    require_once 'send_mail_perloc.php';
    // Verificar se ocorreu algum erro na conexão
    if(ISSET($_POST['locacao_periodo'])){
        // Obter a data de início e fim do usuário
        $title = $_POST['eventTitle'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $dia_semana = $_POST['dia_semana'];
        $escolha = $_POST['confirmacao'];
        $eventInfo = $_POST['eventInfo'];

        // Divide a string com base no caractere '-'
        $parts = explode(' - ', $title);

        // Atribui os valores divididos às variáveis $title e $description
        $eventTitle = $parts[0];
        $description = $parts[1];

        // echo "Escolha: " . $escolha . " Locacao: " . $eventTitle. " Description: " .$description;

        switch ($dia_semana) {
            case "Segunda-feira":
                $dia_semana = "Monday";
                break;
            case "Terça-feira":
                $dia_semana = "Tuesday";
                break;
            case "Quarta-feira":
                $dia_semana = "Wednesday";
                break;
            case "Quinta-feira":
                $dia_semana = "Thursday";
                break;
            case "Sexta-feira":
                $dia_semana = "Friday";
                break;
            case "Sábado":
                $dia_semana = "Saturday";
                break;
            case "Domingo":
                $dia_semana = "Sunday";
                break;
            default:
                $dia_semana = "AllDays";
                break;
        }
        $eventTimeFrom = $_POST['checkin_time'];
        $eventTimeTo = $_POST['checkout_time'];
        $users_id = $_SESSION['users_id'];

        // Converte a data de checkin para o formato do MySQL
        $checkin_dateIn = new DateTime($checkin);
        $mysql_dateIn = $checkin_dateIn->format('Y-m-d');

        // Converte a data de checkout para o formato do MySQL
        $checkin_dateOut = new DateTime($checkout);
        $mysql_dateOut = $checkin_dateOut->format('Y-m-d');

        // converter as strings em um timestamp Unix
        $timeFromUnix = strtotime($eventTimeFrom);
        $timeToUnix = strtotime($eventTimeTo);

        // formatar os timestamps Unix em formato TIME do MySQL
        $timeFrom = date('H:i:s', $timeFromUnix);
        $timeTo = date('H:i:s', $timeToUnix);

        // Array associativo para armazenar as datas para cada dia da semana
        $dias_da_semana = array(
            'Monday' => array(),
            'Tuesday' => array(),
            'Wednesday' => array(),
            'Thursday' => array(),
            'Friday' => array(),
            'Saturday' => array(),
            'Sunday' => array(),
        );

        // Executa a primeira consulta para obter o room_id
        $stmt = $conn->prepare("SELECT room_id, approver_id FROM laboratorios WHERE room_type = ?");
        $stmt->bind_param("s", $eventTitle);
        $stmt->execute();
        $stmt->bind_result($room_id, $approver_id);
        $stmt->fetch();
        $stmt->close();

        // Executa a primeira consulta para obter o vehicle_id
        $stmt = $conn->prepare("SELECT vehicle_id, approver_id FROM vehicles WHERE name = ? && description = ?");
        $stmt->bind_param("ss", $eventTitle, $description);
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

        // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
        $verif = $conn->prepare("SELECT lc_period_id
                                FROM lc_period
                                WHERE (room_id = ? OR vehicle_id = ? OR equip_id = ?)
                                AND (
                                    -- Verificar conflito para o mesmo dia do início do evento
                                    (checkin = ? AND checkout_time >= ?) OR
                                    -- Verificar conflito para o mesmo dia do término do evento
                                    (checkout = ? AND checkin_time <= ?) OR
                                    -- Verificar conflito para os dias entre o início e término do evento
                                    (checkin = ? AND checkout = ?)
                                ) AND mensagens_id != 4;");
        $verif->bind_param("iiissssss", $room_id, $vehicle_id, $equip_id, $mysql_dateIn, $timeFrom, $mysql_dateOut, $timeTo, $mysql_dateIn, $mysql_dateOut);
        $verif->execute();
        $verif->store_result();
        $valid = $verif->num_rows();

        if ($valid > 0) {
            // Se a locação existe retorne nada
            echo "<script>alert('Já existe uma reserva nesse periodo'); window.location.href = 'reservlab.php?calender';</script>";
            echo '<script>hideOverlay();</script>';
            exit;
        }
        else {

            if ($escolha == "Não") {

                // SE HORA FINAL MAIOR QUE HORA INICIAL FAZ:
                if ($timeTo > $timeFrom) {

                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $valid = $query->num_rows;
                    if($valid > 0){
                        $mensagens_idPe = 3;
                        $mensagens_id = 3;
                    }else{
                        $mensagens_idPe = 37;
                        $mensagens_id = 2;
                    }

                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação por periodo
                    $stmt = $conn->prepare("INSERT INTO lc_period (users_id, room_id, vehicle_id, equip_id, mensagens_id, weekday, checkin, checkout, checkin_time, checkout_time, approver_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiiisssssis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_idPe, $dia_semana, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $approver_id ,$eventInfo);
                    $stmt->execute();

                    $lc_period_id = $stmt->insert_id;

                    $stmt->close();

                    $stmt = $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));

                    // Se a hora fim for maior que a hora de inicio percorre o Loop através de cada dia no período
                    for ($data = $checkin_dateIn; $data <= $checkin_dateOut; $data->modify('+1 day')) {
                        // Verificar se o usuário escolheu "Todos os dias" ou se a data é do dia da semana escolhido pelo usuário
                        if ($dia_semana === 'AllDays' || $data->format('l') === $dia_semana) {
                            // Adicionar a data na lista para o dia da semana correspondente
                            $dias_da_semana[$data->format('l')][] = $data->format('Y-m-d');
                            
                            $dataFormat = $data->format('Y-m-d');

                            // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
                            $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                            $stmt->bind_param("ss", $firstname, $lastname);
                            $stmt->execute();
                            $stmt->bind_result($users_id);
                            $stmt->fetch();
                            $stmt->close();

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
                                $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $dataFormat, $timeFrom, $timeFrom, $timeFrom, $timeTo, $timeTo, $timeTo);
                                $select_query->execute();
                                $select_query->store_result();

                            if ($select_query->num_rows > 0) {

                                // Remove a locação inserida
                                $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                // Remove a locação por periodo inserida
                                $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                echo "<script>alert('Já existe uma reserva na data: ".$dataFormatString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                                echo '<script>hideOverlay();</script>';
                                exit;
                            }
                            else {

                                // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                                $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                                $valid = $query->num_rows;
                                if($valid > 0){
                                    $status_id = 2;
                                }else{
                                    $status_id = 1;
                                }
                            
                                // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                                $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom, $timeTo, $approver_id, $lc_period_id, $eventInfo);
                                $stmt->execute();
                                $stmt->close();
                                
                            }
                        } 
                    
                    }

                    //-----------------------------------------------------------------------------------------------//
                    // Envia email e verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $verife = $query->num_rows;
                    if ($verife == 0){

                        //-----------------------------------------------------------------------------------------------//
                        // Buscar dados do usuário que fez a locação, e os dados da locação para concatenar na mensagem
                        $stmt2 = $conn->prepare("SELECT 
                                                COALESCE(lb.room_no, vs.model) as description,
                                                COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                                CASE lc.weekday
                                                WHEN 'Monday' THEN 'Segunda-feira'
                                                WHEN 'Tuesday' THEN 'Terça-feira'
                                                WHEN 'Wednesday' THEN 'Quarta-feira'
                                                WHEN 'Thursday' THEN 'Quinta-feira'
                                                WHEN 'Friday' THEN 'Sexta-feira'
                                                WHEN 'Saturday' THEN 'Sábado'
                                                WHEN 'Sunday' THEN 'Domingo'
                                                ELSE 'Todos os dias' END AS dia_semana,
                                                lc.checkin, 
                                                lc.checkout, 
                                                lc.checkin_time, 
                                                lc.checkout_time 
                                                FROM `lc_period` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                                LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                                INNER JOIN `users` as u ON u.users_id = lc.users_id
                                                LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                                LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                                WHERE lc.lc_period_id = ?");
                        $stmt2->bind_param("i", $lc_period_id);
                        $stmt2->execute();
                        $stmt2->bind_result($description, $locacao, $weekday, $checkin, $checkout, $checkin_time, $checkout_time);
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

                        $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Dia da Semana#'. $weekday.' * Data de Início#'. $checkin.' * Data Final#'. $checkout.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';
                    
                        // Busca dados dos aprovadores de acordo com o $approver_id
                        $stmt = $conn->prepare("SELECT
                                                    u.firstname
                                                    ,u.lastname
                                                    ,u.email
                                                FROM gp_approver as gp
                                                LEFT JOIN users as u
                                                ON u.users_id = gp.users_id
                                                WHERE gp.gp_approver_id = (SELECT gp_approver_id
                                                                        FROM gr_approved as gr 
                                                                        WHERE users_id = ?
                                                                        )
                                                ");
                        $stmt->bind_param("i", $users_id);
                        $stmt->execute();
                        $stmt->bind_result($fadname, $ladname, $ademail);
                        // Laço para enviar um email para cada usuário encontrado
                        while ($stmt->fetch()) {
                        $nmadmin = $fadname . " " . $ladname;

                        $message = "Menssagem enviada de: \n \nAdministrador: " .$nome. "\nEmail: " .$ademail." \n \nSeu pedido de reserva foi confimado. \n \nInformações da reserva:\n \n - Locação: " . $locacao. "\n - Data de início: " .$checkin. "\n - Data de final: " .$checkout. "\n - Dia da semana: " . $weekday. "\n - Hora de início: " . $checkin_time. "\n - Hora final: " . $checkout_time;

                        // Chama função para enviar email
                        sendMailPerLoc ($email, $nome, $assunto, $nmadmin, $ademail, $message, $dadosLocacao);
                        }
                        // Fecha a conexão com o banco de dados
                        $stmt->close();
                        
                        echo '<script>hideOverlay();</script>';

                        //--------------------------------------------------------------------------------------------//
                    } 
                    
                    // tentar enviar o email de confirmação de locação para a lista de emails que está na lista de exeções 
                }
                // SE HORA INICIAL MAIOR QUE HORA FINAL FAZ: 
                else {
                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $valid = $query->num_rows;
                    if($valid > 0){
                        $mensagens_idPe = 3;
                        $mensagens_id = 3;
                    }else{
                        $mensagens_idPe = 37;
                        $mensagens_id = 2;
                    }
                    // Se a hora fim for mneor que a hora de inicio percorre o Loop através de cada dia no período, para fazer dois INSERT na tabela locação
                    $timeFrom_seg = '00:00:00';
                    $timeTo_seg = '23:59:00';

                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação por periodo
                    $stmt = $conn->prepare("INSERT INTO lc_period (users_id, room_id, vehicle_id, equip_id, mensagens_id, weekday, checkin, checkout, checkin_time, checkout_time, approver_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiiisssssis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_idPe, $dia_semana, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $approver_id, $eventInfo);
                    $stmt->execute();

                    $lc_period_id = $stmt->insert_id;

                    $stmt->close();

                    $stmt = $conn->query("INSERT INTO `activities` set mensagens_id = 2, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn));
                    
                    for ($data = $checkin_dateIn; $data <= $checkin_dateOut; $data->modify('+1 day')) {
                        // Verificar se o usuário escolheu "Todos os dias" ou se a data é do dia da semana escolhido pelo usuário
                        if ($dia_semana === 'AllDays' || $data->format('l') === $dia_semana) {
                            // Adicionar a data na lista para o dia da semana correspondente
                            $dias_da_semana[$data->format('l')][] = $data->format('Y-m-d');
                            
                            $dataFormat = $data->format('Y-m-d');

                            $dataFormatString = $data->format('d-m-Y');
                            // FAZ O PRIMEIRO INSERT E A PRIMEIRA VERIFICAÇÃO

                            // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
                            $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                            $stmt->bind_param("ss", $firstname, $lastname);
                            $stmt->execute();
                            $stmt->bind_result($users_id);
                            $stmt->fetch();
                            $stmt->close();

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
                                $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $dataFormat, $timeFrom, $timeFrom, $timeFrom, $timeTo_seg, $timeTo_seg, $timeTo_seg);
                                $select_query->execute();
                                $select_query->store_result();

                            if ($select_query->num_rows > 0) {

                                // Remove a locação inserida
                                $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                // Remove a primeira locação por periodo inserida
                                $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                echo "<script>alert('Já existe uma reserva na data: ".$dataFormatString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                                echo '<script>hideOverlay();</script>';
                                exit;
                            }
                            else {

                                // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                                $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                                $valid = $query->num_rows;
                                if($valid > 0){
                                    $status_id = 2;
                                }else{
                                    $status_id = 1;
                                }
                            
                                // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                                $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id,  eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom, $timeTo_seg, $approver_id, $lc_period_id, $eventInfo);
                                $stmt->execute();
                                $stmt->close();                       
                                
                            
                            
                                // FAZ O SEGUNDO INSERT E A SEGUNDA VERIFICAÇÃO

                                // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
                                $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                                $stmt->bind_param("ss", $firstname, $lastname);
                                $stmt->execute();
                                $stmt->bind_result($users_id);
                                $stmt->fetch();
                                $stmt->close();

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
                                    $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $dataFormat, $timeFrom_seg, $timeFrom_seg, $timeFrom_seg, $timeTo, $timeTo, $timeTo);
                                    $select_query->execute();
                                    $select_query->store_result();

                                if ($select_query->num_rows > 0) {

                                    // Remove a locação inserida
                                    $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                    // Remove a primeira locação por periodo inserida
                                    $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                                    echo "<script>alert('Já existe uma reserva na data: ".$dataFormatString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                                    echo '<script>hideOverlay();</script>';
                                    exit;
                                }
                                else {

                                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                                    $valid = $query->num_rows;
                                    if($valid > 0){
                                        $status_id = 2;
                                    }else{
                                        $status_id = 1;
                                    }
                                
                                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                                    $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                    $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom_seg, $timeTo, $approver_id, $lc_period_id, $eventInfo);
                                    $stmt->execute();

                                    $locacao_id = $stmt->insert_id;

                                    $stmt->close();                       
                                    
                                }

                            }
                        }                    
                    
                    }
                    
                    //-----------------------------------------------------------------------------------------------//
                    // Verifica qual o primeiro id da tabela de locação que foi inserido do range por período
                    $stmt = $conn->prepare("SELECT locacao_id FROM locacao as lc WHERE lc.lc_period_id = ? LIMIT 1");
                    $stmt->bind_param("i", $lc_period_id);
                    $stmt->execute();
                    $stmt->bind_result($firstIDloc);
                    $stmt->fetch();
                    $stmt->close();

                    $firLocacao_id = ($firstIDloc +1);
                    
                    $penLocacao_id = ($locacao_id -1);

                    // Remove a primeira locação inserida
                    $conn->query("DELETE FROM `locacao` WHERE `locacao_id` = '$firLocacao_id'") or die(mysqli_error($conn));
                    // Remove a penultima locação inserida
                    $conn->query("DELETE FROM `locacao` WHERE `locacao_id` = '$penLocacao_id'") or die(mysqli_error($conn));

                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $verife = $query->num_rows;
                    if ($verife == 0){

                        //-----------------------------------------------------------------------------------------------//
                        // ENVIA EMAIL e Buscar dados do usuário que fez a locação, e os dados da locação para concatenar na mensagem
                        $stmt2 = $conn->prepare("SELECT 
                                                COALESCE(lb.room_no, vs.model) as description,
                                                COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                                CASE lc.weekday
                                                WHEN 'Monday' THEN 'Segunda-feira'
                                                WHEN 'Tuesday' THEN 'Terça-feira'
                                                WHEN 'Wednesday' THEN 'Quarta-feira'
                                                WHEN 'Thursday' THEN 'Quinta-feira'
                                                WHEN 'Friday' THEN 'Sexta-feira'
                                                WHEN 'Saturday' THEN 'Sábado'
                                                WHEN 'Sunday' THEN 'Domingo'
                                                ELSE 'Todos os dias' END AS dia_semana,
                                                lc.checkin, 
                                                lc.checkout, 
                                                lc.checkin_time, 
                                                lc.checkout_time 
                                                FROM `lc_period` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                                LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                                INNER JOIN `users` as u ON u.users_id = lc.users_id
                                                LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                                LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                                WHERE lc.lc_period_id = ?");
                        $stmt2->bind_param("i", $lc_period_id);
                        $stmt2->execute();
                        $stmt2->bind_result($description, $locacao, $weekday, $checkin, $checkout, $checkin_time, $checkout_time);
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

                        $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Dia da Semana#'. $weekday.' * Data de Início#'. $checkin.' * Data Final#'. $checkout.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';
                    
                        // Busca dados dos aprovadores de acordo com o $approver_id
                        $stmt = $conn->prepare("SELECT
                                                    u.firstname
                                                    ,u.lastname
                                                    ,u.email
                                                FROM gp_approver as gp
                                                LEFT JOIN users as u
                                                ON u.users_id = gp.users_id
                                                WHERE gp.gp_approver_id = (SELECT gp_approver_id
                                                                        FROM gr_approved as gr 
                                                                        WHERE users_id = ?
                                                                        )
                                                ");
                        $stmt->bind_param("i", $users_id);
                        $stmt->execute();
                        $stmt->bind_result($fadname, $ladname, $ademail);
                        // Laço para enviar um email para cada usuário encontrado
                        while ($stmt->fetch()) {
                        $nmadmin = $fadname . " " . $ladname;

                        $message = "Menssagem enviada de: \n \nAdministrador: " .$nome. "\nEmail: " .$ademail." \n \nSeu pedido de reserva foi confimado. \n \nInformações da reserva:\n \n - Locação: " . $locacao. "\n - Data de início: " .$checkin. "\n - Data de final: " .$checkout. "\n - Dia da semana: " . $weekday. "\n - Hora de início: " . $checkin_time. "\n - Hora final: " . $checkout_time;

                        // Chama função para enviar email
                        sendMailPerLoc ($email, $nome, $assunto, $nmadmin, $ademail, $message, $dadosLocacao);
                        }
                        // Fecha a conexão com o banco de dados
                        $stmt->close();

                        echo '<script>hideOverlay();</script>';


                        //--------------------------------------------------------------------------------------------//
                    }

                    // tentar enviar o email para o uusário caso ele esteja na lista de exeções

                }


                // Fecha a conexão com o banco de dados
                $conn->close();

                // Define a resposta
                echo "<script>alert('Solicitação de reserva enviada com sucesso!'); window.location.href = 'reservlab.php?calender';</script>";
                echo '<script>hideOverlay();</script>';
            }            
            // SE ESCOLHA NÃO FAZ:
            else{
                // ---------------------------------------------------------------------------------------------------------------------
                // Exibir as datas de início e fim
                // echo "Data de início: " . $mysql_dateIn . " às " . $timeFrom . "<br>";
                // echo "Data de fim: " . $mysql_dateOut . " às " . $timeTo . "<br>";

                $datatmysql_dateInString = $checkin_dateIn->format('d-m-Y');

                $datamysql_dateOutString = $checkin_dateOut->format('d-m-Y');

                // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                $valid = $query->num_rows;
                if($valid > 0){
                    $mensagens_idPe = 3;
                    $mensagens_id = 3;
                }else{
                    $mensagens_idPe = 37;
                    $mensagens_id = 2;
                }

                // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação por periodo
                $stmt = $conn->prepare("INSERT INTO lc_period (users_id, room_id, vehicle_id, equip_id, mensagens_id, weekday, checkin, checkout, checkin_time, checkout_time, approver_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiiisssssis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_idPe, $dia_semana, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $approver_id, $eventInfo);
                $stmt->execute();

                $lc_period_id = $stmt->insert_id; // retorna o ultimo id inserido

                $stmt->close();

                $timeToFI = '23:59:00';
                
                // 1º INSERT - Verifica se a locação já exite no banco de dados com base nos dados recebidos para a primeira data de inicio a ser inserida.
                $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                $stmt->bind_param("ss", $firstname, $lastname);
                $stmt->execute();
                $stmt->bind_result($users_id);
                $stmt->fetch();
                $stmt->close();

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
                    $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $mysql_dateIn, $timeFrom, $timeFrom, $timeFrom, $timeToFI, $timeToFI, $timeToFI);
                    $select_query->execute();
                    $select_query->store_result();

                if ($select_query->num_rows > 0) {

                    // Remove a locação inserida
                    $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                    // Remove a locação por periodo inserida
                    $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                    echo "<script>alert('Já existe uma reserva na data: ".$datatmysql_dateInString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                    echo '<script>hideOverlay();</script>';
                    exit;
                }
                else {

                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $valid = $query->num_rows;
                    if($valid > 0){
                        $status_id = 2;
                    }else{
                        $status_id = 1;
                    }
                
                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                    $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $mysql_dateIn, $timeFrom, $timeToFI, $approver_id, $lc_period_id, $eventInfo);
                    $stmt->execute();
                    $stmt->close();

                    $timeFromFI = '00:00:00';

                    // 2º INSERT - Verifica se a locação já exite no banco de dados com base nos dados recebidos para a ultima data de devolução a ser inserida.
                    $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                    $stmt->bind_param("ss", $firstname, $lastname);
                    $stmt->execute();
                    $stmt->bind_result($users_id);
                    $stmt->fetch();
                    $stmt->close();

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
                        $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $mysql_dateOut, $timeFromFI, $timeFromFI, $timeFromFI, $timeTo, $timeTo, $timeTo);
                        $select_query->execute();
                        $select_query->store_result();

                    if ($select_query->num_rows > 0) {

                        // Remove a locação inserida
                        $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                        // Remove a locação por periodo inserida
                        $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                        echo "<script>alert('Já existe uma reserva na data: ".$datamysql_dateOutString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                        echo '<script>hideOverlay();</script>';
                        exit;
                    }
                    else {
                    
                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $valid = $query->num_rows;
                    if($valid > 0){
                        $status_id = 2;
                    }else{
                        $status_id = 1;
                    }
                
                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                    $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $mysql_dateOut, $timeFromFI, $timeTo, $approver_id, $lc_period_id, $eventInfo);
                    $stmt->execute();
                    $stmt->close();

                    // Gerar array com todas as datas dentro do período, excluindo a data de início e fim
                    $interval = new DateInterval('P1D');
                    $daterange = new DatePeriod($checkin_dateIn->add(new DateInterval('P1D')), $interval, $checkin_dateOut);
                    $datas_intermediarias = [];
                    foreach ($daterange as $dateInt) {
                        $datas_intermediarias[] = $dateInt;
                    }

                    // Iterar com todas as datas intermediárias dentro do intervalo da locação
                    echo "Datas intermediárias no intervalo:<br>";
                    foreach ($datas_intermediarias as $dateInt) {

                        $dateFormatInsert = $dateInt->format("Y-m-d");

                        $dateIntString = $dateInt->format('d-m-Y');

                        // DEMAIS INSERT - Verifica se a locação já exite no banco de dados com base nos dados recebidos para a primeira data de inicio a ser inserida.
                        $stmt = $conn->prepare("SELECT users_id FROM users WHERE firstname = ? AND lastname = ?");
                        $stmt->bind_param("ss", $firstname, $lastname);
                        $stmt->execute();
                        $stmt->bind_result($users_id);
                        $stmt->fetch();
                        $stmt->close();

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
                            $select_query->bind_param("iiisssssss", $room_id, $vehicle_id, $equip_id, $dateFormatInsert, $timeFromFI, $timeFromFI, $timeFromFI, $timeToFI, $timeToFI, $timeToFI);
                            $select_query->execute();
                            $select_query->store_result();

                        if ($select_query->num_rows > 0) {

                            // Remove a locação inserida
                            $conn->query("DELETE FROM `locacao` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                            // Remove a locação por periodo inserida
                            $conn->query("DELETE FROM `lc_period` WHERE `lc_period_id` = '$lc_period_id'") or die(mysqli_error($conn));

                            echo "<script>alert('Já existe uma reserva na data: ".$dateIntString." desse periodo'); window.location.href = 'reservlab.php?calender';</script>";
                            echo '<script>hideOverlay();</script>';
                            exit;
                        }
                        else {

                            // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                            $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                            $valid = $query->num_rows;
                            if($valid > 0){
                                $status_id = 2;
                            }else{
                                $status_id = 1;
                            }
                        
                            // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                            $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id, eventInfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("iiiiiisssiis", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dateFormatInsert, $timeFromFI, $timeToFI, $approver_id, $lc_period_id, $eventInfo);
                            $stmt->execute();
                            $stmt->close();
                        
                        }

                    }

                    // Verifica se o usuário que etá locando for da lista de exceção, caso for já salva como reservado
                    $query = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$users_id'") or die(mysqli_error($conn));
                    $verife = $query->num_rows;
                    if ($verife == 0){
                        
                        //-----------------------------------------------------------------------------------------------//
                        // ENVIA EMAIL e Buscar dados do usuário que fez a locação, e os dados da locação para concatenar na mensagem
                        $stmt2 = $conn->prepare("SELECT 
                                                COALESCE(lb.room_no, vs.model) as description,
                                                COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                                CASE lc.weekday
                                                WHEN 'Monday' THEN 'Segunda-feira'
                                                WHEN 'Tuesday' THEN 'Terça-feira'
                                                WHEN 'Wednesday' THEN 'Quarta-feira'
                                                WHEN 'Thursday' THEN 'Quinta-feira'
                                                WHEN 'Friday' THEN 'Sexta-feira'
                                                WHEN 'Saturday' THEN 'Sábado'
                                                WHEN 'Sunday' THEN 'Domingo'
                                                ELSE 'Todos os dias' END AS dia_semana,
                                                lc.checkin, 
                                                lc.checkout, 
                                                lc.checkin_time, 
                                                lc.checkout_time 
                                                FROM `lc_period` as lc INNER JOIN `users` as us ON lc.users_id = us.users_id
                                                LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                                INNER JOIN `users` as u ON u.users_id = lc.users_id
                                                LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                                LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                                WHERE lc.lc_period_id = ?");
                        $stmt2->bind_param("i", $lc_period_id);
                        $stmt2->execute();
                        $stmt2->bind_result($description, $locacao, $weekday, $checkin, $checkout, $checkin_time, $checkout_time);
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

                        $dadosLocacao = ' * Locação#'.$locacao.' * Descrição#'.$description.' * Dia da Semana#'. $weekday.' * Data de Início#'. $checkin.' * Data Final#'. $checkout.' * Hora de Início#'. $checkin_time.' * Hora Final#'. $checkout_time.'';
                    
                        // Busca dados dos aprovadores de acordo com o $approver_id
                        $stmt = $conn->prepare("SELECT
                                                    u.firstname
                                                    ,u.lastname
                                                    ,u.email
                                                FROM gp_approver as gp
                                                LEFT JOIN users as u
                                                ON u.users_id = gp.users_id
                                                WHERE gp.gp_approver_id = (SELECT gp_approver_id
                                                                        FROM gr_approved as gr 
                                                                        WHERE users_id = ?
                                                                        )
                                                ");
                        $stmt->bind_param("i", $users_id);
                        $stmt->execute();
                        $stmt->bind_result($fadname, $ladname, $ademail);
                        // Laço para enviar um email para cada usuário encontrado
                        while ($stmt->fetch()) {
                            $nmadmin = $fadname . " " . $ladname;

                            $message = "Menssagem enviada de: \n \nAdministrador: " .$nome. "\nEmail: " .$ademail." \n \nSeu pedido de reserva foi confimado. \n \nInformações da reserva:\n \n - Locação: " . $locacao. "\n - Data de início: " .$checkin. "\n - Data de final: " .$checkout. "\n - Dia da semana: " . $weekday. "\n - Hora de início: " . $checkin_time. "\n - Hora final: " . $checkout_time;

                            // Chama função para enviar email
                            sendMailPerLoc ($email, $nome, $assunto, $nmadmin, $ademail, $message, $dadosLocacao);
                            
                            // Fecha a conexão com o banco de dados
                            $conn->close();

                            echo "<script>alert('Solicitação de reserva enviada com sucesso!'); window.location.href = 'reservlab.php?calender';</script>";
                            echo '<script>hideOverlay();</script>';
                            
                        }
                    }
                }
            }
        }
    }
}
?>
