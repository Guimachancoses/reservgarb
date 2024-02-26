<?php
require_once 'connect.php';
require_once 'validate.php';
// Executa a consulta SQL para buscar os eventos inseridos no banco de dados
$query = $conn->query("SELECT 
                            lc.checkin,
                            lc.checkin_time,
                            lc.checkout_time,
                            COALESCE(lb.room_type, vs.name, eq.equipment) AS locacao,
                            COALESCE(lb.room_no, vs.model, LEFT(eq.description, 9)) AS description,
                            us.firstname,
                            us.lastname,
                            CASE 
                                WHEN lc.status_id = 1 THEN 'Pend.'
                                WHEN lc.status_id = 8 THEN 'Atrasa.'
                                ELSE 'Reserv.'
                            END AS status
                            FROM `locacao` AS lc 
                            LEFT JOIN `laboratorios` AS lb ON lb.room_id = lc.room_id
                            LEFT JOIN `vehicles` AS vs ON vs.vehicle_id = lc.vehicle_id
                            LEFT JOIN `equipment` AS eq ON eq.equip_id = lc.equip_id
                            INNER JOIN `users` AS us ON us.users_id = lc.users_id
                            WHERE lc.mensagens_id != 4; ") or die(mysqli_error($conn));
// Cria um array para armazenar os eventos
$events = array();
// Adiciona cada evento ao array de eventos
while ($row = $query->fetch_assoc()) {
  list($year, $month, $day) = explode('-', $row['checkin']);
  $checkin_time = date('h:i A', strtotime($row['checkin_time']));
  $checkout_time = date('h:i A', strtotime($row['checkout_time']));

  $date = array(
    'day'=> intval($day),
    'month'=> intval($month),
    'year'=> intval($year),
    'title' => $row['locacao']." - ".substr($row["description"], 0, 15)." * ".$row['status']." - ".$row['firstname']." ".substr($row['lastname'], 0, 2).".",
    'time' => $checkin_time . " - " . $checkout_time,
  );
  array_push($events, $date);
}    

// Converte o array de eventos para JSON e retorna a resposta do servidor
echo json_encode($events);

?>
