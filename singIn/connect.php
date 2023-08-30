<?php
// Função responsável por fazer a conexão com o banco de dados
// Configuração de conexão com o banco de dados
$server = "192.168.1.64";
$username = "user.ip";
$password = "Fk@35978Gui@19==";
$db_name = "locationlab_db";

try {
    $conn = new mysqli($server, $username, $password, $db_name);
    if ($conn->connect_error) {
        throw new Exception('Verifique sua conexão com o banco de dados');
    }

    // Resto do seu código

} catch (Exception $e) {
    echo "<script>alert('Verifique sua conexão com o banco de dados'); window.location.href = 'index.php';</script>";
}

?>
