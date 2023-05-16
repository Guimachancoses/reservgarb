<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-6">
				<div class="card" style="min-height:585px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Cadastrar Softwares Disponíveis</strong></h4>
						<p class="category">Escolha qual laboratório você deseja atualizar os recursos:</p>
					</div>
					<div class="card-content table-responsive"> 
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Tipo de Laboratório</th>
                                <th>Nº</th>
								<th>Recursos</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = $conn->query("SELECT 
                                                    lb.room_id,
                                                    lb.room_type,
                                                    lb.room_no,
                                                    COALESCE(COUNT(sd.sod_id), 0) AS num_softwares
                                                FROM laboratorios AS lb
                                                LEFT JOIN so_disponivel AS sd
                                                ON lb.room_id = sd.room_id
                                                GROUP BY lb.room_id") or die(mysqli_error());
                            while($fetch = $query->fetch_array()){
                        ?>	
                            <tr>
                                <td><?php echo $fetch['room_type']?></td>
                                <td><?php echo $fetch['room_no']?></td>
								<td class="text-center"><?php echo $fetch['num_softwares']?></td>
                                <td class="text-center"><center><a style="padding:0px;position:absolute" class = "btn btn-info d-flex justify-content-center" href = "reservlab.php?room_id=<?php echo $fetch['room_id']."edit-avail"?>"><abbr title="Adicionar"><i class = "material-icons">add</i></abbr></a></center></td>
                            </tr>
                        <?php
                            }
                        ?>	
                        </tbody>
                    </table>
                </div>
				</div>
			<div>
		</div>
		     
</div>
		   
		    
  </div>
			 
			 