<div class="main-content">  
    <div class="row">
			<div class="col-lg-6">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar Laboratório</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <br />
                    <?php
						$query = $conn->query("SELECT * FROM `laboratorios` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
						$fetch = $query->fetch_array();
					?>
                    <div class = "col-md-10"style="min-height:425px">	
                        <form method = "POST" enctype = "multipart/form-data">
                            <div class="card-footer">
                                <label><strong> Tipo de Laboratório:</strong></label>
                                <select class = "form-control" required = required name = "room_type">
                                    <option value = "">Escolha uma opção</option>
                                    <option value = "Informática" <?php if($fetch['room_type'] == "Informática"){echo "selected";}?>>Informática</option>
                                    <option value = "Fisioterápia" <?php if($fetch['room_type'] == "Fisioterápia"){echo "selected";}?>>Fisioterápia</option>
                                    <option value = "Elétrica" <?php if($fetch['room_type'] == "Elétrica"){echo "selected";}?>>Elétrica</option>
                                    <option value = "Nutrição" <?php if($fetch['room_type'] == "Nutrição"){echo "selected";}?>>Nutrição</option>
                                    <option value = "Estética" <?php if($fetch['room_type'] == "Estética"){echo "selected";}?>>Estética</option>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Capacidade:</strong></label>
                                <input type = "text" value = "<?php echo $fetch['capacity']?>" class = "form-control" name = "capacity" />
                            </div>
                            <div class="card-footer">
                                <label><strong> Número do Laboratório:</strong></label>
                                <input type = "text" required = "required" value = "<?php echo $fetch['room_no']?>" class = "form-control"  id = "room_no" name = "room_no"/>
                            </div>
                            <br/>
                            <div class="card-footer">
                                <button name = "edit_room" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                        <?php require_once 'edit_query_room.php'?>
                    </div>
                </div>
            </div>
        </div>
<div>
<div>