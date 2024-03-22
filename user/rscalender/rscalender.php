<?php
require_once 'validate.php';

// Inicialize as variáveis para garantir que estejam vazias se não houver retorno da REQUEST
$vehicleRQ = "";
$roomRQ = "";
$equipRQ = "";
$value = "";

// Verifica se há um parâmetro na URL
if(isset($_GET['vehicle_id'])) {
    $vehicle_id = $_GET['vehicle_id'];
    // Executa a consulta SQL para buscar informações do veículo com o ID fornecido
    $queryad = $conn->query("SELECT * FROM vehicles WHERE vehicle_id = $vehicle_id") or die(mysqli_error($conn));
    $fetch = $queryad->fetch_array();
    $vehicleRQ = strval($fetch['name'] . " - " . $fetch['model'] . " - " . $fetch['description']);
    
} elseif(isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
    // Executa a consulta SQL para buscar informações da sala com o ID fornecido
    $queryad = $conn->query("SELECT * FROM laboratorios WHERE room_id = $room_id") or die(mysqli_error($conn));
    $fetch = $queryad->fetch_array();
    $roomRQ = $fetch['room_type']." - ".$fetch['room_no'];

} elseif(isset($_GET['equip_id'])) {
    $equip_id = $_GET['equip_id'];
    // Executa a consulta SQL para buscar informações do equipamento com o ID fornecido
    $queryad = $conn->query("SELECT * FROM equipment WHERE equip_id = $equip_id") or die(mysqli_error($conn));
    $fetch = $queryad->fetch_array();
    $equipRQ = $fetch['equipment'];
}

// Define o valor $value se a respectiva variável não estiver vazia
if(!empty($vehicleRQ) and empty($equipRQ) and empty($equipRQ)){
    $value = $vehicleRQ;
} elseif(!empty($roomRQ) and empty($vehicleRQ) and empty($equipRQ)){
    $value = $roomRQ;
} elseif(!empty($equipRQ) and empty($vehicleRQ) and empty($roomRQ)){
    $value = $equipRQ;
}

?>

<div class="overlay">
  <div class="loadingio-spinner-spinner-7u0gjvj5v5j">
    <div class="ldio-z00xh444d9c">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
      <div></div><div></div><div></div><div></div><div></div>
    </div>
  </div>
</div>

<div class="main-content" style="padding: 10px 5px 0px 5px;">
<div class="container" >
    <div class="left">
        <div class="calendar">
            <div class="month">
                <i class="fas fa-angle-left prev"></i>
                <div class="date">Dezembro 2023</div>
                    <i class="fas fa-angle-right next"></i>
                </div>
                    <div class="weekdays">
                        <div>Dom</div>
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sab</div>
                    </div>
                <div class="days"></div>
                    <div class="goto-today">
                        <div class="goto">
                            <input type="text" placeholder="mm/yyyy" class="date-input" />
                            <button class="goto-btn">Buscar</button>
                        </div>
                            <button class="today-btn">Hoje</button>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="today-date">
                    <div class="event-day">Qua</div>
                    <div class="event-date">12 de dezembro 2023</div>
                </div>
                <div class="events"></div>
                    <div class="add-event-wrapper">
                        <div class="add-event-header">
                        <div class="title" style="color:#5faa4f;"><strong>Adicionar Reserva</strong></div>
                            <i class="fas fa-times close"></i>
                        </div>
                        <div class="add-event-body">
                            <div class="add-event-input">
                                <select class="event-name select-box">
                                    <!-- query para trazer as salas -->
                                    <!-- <option value="<?php echo ($vehicleRQ != "") ? $vehicleRQ : (($roomRQ != "") ? $roomRQ : (($equipRQ != "") ? $equipRQ : "")); ?>" disabled selected>
                                        <?php echo ($vehicleRQ != "") ? $vehicleRQ : (($roomRQ != "") ? $roomRQ : (($equipRQ != "") ? $equipRQ : "Escolha o que você deseja locar")); ?>
                                    </option> -->
                                    <option value="" disabled selected>Escolha o que você deseja locar</option>
                                    <optgroup label="Salas">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                    ?>     
                                        <option><?php echo $fetch['room_type']." - ".$fetch['room_no']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <!-- query para trazer as veículos -->
                                    <optgroup label="Veículos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `vehicles`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                    ?>     
                                        <option><?php echo $fetch['name']." - ".$fetch['model']. " - " .$fetch['description']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <!-- query para trazer as equipameantos -->
                                    <optgroup label="Equipamentos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `equipment`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                    ?>     
                                        <option><?php echo $fetch['equipment']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="add-event-input" style="display:none">
                               
                                <?php  
									$queryad = $conn->query("SELECT * FROM `users` WHERE users_id = $_SESSION[users_id]") or die(mysqli_error($conn));
									while($fetch = $queryad->fetch_array()){
                                    $users_id = $fetch['users_id'];
                                    
                                ?>
                                <input class="event-disc select-box" type="hidden" value="<?php echo $users_id?>">
                                <?php
                                    }
                                ?>
                            </div>                            
                            <div class="add-event-input">
                                <input type="text" placeholder="Hora da Locação" class="event-time-from"/>
                            </div>
                            <div class="add-event-input">
                                <input type="text" placeholder="Hora da Devolução" class="event-time-to"/>
                            </div>
                            <!-- Novo input -->
                            <div class="add-event-input">
                                <input type="text" placeholder="Motivo" maxlength="45" class="event-info"/>
                            </div>
                        </div>
                        <div class="add-event-footer div-swing ">
                            <button class="add-event-btn">Salvar</button>
                        </div>
                    </div>
                </div>
                <button class="add-event"><i class="fas fa-plus"></i></button>
            </div>




