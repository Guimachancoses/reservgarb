<?php
    require_once 'connect.php';
    require_once 'connect.php';
    // Verificar se ocorreu algum erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    if(ISSET($_POST['locacao_periodo'])){
        // Obter a data de início e fim do usuário
        $room_id = $_POST['room_id'];
        $disciplina_id = $_POST['disciplina_id'];
        $checkin = new DateTime($_POST['checkin']);
        $checkout = new DateTime($_POST['checkout']);
        $users_id = $_SESSION['users_id'];
        // Obter o dia da semana escolhido pelo usuário
        $dia_semana = $_POST['dia_semana'];

        // Obter a hora de inicio e fim das locações
        $checkin_time = $_POST['checkin_time'];
        $checkout_time = $_POST['checkout_time'];

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

        // Verificar se locação por periodo já existe

        $query = $conn->query("SELECT * FROM lc_periodo WHERE users_id = $users_id && room_id = $room_id && checkin =   $checkin && checkout = $checkout") or die(mysqli_error());

        // Loop através de cada dia no período
        for ($data = $checkin; $data <= $checkout; $data->modify('+1 day')) {
            // Verificar se o usuário escolheu "Todos os dias" ou se a data é do dia da semana escolhido pelo usuário
            if ($dia_semana === 'Todos os dias' || $data->format('l') === $dia_semana) {
                // Adicionar a data na lista para o dia da semana correspondente
                $dias_da_semana[$data->format('l')][] = $data->format('Y-m-d');
                
                // Criar a instrução de inserção para a data encontrada
                $sql = "INSERT INTO tabela (data) VALUES ('" . $data->format('Y-m-d') . "')";

                // Executar a instrução de inserção no banco de dados
                if ($conn->query($sql) === FALSE) {
                    echo "Erro ao inserir a data " . $data->format('Y-m-d') . ": " . $conn->error . "\n";
                }
            }
        }
        // Fechar a conexão com o banco de dados
        $conn->close();
    }
?>