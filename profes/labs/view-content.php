<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-15 col-md-20">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Softwares Disponíveis</strong></h4>
					
					<?php
						$querylb = $conn->query("SELECT room_id,room_type,room_no FROM `laboratorios` WHERE room_id = '$_REQUEST[room_id]'") or die(mysqli_error());
						while($fetchlb = $querylb->fetch_array()){
							$room_id = $fetchlb['room_id'];
                        ?>
						 	<p class="category">Laboratório: <?php echo $fetchlb['room_type']." Nº: ".$fetchlb['room_no']?></p>
						<?php
							}
						?>
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover">

							<thead class="text-primary">
							<tr>
								<th>Nome</th>
								<th>Editor</th>
								<th>Versão</th>
								<th>Realesed</th>
							</tr>
						</thead>

						<tbody>

						<?php  
								$queryad = $conn->query("SELECT
															sf.software_id,
															sf.name,
															sf.editor,
															sf.version,
															sf.realesed
														FROM so_disponivel as sd
														INNER JOIN softwares as sf
														ON sd.software_id = sf.software_id
														WHERE room_id = $room_id") or die(mysqli_error());
								if (mysqli_num_rows($queryad) == 0) {
									echo "<td>Sem requisitos adicionados</td>";
								}
								while($fetch = $queryad->fetch_array()){
							?>
							<tr>
								<td><?php echo $fetch['name']?></td>
								<td><?php echo $fetch['editor']?></td>
								<td><?php echo $fetch['version']?></td>
								<td><?php echo date('d-m-Y', strtotime($fetch['realesed']))?></td>
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
			 
			 