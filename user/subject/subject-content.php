<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-6 col-md-9">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Editar Disciplina</strong></h4>
						<p class="category">Escolha qual disciplina você deseja editar ou excluir:</p>
					</div>
					<div class="card-content table-responsive">
					<table class="table table-hover">

						<thead class="text-primary">
							<tr>
								<th>Nome</th>
								<th>Curso</th>
								<th>Semestre</th>
								<th>Alunos</th>
								<th>Ano</th>
								<th>Ação</th>
							</tr>
						</thead>

						<tbody>

						<?php
								$queryad = $conn->query("SELECT
															dc.disciplina_id,
															dc.nm_disciplina,
															dc.qtd_users,
															dc.date,
															cr.curso,
															st.semestre    
														FROM disciplinas as dc
														INNER JOIN cursos as cr
														ON cr.curso_id = dc.curso_id
														INNER JOIN semestre as st
														ON st.semester_id = dc.semester_id
														WHERE dc.users_id = '$_SESSION[users_id]'") or die(mysqli_error());
								if (mysqli_num_rows($queryad) == 0) {
									echo "<td>Sem disciplinas cadastradas</td>";
								}
								while($fetch = $queryad->fetch_array()){
							?>
							<tr>
								<td><?php echo $fetch['nm_disciplina']?></td>
								<td><?php echo $fetch['curso']?></td>
								<td><?php echo $fetch['semestre']?></td>
								<td><?php echo $fetch['qtd_users']?></td>
								<td><?php echo date('Y', strtotime($fetch['date']))?></td>
								<td><center><a class = "btn btn-warning" href = "reservlab.php?disciplina_id=<?php echo $fetch['disciplina_id']."edit-subject"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_subject.php?disciplina_id=<?php echo $fetch['disciplina_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
			 
			 