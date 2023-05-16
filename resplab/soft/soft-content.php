<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-15 col-md-20">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Editar Softwares</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
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
								$queryad = $conn->query("SELECT software_id, software_id, name, editor, version, realesed FROM `softwares`") or die(mysqli_error());
								while($fetch = $queryad->fetch_array()){
							?>
							<tr>
								<td><?php echo $fetch['name']?></td>
								<td><?php echo $fetch['editor']?></td>
								<td><?php echo $fetch['version']?></td>
								<td><?php echo date('d-m-Y', strtotime($fetch['realesed']))?></td>
									<td><center><a class = "btn btn-warning" href = "reservlab.php?software_id=<?php echo $fetch['software_id']."edit-software"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_software.php?software_id=<?php echo $fetch['software_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
			 
			 