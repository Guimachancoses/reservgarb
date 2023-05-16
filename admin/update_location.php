<?php
// Arquivo: atualizar-locacoes.php

// Estabelece a conexão com o banco de dados
require_once "connect.php";
require_once 'validate.php';
// Verifica se ocorreu algum erro ao conectar ao banco de dados
if ($conn->connect_error) {
  die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

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

    // Atualiza a locação com mensagens_id = 4 e checkout_time igual ao valor encontrado na consulta
      $sql = $conn->prepare("UPDATE locacao SET mensagens_id = 4, status_id = 4  WHERE locacao_id = ? ");
      $sql->bind_param("s", $locacao_id);
      $sql->execute();
      $sql->close();
      $conn->query("INSERT INTO `activities` set mensagens_id = 4, users_id = '$_SESSION[users_id]'") or die(mysqli_error()); 
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
