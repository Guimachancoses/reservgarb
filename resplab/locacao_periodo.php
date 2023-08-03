<?php
    require_once 'connect.php';
    require_once 'validate.php';
    // Verificar se ocorreu algum erro na conexão
    if(ISSET($_POST['locacao_periodo'])){
        // Obter a data de início e fim do usuário
        $eventTitle = $_POST['eventTitle'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $dia_semana = $_POST['dia_semana'];
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

        // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
        $verif = $conn->prepare("SELECT lc_period_id
        FROM lc_period
        WHERE lc_period_id IN (
                SELECT lc_period_id
                FROM lc_period 
                WHERE room_id = ? 
                                AND (
                                    (checkin <= ? AND checkout >= ?)
                                OR (checkin <= ? AND checkout >= ?)
                                OR (checkin >= ? AND checkout <= ?)
                                OR (checkin <= ? AND checkout >= ?)
                                )
                                AND checkin_time <= ? 
                                AND (checkout_time <= ? OR checkout_time > ?)
                                AND mensagens_id != 4
                            )
        OR lc_period_id IN (
                SELECT lc_period_id 
                FROM lc_period 
                WHERE vehicle_id = ? 
                                    AND (
                                        (checkin <= ? AND checkout >= ?)
                                    OR (checkin <= ? AND checkout >= ?)
                                    OR (checkin >= ? AND checkout <= ?)
                                    OR (checkin <= ? AND checkout >= ?)
                                    )
                                    AND checkin_time <= ? 
                                    AND (checkout_time <= ? OR checkout_time > ?)
                                    AND mensagens_id != 4
                            )
        OR lc_period_id IN (
                SELECT lc_period_id 
                FROM lc_period 
                WHERE equip_id = ? 
                                AND (
                                    (checkin <= ? AND checkout >= ?)
                                OR (checkin <= ? AND checkout >= ?)
                                OR (checkin >= ? AND checkout <= ?)
                                OR (checkin <= ? AND checkout >= ?)
                                )
                                AND checkin_time <= ? 
                                AND (checkout_time <= ? OR checkout_time > ?)
                                AND mensagens_id != 4
                            )");
        $verif->bind_param("isssssssssssisssssssssssisssssssssss", $room_id, $mysql_dateIn, $mysql_dateIn, $mysql_dateOut, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $timeTo, $vehicle_id, $mysql_dateIn, $mysql_dateIn, $mysql_dateOut, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $timeTo, $equip_id, $mysql_dateIn, $mysql_dateIn, $mysql_dateOut, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $timeTo);
        $verif->execute();
        $verif->store_result();
        $valid = $verif->num_rows();

        if ($valid > 0) {
            // Se a locação existe retorne nada
            echo "<script>alert('Já existe uma reserva nesse periodo'); window.location.href = 'reservlab.php?period';</script>";
        }
        else {

                $mensagens_id = 2;

                if ($timeTo > $timeFrom) {

                    // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação por periodo
                    $stmt = $conn->prepare("INSERT INTO lc_period (users_id, room_id, vehicle_id, equip_id, mensagens_id, weekday, checkin, checkout, checkin_time, checkout_time, approver_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiiisssssi", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $dia_semana, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $approver_id);
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
                            $verif1 = $conn->prepare("SELECT locacao_id
                            FROM locacao
                            WHERE locacao_id IN (
                                    SELECT locacao_id
                                    FROM locacao 
                                    WHERE room_id = ? AND checkin = ? AND checkin_time >= ? AND checkout_time <= ? and mensagens_id != 4)
                            OR locacao_id IN (
                                    SELECT locacao_id 
                                    FROM locacao 
                                    WHERE vehicle_id = ? AND checkin = ? AND checkin_time >= ? AND checkout_time <= ? and mensagens_id != 4)
                            OR locacao_id IN (
                                    SELECT locacao_id 
                                    FROM locacao 
                                    WHERE equip_id = ? AND checkin = ? AND checkin_time >= ? AND checkout_time <= ? and mensagens_id != 4)");
                            $verif1->bind_param("isssisssisss", $room_id, $dataFormat, $timeFrom, $timeTo, $vehicle_id, $dataFormat, $timeFrom, $timeTo, $equip_id, $dataFormat, $timeFrom, $timeTo);
                            $verif1->execute();
                            $verif1->store_result();
                            $valid2 = $verif->num_rows();

                            if ($valid2 > 0) {
                            // Se a locação existe retorne nada
                            echo "<script>alert('Já existe uma reserva na data: ".$data." desse periodo'); window.location.href = 'reservlab.php?period';</script>";
                            }
                            else {

                                $status_id = 1;
                            
                            // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                                $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("iiiiiisssii", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom, $timeTo, $approver_id, $lc_period_id);
                                $stmt->execute();
                                $stmt->close();
                                
                            }
                        } 
                    
                    }
                } 
                else {
                // Se a hora fim for mneor que a hora de inicio percorre o Loop através de cada dia no período, para fazer dois INSERT na tabela locação
                $timeFrom_seg = '00:00:00';
                $timeTo_seg = '23:59:00';

                // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação por periodo
                $stmt = $conn->prepare("INSERT INTO lc_period (users_id, room_id, vehicle_id, equip_id, mensagens_id, weekday, checkin, checkout, checkin_time, checkout_time, approver_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiiiisssssi", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $dia_semana, $mysql_dateIn, $mysql_dateOut, $timeFrom, $timeTo, $approver_id);
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

                        // FAZ O PRIMEIRO INSERT E A PRIMEIRA VERIFICAÇÃO

                        // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
                        $verif1 = $conn->prepare("SELECT locacao_id
                        FROM locacao
                        WHERE locacao_id IN (
                                SELECT locacao_id
                                FROM locacao 
                                WHERE room_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE vehicle_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE equip_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)");
                        $verif1->bind_param("issssissssissss", $room_id, $dataFormat, $timeFrom, $timeTo_seg, $timeTo_seg, $vehicle_id, $dataFormat, $timeFrom, $timeTo_seg, $timeTo_seg, $equip_id, $dataFormat, $timeFrom, $timeTo_seg, $timeTo_seg);
                        $verif1->execute();
                        $verif1->store_result();
                        $valid2 = $verif->num_rows();

                        if ($valid2 > 0) {
                        // Se a locação existe retorne nada
                        echo "<script>alert('Já existe uma reserva na data: ".$data." desse periodo'); window.location.href = 'reservlab.php?period';</script>";
                        }
                        else {

                            $status_id = 1;
                        
                        // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                            $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("iiiiiisssii", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom, $timeTo_seg, $approver_id, $lc_period_id);
                            $stmt->execute();
                            $stmt->close();                       
                            
                        }

                        // FAZ O SEGUNDO INSERT E A SEGUNDA VERIFICAÇÃO

                        // Verifica se a locação já exite no banco de dados com base nos dados recebidos.
                        $verif1 = $conn->prepare("SELECT locacao_id
                        FROM locacao
                        WHERE locacao_id IN (
                                SELECT locacao_id
                                FROM locacao 
                                WHERE room_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE vehicle_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)
                        OR locacao_id IN (
                                SELECT locacao_id 
                                FROM locacao 
                                WHERE equip_id = ? AND checkin = ? AND checkin_time <= ? AND (checkout_time <= ? OR checkout_time > ?) AND mensagens_id != 4)");
                        $verif1->bind_param("issssissssissss", $room_id, $dataFormat, $timeFrom_seg, $timeTo, $timeTo, $vehicle_id, $dataFormat, $timeFrom_seg, $timeTo, $timeTo, $equip_id, $dataFormat, $timeFrom_seg, $timeTo, $timeTo);
                        $verif1->execute();
                        $verif1->store_result();
                        $valid2 = $verif->num_rows();

                        if ($valid2 > 0) {
                        // Se a locação existe retorne nada
                        echo "<script>alert('Já existe uma reserva na data: ".$data." desse periodo'); window.location.href = 'reservlab.php?period';</script>";
                        }
                        else {

                            $status_id = 1;
                        
                        // Realiza o INSERT no banco de dados usando as variáveis na tabela de locação
                            $stmt = $conn->prepare("INSERT INTO locacao (users_id, room_id, vehicle_id, equip_id, mensagens_id, status_id ,checkin, checkin_time, checkout_time, approver_id, lc_period_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("iiiiiisssii", $users_id, $room_id, $vehicle_id, $equip_id, $mensagens_id, $status_id, $dataFormat, $timeFrom_seg, $timeTo, $approver_id, $lc_period_id);
                            $stmt->execute();

                            $locacao_id = $stmt->insert_id;

                            $stmt->close();                       
                            
                        }
                    } 
                
                }

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

            }


            // Fecha a conexão com o banco de dados
            $conn->close();

            //Define a resposta
            echo "<script>alert('Solicitação de reserva enviada com sucesso!'); window.location.href = 'reservlab.php?perpen';</script>";
        }
    }
?>