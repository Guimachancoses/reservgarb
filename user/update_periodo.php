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
$query = $conn->prepare("SELECT lc_period_id, checkout, checkout_time FROM `lc_period` WHERE mensagens_id IN (2,3)");
$query->bind_result($lc_period_id, $checkout, $checkout_time);
$query->execute();
$query->store_result();
$row = $query->num_rows();

// Percorre os resultados da consulta e atualiza as locações
if ($row > 0) {
  while($query->fetch()) {
    // Verifica se a data encontrada no banco é menor ou igual que a data atual e s
    if ($checkout < $dataAtual || ($checkout == $dataAtual && $checkout_time < $horaAtual)){
 
    // Atualiza a locação com mensagens_id = 4 e checkout_time igual ao valor encontrado na consulta
      $sql = $conn->prepare("UPDATE lc_period SET mensagens_id = 4 WHERE lc_period_id = ? ");
      $sql->bind_param("s", $lc_period_id);
      $sql->execute();
      $sql->close();
      $conn->query("INSERT INTO `activities` set mensagens_id = 4, users_id = '$_SESSION[users_id]'") or die(mysqli_error($conn)); 
      echo 'Eventos finalizados';
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
