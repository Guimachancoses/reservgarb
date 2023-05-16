<div class="main-content">
	<?php
		// query for total softwares
		$q_so = $conn->query("SELECT COUNT(software_id) as total FROM `softwares`") or die(mysqli_error());
		$f_so = $q_so->fetch_array();
		// query for total labs
		$q_ci = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 2 ") or die(mysqli_error());
		$f_ci = $q_ci->fetch_array();


	?>
	<div class="row">

		<div class="col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $editsoft?>"><div class="card card-stats">
				<div class="card-header">
					<div class="icon icon-warning">
						<span class="material-icons">widgets</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Softwares</strong></p>
					<h3 class="card-title"><?php echo $f_so['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-info">info</i>
						Total de softwares cadastrados
					</div>
				</div>
			</div></a>
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
						Solicitações aguandando ...
					</div>
				</div>
			</div></a>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="card card-stats">
			<div class="card-header">
					<div class="icon icon-info">
						<span class="material-icons">fingerprint</span>
					</div>
			</div>
			<div class="card-content">
				<p class="category">Resp. Laborátorio</p>
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
					<h4 class="card-title">Softwares Cadastrados</h4>
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
								$queryad = $conn->query("SELECT software_id, name, editor, version, realesed FROM `softwares`") or die(mysqli_error());
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
												WHERE ac.mensagens_id NOT IN (1,2,5,6,9)  
												ORDER BY 2 DESC 
												LIMIT 6;") or die(mysqli_error());						
						$i = 1;
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
			 
			 