<?php
// Arquivo: atualizar-locacoes.php
// Estabelece a conexão com o banco de dados
require_once "connect.php";
require_once 'validate.php';

// Define horário de Brasilia
date_default_timezone_set('America/Sao_Paulo');

// Define a data atual
$dataAtual = date("Y-m-d");

// Define a hora atual
$horaAtual = date("H:i:s");

// Consulta as locações com checkout_time menor ou igual a hora atual e mensagens_id = 3
$query = $conn->prepare("SELECT locacao_id, checkin, checkout_time FROM `locacao` WHERE mensagens_id IN (2,3)");
$query->bind_result($locacao_id, $checkin, $checkout_time);
$query->execute();
$query->store_result();
$row = $query->num_rows();

// Percorre os resultados da consulta e atualiza as locações
if ($row > 0) {
  while($query->fetch()) {
    // Verifica se a data encontrada no banco é menor ou igual que a data atual e s
    if ($checkin < $dataAtual || ($checkin == $dataAtual && $checkout_time < $horaAtual)){
      echo $checkin,"\n";
      echo $dataAtual,"\n";
      echo $checkout_time,"\n";
      echo $horaAtual,"\n";

    // Atualiza a locação com mensagens_id = 4 e checkout_time igual ao valor encontrado na consulta SOMENTE SALAS
      $sql = $conn->prepare("UPDATE locacao SET mensagens_id = 4, status_id = 4  WHERE locacao_id = ? && (room_id IS NOT NULL OR lc_period_id IS NOT NULL)");
      $sql->bind_param("s", $locacao_id);
      $sql->execute();
      $sql->close();
      $conn->query("INSERT INTO `activities` set mensagens_id = 4, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn)); 
      echo 'Eventos finalizados';

    // Atualiza a locação para atrasada e checkout_time igual ao valor encontrado na consulta SOMENTE veiculos e fora da locação por periodo.
    $sql = $conn->prepare("UPDATE locacao SET mensagens_id = 38, status_id = 8  WHERE locacao_id = ? && lc_period_id IS NULL && vehicle_id IS NOT NULL");
    $sql->bind_param("s", $locacao_id);
    $sql->execute();
    $sql->close(); 
    }
    else {
      echo 'Nenhum evento finalizado';
    } 
  }
}
else {
  echo 'Nenhum evento encontrado';//
}
?>
