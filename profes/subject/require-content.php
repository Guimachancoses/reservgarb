<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-18 col-md-11">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar/Remover - Requisitos Disciplina</strong></h4>
					
					<?php
						$querylb = $conn->query("SELECT disciplina_id, nm_disciplina FROM `disciplinas` WHERE disciplina_id = '$_REQUEST[disciplina_id]'") or die(mysqli_error());
						while($fetchlb = $querylb->fetch_array()){
							$disciplina_id = $fetchlb['disciplina_id'];
                        ?>
						 	<p class="category">Disciplina:<strong> <?php echo $fetchlb['nm_disciplina']?></strong>.</p>
						<?php
							}
						?>
						<label class="text-primary" for="name">Escolha o requisito que desejar adicionar:</label>
					</div>
					<div class="card-header card-header-text">
						<form method="GET" action="add_require_query.php">
							<select class="select-soft" name="software_id"required>
								<option value="" disabled selected>- Clique aqui -</option>
								<?php  
									$querysf = $conn->query("SELECT 
																software_id,
																name,
																version
																FROM `softwares`") or die(mysqli_error());
									while($fetchsf = $querysf->fetch_array()){
									$software_id = $fetchsf['software_id'];
								?>	
								<option value="<?php echo $software_id?>"><?php echo $fetchsf['name']." - v.".$fetchsf['version']?></option>';
								<?php
								} 
								?>
							</select>
							<input type="hidden" name="disciplina_id" value="<?php echo $disciplina_id?>">
							<button type="submit" style="weight:20px;color:white;margin-left:5px;margin-top:10px;" name = "add_avaible_query" class = "btn btn-info"><i class = "glyphicon glyphicon-save"></i> Adicionar</button>
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
					<div class="card-content table-responsive">
						<table class="table table-hover">

							<thead class="text-primary">
							<tr>
								<th>Nome</th>
								<th>Editor</th>
								<th>Versão</th>
								<th>Realesed</th>
								<th>Remover</th>
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
														FROM req_software as rq
														INNER JOIN softwares as sf
														ON rq.software_id = sf.software_id
														WHERE disciplina_id = $disciplina_id") or die(mysqli_error());
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
								<td><center><a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_require_query.php?software_id=<?php echo $fetch['software_id']."&disciplina_id=".$disciplina_id?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
			 
			 