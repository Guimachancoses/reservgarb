<?php
require_once 'connect.php';
// Executa a consulta SQL para buscar os eventos inseridos no banco de dados
$query = $conn->query("SELECT 
                          lc.checkin,
                          lc.checkin_time,
                          lc.checkout_time,
                          lb.room_type,
                          lb.room_no,
                          us.firstname,
                          us.lastname,
                          if (lc.status_id = 1, 'Pend.', 'Reserv.') as status
                          FROM `locacao`as lc 
                          INNER JOIN `laboratorios` as lb 
                          ON lb.room_id = lc.room_id
                          INNER JOIN `disciplinas`as dc
                          ON dc.disciplina_id = lc.disciplina_id
                          INNER JOIN `users` as us
                          ON us.users_id = lc.users_id
                          WHERE lc.mensagens_id != 4 ") or die(mysqli_error());
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
    'title' => $row['room_type']." - ".$row["room_no"]." * ".$row['status']." - ".$row['firstname']." ".substr($row['lastname'], 0, 1).".",
    'time' => $checkin_time . " - " . $checkout_time,
  );
  array_push($events, $date);
}    

// Converte o array de eventos para JSON e retorna a resposta do servidor
echo json_encode($events);

?>
