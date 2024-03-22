<?php require_once 'validate.php';?>
<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-8 col-md-10">
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
						<h4 class="card-title"><strong class="text-primary"> Adicionar ou Remover - Usuários Aprovadores</strong></h4>
					
					<?php
						$querylb = $conn->query("SELECT * FROM `approver` WHERE approver_id = '$_REQUEST[approver_id]'") or die(mysqli_error($conn));
						while($fetchlb = $querylb->fetch_array()){
							$approver_id = $fetchlb['approver_id'];
                        ?>
						 	<p class="category"><strong>Grupo Aprovador: </strong><?php echo $fetchlb['approvers']?></p>
						<?php
							}
						?>
						</br>
						<label class="text-primary" for="name">Escolha o usuário que deseja adicionar:</label>
					</div>
					<div class="card-header card-header-text">
						<form method="GET" action="add_approver_query.php">
							<select class="select-soft" name="users_id" required>
								<option value="" disabled selected>- Clique aqui -</option>
								<?php  
									$querysf = $conn->query("SELECT
																users_id,
																firstname,
																lastname
															FROM
																`users` AS u
															WHERE
																u.funcao IN ('Administrador','Aprovador','Coordenador')
															ORDER BY 
																2") or die(mysqli_error($conn));
									while($fetchsf = $querysf->fetch_array()){
									$users_id = $fetchsf['users_id'];
								?>	
								<option value="<?php echo $users_id?>"><?php echo $fetchsf['firstname']." ".$fetchsf['lastname']?></option>';
								<?php
								} 
								?>
							</select>
							<input type="hidden" name="approver_id" value="<?php echo $approver_id?>">
							<button type="submit" style="weight:20px;color:white;margin-left:5px;margin-top:10px;" name = "add_approver" class = "btn btn-info"><i class = "glyphicon glyphicon-save"></i> Adicionar</button>
							<div id="mensagem"></div>	
						</form>
					</div>

					<script>
						// Verifica se a URL contém o parâmetro "mensagem"
						const urlParams = new URLSearchParams(window.location.search);
						const mensagem = urlParams.get('mensagem');

						if (mensagem) {
							// Adiciona a mensagem na div com ID "mensagem"
							document.getElementById("mensagem").innerHTML = `<label style="color:red;">${mensagem}</label>`;
						}
					</script>
					</br>
					<div class="card-content table-responsive">
						<table class="table table-hover">

							<thead class="text-primary">
							<tr>
								<th>Nome</th>
								<th class="text-center">Remover</th>
							</tr>
						</thead>

						<tbody>

						<?php  
								$queryad = $conn->query("SELECT
															u.users_id,
															u.firstname,
															u.lastname
														FROM gp_approver as gp
														INNER JOIN users as u
														ON u.users_id = gp.users_id
														WHERE gp.approver_id = $approver_id") or die(mysqli_error($conn));
								while($fetch = $queryad->fetch_array()){
							?>
							<tr>
								<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
								<td><center><a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_approver.php?users_id=<?php echo $fetch['users_id']."&approver_id=".$approver_id?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
			 
			 