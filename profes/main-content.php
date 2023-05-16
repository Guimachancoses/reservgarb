<div class="main-content">
	<?php
		// query for total locacao pendente do usuário
		$q_so = $conn->query("SELECT COUNT(locacao_id) as total FROM `locacao` WHERE `users_id` = '$_SESSION[users_id]' && `status_id` = 1") or die(mysqli_error());
		$f_pd = $q_so->fetch_array();
		// query for total locações reservadas aprovadas
		$q_ci = $conn->query("SELECT COUNT(locacao_id) as total FROM `locacao` WHERE `users_id` = '$_SESSION[users_id]' &&  `status_id` = 2 ") or die(mysqli_error());
		$f_ci = $q_ci->fetch_array();


	?>
	<div class="row">

	<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $penlab?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-rose">
						<span class="material-icons" style="color:#4caf50">lock_open</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Pendente</strong></p>
					<h3 class="card-title"><?php echo $f_pd['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-status" style="color:#4caf50">rotate_right</i>
						Aguardando aprovação...
					</div>
				</div>
			</a></div>
		</div>
		
		<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $reslab?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-success">
						<span class="material-icons" style="color:red" >lock_clock</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Reservado</strong></p>
					<h3 class="card-title"><?php echo $f_ci['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-reserve" style="color:red" >date_range</i>
						Total de reservas
					</div>
				</div>
			</a></div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card card-stats">
			<div class="card-header">
					<div class="icon icon-info">
						<span class="material-icons">fingerprint</span>
					</div>
			</div>
			<div class="card-content">
				<p class="category">Coordenador Acadêmico</p>
				<h3 class="card-title"><?php echo $name?></h3>
			</div>
				<div class="card-footer">
					<div class="stats">
					<i class="material-icons text-location">verified_user</i>
						Usuário logado
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!---row-second----->

	<div class="row">
		<div class="col-lg-9 col-md-9">
			<div class="card" style="min-height:485px;">
				<div class="card-header card-header-text">
					<h4 class="card-title">Disciplinas Castradas</h4>
					<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
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
							</tr>
						</thead>

						<tbody>

						<?php
								$queryad = $conn->query("SELECT
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
								
		    <div class="col-lg-3 col-md-12">
		        <div class="card" style="min-height:485">
			        <div class="card-header card-header-text">
                  		<h4 class="card-title">Atividade</h4>
                    </div>
					<div class="card-content">
			       		<div class="steamline">
					<?php
						$q_act = $conn->query("SELECT 
													ms.assunto, 
													DATE_FORMAT(ac.timestamp, '%Y-%m-%d %H:%i:%s') AS 'timestamp',
													CASE 
														WHEN TIMESTAMPDIFF(MINUTE, ac.timestamp, NOW()) < 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, ac.timestamp, NOW()), ' minutos atrás')
														WHEN TIMESTAMPDIFF(HOUR, ac.timestamp, NOW()) < 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, ac.timestamp, NOW()), ' horas atrás')
														ELSE CONCAT(FLOOR(TIMESTAMPDIFF(SECOND, ac.timestamp, NOW()) / 86400), ' dias atrás')
													END AS 'tempo'
												FROM activities as ac 
												INNER JOIN mensagens as ms 
												ON ac.mensagens_id = ms.mensagens_id
												WHERE ac.users_id = '$_SESSION[users_id]'
												ORDER BY 2 DESC 
												LIMIT 6;") or die(mysqli_error());						
						$i = 1;
						if (mysqli_num_rows($q_act) == 0) {
							echo '<div class="sl-item">';
								echo'<div class="sl-content">';
								echo'<small class="text-muted"></small>';
								echo'<p>Sem atividades</p>';
							echo'</div>';
						echo'</div>';
						}
						while($f_act = $q_act->fetch_array()){
							${'assunto'.$i} = $f_act['assunto'];
							${'tempo'.$i} = $f_act['tempo'];
						
						switch ($i) {
								case 1:
								  echo '<div class="sl-item sl-primary">';
								  break;
								case 2:
								  echo '<div class="sl-item sl-danger">';
								  break;
								case 3:
								  echo '<div class="sl-item sl-success">';
								  break;
								case 4:
								  echo '<div class="sl-item sl-info">';
								  break;
								case 5:
								  echo '<div class="sl-item sl-warning">';
								  break;
								case 6:
								  echo '<div class="sl-item">';
								  break;	  
							  }
						?>
					      		<div class="sl-content">
						    		<small class="text-muted"><?php echo ${'tempo'.$i}?></small>
									<p><?php echo ${'assunto'.$i}?></p>
					      		</div>
				        	</div>
						<?php
						$i++;	
						}	
						?>

				   		</div>
			  		</div>
		        </div> 
		    </div>
  </div>
			 
			 