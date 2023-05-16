<div class="main-content">    
        <div class="row">
			<div class="col-lg-7 ">
				<div class="card" style="min-height:650px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Locação por Período</strong></h4>
						    <p class="category">Escolha o período que você deseja alocar o laboratório:</p>
                    <div class = "col-md-10"style="min-height:650px">	
                        <form method = "POST" action="#">
                            <div class="card-footer">
                                    <label><strong> Laboratório:</strong></label>
                                    <select class = "form-control" id="room_id" name = "room_id" required = required>
                                        <option value = "" disabled selected> Escolha uma das opções</option>
                                        <?php 
                                            $querylb = $conn->query("SELECT * FROM laboratorios") or die (mysqli_error());
                                            while($fetchlb = $querylb->fetch_array()){
                                            $room_id = $fetchlb['room_id'];
                                        ?>
                                        <option value = "<?php echo $room_id?>">Lab. <?php echo $fetchlb['room_type']. " - Nº ".$fetchlb['room_no']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Disciplina:</strong></label>
                                <select class="form-control" name="disciplina_id"required = required>
                                <option value="" disabled selected>Escolha sua disciplina</option>
                                <?php  
                                    $queryad = $conn->query("SELECT * FROM `disciplinas` WHERE users_id = '$_SESSION[users_id]'") or die(mysqli_error());
                                    if (mysqli_num_rows($queryad) == 0) {
                                        echo '<option class="select-box" syle="border:none; outline:none; color:#a5a5a5;"value="">Sem disciplinas cadastradas</option>';
                                    }
                                    while($fetch = $queryad->fetch_array()){
                                    $disciplina_id = $fetchlb['disciplina_id'];
                                ?>
                                    <option value="<?php echo $disciplina_id?>"><?php echo $fetch['nm_disciplina'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Data de Início:</strong></label>
                                <input type="date" class = "form-control" name = "checkin" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Data Fim:</strong></label>
                                <input type="date" class = "form-control" name = "ckeckout" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Dia da Semana:</strong></label>
                                <select class="form-control" name="dia_semana"required = required>
                                    <option value="" disabled selected>Escolha o dia da semana</option>
                                    <option value="Monday">Segunda-feira</option>
                                    <option value="Tuesday">Terça-feira</option>
                                    <option value="Wednesday">Quarta-feira</option>
                                    <option value="Thursday">Quinta-feira</option>
                                    <option value="Friday">Sexta-feira</option>
                                    <option value="Saturday">Sábado</option>
                                    <option value="Sunday">Domingo</option>
                                    <option value="AllDays"> - Todos os dias - </option>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Hora de Início:</strong></label>
                                <input type="time" class = "form-control" name = "ckeckin_time" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Hora Fim:</strong></label>
                                <input type="time" class = "form-control" name = "ckeckout_time" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "locacao_periodo" onclick="success()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'locacao_periodo.php'?>

                </div>
            </div>
        </div>
</div>
</div>