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
                                <select class="event-name select-box" >
                                    <!-- query para trazer as salas -->
                                    <option value="" disabled selected>Escolha o que você deseja locar</option>
                                    <optgroup label="Salas">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error());
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
                                        $queryad = $conn->query("SELECT * FROM `vehicles`") or die(mysqli_error());
                                        while($fetch = $queryad->fetch_array()){
                                    ?>     
                                        <option><?php echo $fetch['name']." - ".$fetch['model']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <!-- query para trazer as equipameantos -->
                                    <optgroup label="Equipamentos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `equipment`") or die(mysqli_error());
                                        while($fetch = $queryad->fetch_array()){
                                    ?>     
                                        <option><?php echo $fetch['equipment']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="add-event-input">
                                <select class="event-disc select-box" >
                                <option class="select-box" syle="border:none; outline:none; color:#5faa4f;"value="" disabled selected>Escolha o quem irá locar</option>
                                <?php  
									$queryad = $conn->query("SELECT * FROM `users` WHERE users_id != $_SESSION[users_id]") or die(mysqli_error());
									while($fetch = $queryad->fetch_array()){
								?>
                                    <option class="select-box" syle="border:none; outline:none; color:#5faa4f;"><?php echo $fetch['firstname']." ".$fetch['lastname'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="add-event-input">
                                <input type="text" placeholder="Hora da Locação" class="event-time-from" />
                            </div>
                            <div class="add-event-input">
                                <input type="text" placeholder="Hora da Devolução" class="event-time-to" />
                            </div>
                        </div>
                        <div class="add-event-footer div-swing ">
                            <button class="add-event-btn">Salvar</button>
                        </div>
                    </div>
                </div>
                <button class="add-event"><i class="fas fa-plus"></i></button>
            </div>

