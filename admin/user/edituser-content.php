<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-20">
				<div class="card" style="min-height:755px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Editar Usuários</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover">

							<thead class="text-primary">
								<tr>
									<th>Nome</th>
									<th>Função</th>
									<th>RA</th>
									<th>E-mail</th>
									<th>Telefone</th>
									<th>Ação</th>
								</tr>
							</thead>

							<tbody>

							<?php  
									$queryad = $conn->query("SELECT users_id, firstname, lastname, funcao, username, email, contactno FROM `users` WHERE funcao != 'Administrador'") or die(mysqli_error());
									while($fetch = $queryad->fetch_array()){
								?>
								<tr>
									<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
									<td><?php echo $fetch['funcao']?></td>
									<td><?php echo substr($fetch['username'], 0, 4) . "/" . substr($fetch['username'], 4, 2) . "-" . substr($fetch['username'], 6, 1); ?></td>
									<td><?php echo $fetch['email']?></td>
									<?php $contactno = $fetch['contactno'];
									$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
									<td><?php echo $formatted_contactno?></td>
									<td><center><a class = "btn btn-warning" href = "reservlab.php?users_id=<?php echo $fetch['users_id']."edit-account"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_account.php?users_id=<?php echo $fetch['users_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
		   
		    

			 
			 