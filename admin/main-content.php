
<div class="main-content">
	<?php
		// query for total pendding
		$q_p = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 1 ") or die(mysqli_error());
		$f_p = $q_p->fetch_array();
		// query for total labs
		$q_ci = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 2 ") or die(mysqli_error());
		$f_ci = $q_ci->fetch_array();
		// query for total users
		$q_u = $conn->query("SELECT COUNT(u.users_id) as total FROM `users` as u ") or die(mysqli_error());
		$f_u = $q_u->fetch_array();
		// query for total location
		$q_lc = $conn->query("SELECT COUNT(lc.locacao_id) as total FROM `locacao` as lc ") or die(mysqli_error());
		$f_lc = $q_lc->fetch_array();
	?>
	<div class="row">

	<div class="col-lg-3 col-md-6 col-sm-6">
		<a href="reservlab.php?<?php echo $edituser?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-warning">
						<span class="material-icons">group</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Usuários</strong></p>
					<h3 class="card-title"><?php echo $f_u['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-info">info</i>
						Total de usuários cadastrados
					</div>
				</div>
			</a></div>
		</div>
		
		<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $penlab?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-rose">
						<span class="material-icons">pending_actions</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Pendente</strong></p>
					<h3 class="card-title"><?php echo $f_p['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-status">rotate_right</i>
						Aguardando aprovação...
					</div>
				</div>
			</a></div>
		</div>

		<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $reslab?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-success">
						<span class="material-icons">lock_clock</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Reservado</strong></p>
					<h3 class="card-title"><?php echo $f_ci['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-reserve">date_range</i>
						Total de reservas
					</div>
				</div>
			</a></div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $finlab?>"><div class="card card-stats">
			<div class="card-header">
					<div class="icon icon-info">
						<span class="material-icons">real_estate_agent</span>
					</div>
			</div>
			<div class="card-content">
				<p class="category"><strong>Locações</strong></p>
				<h3 class="card-title"><?php echo $f_lc['total']?></h3>
			</div>
				<div class="card-footer">
					<div class="stats">
					<i class="material-icons text-location">update</i>
						Total de Locações
					</div>
				</div>
			</div>
			</a></div>
		</div>
	
	<!---row-second----->

	<div class="row">
		<div class="col-lg-9 col-md-9">
			<div class="card" style="min-height:485px;">
				<div class="card-header card-header-text">
					<h4 class="card-title">Usuários Cadastrados</h4>
					<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
				</div>
				<div class="card-content table-responsive">
					<table class="table table-hover">

						<thead class="text-primary">
							<tr>
								<th>Nome</th>
								<th>Função</th>
								<th>E-mail</th>
								<th>Telefone</th>
							</tr>
						</thead>

						<tbody>

						<?php  
							$perPage = 6; // Número de resultados por página
							$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual (por padrão, é a página 1)
							$offset = ($page - 1) * $perPage; // Offset para a consulta SQL
							$totalResults = $conn->query("SELECT COUNT(*) as total FROM users WHERE funcao != 'Administrador'")->fetch_assoc()['total']; // Total de resultados no banco de dados
							$totalPages = ceil($totalResults / $perPage); // Total de páginas necessárias
							$current_page = min($page, $totalPages); // Página atual não pode ser maior que o total de páginas
							$queryad = $conn->query("SELECT users_id, 
															firstname,
															lastname,
															funcao,
															username,
															email,
															contactno
															FROM `users` 
															WHERE funcao != 'Administrador'
															LIMIT $perPage OFFSET $offset") or die(mysqli_error());
							while($fetch = $queryad->fetch_array()){
						?>
							<tr>
								<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
								<td><?php echo $fetch['funcao']?></td>
								<td><?php echo $fetch['email']?></td>
								<?php $contactno = $fetch['contactno'];
								$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
								<td><?php echo $formatted_contactno?></td>
							</tr>
							<?php
								}
							?>
						
						</tbody>
						
					</table>
				</div>
				<!-- Paginação -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="reservlab.php?page=<?php echo ($page - 1); ?>">Anterior</a>
                            </li>
                        <?php } ?>
                        <?php if (mysqli_num_rows($queryad) == $perPage && $totalPages > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="reservlab.php?page=<?php echo ($page + 1); ?>">Next</a>
                            </li>
                        <?php } ?>
						<?php
							if ($totalPages > 1) {
								echo "<p style=\"margin-left:10px\" class=\"text-primary\"> Página $current_page de $totalPages</p>";
							} else {
								echo "<p style=\"margin-left:10px\" class=\"text-primary\"> Página 1</p>";
							}
						?>
                        </li>
                    </ul>
                   
                </nav>
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
						while($f_act = $q_act->fetch_array()){
							${'assunto'.$i} = $f_act['assunto'];
							${'tempo'.$i} = $f_act['tempo'];
						
						switch ($i) {
								case 1:
								  echo '<div class="sl-item">';
								  break;
								case 2:
								  echo '<div class="sl-item">';
								  break;
								case 3:
								  echo '<div class="sl-item sl-primary">';
								  break;
								case 4:
								  echo '<div class="sl-item sl-success">';
								  break;
								case 5:
								  echo '<div class="sl-item sl-warning">';
								  break;
								case 6:
								  echo '<div class="sl-item sl-danger">';
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
			 
			 