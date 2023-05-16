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
                        <div class="title" style="color:#b38add;"><strong>Adicionar Locação</strong></div>
                            <i class="fas fa-times close"></i>
                        </div>
                        <div class="add-event-body">
                            <div class="add-event-input">
                                <select class="event-name select-box" >
                                <option value="" disabled selected>Escolha o Laboratório</option>
                                <?php  
									$queryad = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error());
									while($fetch = $queryad->fetch_array()){
								?>
                                    <option><?php echo $fetch['room_type']." - ".$fetch['room_no']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="add-event-input">
                                <select class="event-disc select-box" >
                                <option class="select-box" syle="border:none; outline:none; color:#a5a5a5;"value="" disabled selected>Escolha sua Disciplina</option>
                                <?php  
									$queryad = $conn->query("SELECT * FROM `disciplinas`") or die(mysqli_error());
									while($fetch = $queryad->fetch_array()){
								?>
                                    <option class="select-box" syle="border:none; outline:none; color:#a5a5a5;"><?php echo $fetch['nm_disciplina'];?></option>
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
                        <div class="add-event-footer">
                            <button class="add-event-btn">Salvar</button>
                        </div>
                    </div>
                </div>
                <button class="add-event"><i class="fas fa-plus"></i></button>
            </div>
        

