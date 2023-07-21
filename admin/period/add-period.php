<div class="main-content">    
        <div class="row">
			<div class="col-lg-7 ">
				<div class="card" style="min-height:625px">
                    <div class="card-foot" style="padding: 10px; display: flex; justify-content: flex-start;">
                        <button class="btn btn-info form-control" onclick="goBack()" style="padding: 2px; font-size: 8px; width: 50px;">
                            <i class="material-icons" style="vertical-align: middle; margin-right: 5px;">undo</i>
                        </button>
                    </div>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Locação por Período</strong></h4>
						    <p class="category">Escolha o que você deseja reservar e o período que você deseja:</p>
                    <div class = "col-md-10"style="min-height:650px">	
                        <form method = "POST" action="locacao_periodo.php" enctype = "multipart/form-data" autocomplete="off">
                            <div class="card-foot">
                                <label><strong> Reservar:</strong></label>
                                <select class = "form-control" name = "eventTitle" required = required>
                                                                                                                       
                                    <!-- query para trazer as salas -->
                                    <option value="" disabled selected>Escolha o que você deseja locar:</option>
                                    <optgroup label="Salas">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                        $room_type = $fetch['room_type'];
                                    ?>     
                                        <option value="<?php echo $room_type?>"><?php echo $fetch['room_type']." - ".$fetch['room_no']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <!-- query para trazer as veículos -->
                                    <optgroup label="Veículos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `vehicles`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                        $name = $fetch['name'];
                                    ?>     
                                        <option value="<?php echo $name?>"><?php echo $fetch['name']." - ".$fetch['model']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                    <!-- query para trazer as equipameantos -->
                                    <optgroup label="Equipamentos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `equipment`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                        $equip = $fetch['equipment'];
                                    ?>     
                                        <option value="<?php echo $equip?>"><?php echo $fetch['equipment']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Data de Início:</strong></label>
                                <input type="date" class = "form-control" name = "checkin" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Data Fim:</strong></label>
                                <input type="date" class = "form-control" name = "checkout" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Dia da Semana:</strong></label>
                                <select class="form-control" name="dia_semana"required = required>
                                    <option value="" disabled selected>Escolha o dia da semana</option>
                                    <option value="Monday">- Segunda-feira -</option>
                                    <option value="Tuesday">- Terça-feira -</option>
                                    <option value="Wednesday">- Quarta-feira -</option>
                                    <option value="Thursday">- Quinta-feira -</option>
                                    <option value="Friday">- Sexta-feira -</option>
                                    <option value="Saturday">- Sábado -</option>
                                    <option value="Sunday">- Domingo -</option>
                                    <option value="AllDays"> - Todos os dias - </option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Hora de Início:</strong></label>
                                <input type="time" class = "form-control" name = "checkin_time" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Hora Fim:</strong></label>
                                <input type="time" class = "form-control" name = "checkout_time" required = required/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button type="submit" name = "locacao_periodo" onclick="success()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'locacao_periodo.php'?>

                </div>
            </div>
        </div>
</div>
</div>