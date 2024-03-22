
<div class="main-content">
	<?php
		require_once 'validate.php';
		// query for total labs
		$session = $_SESSION['users_id'];
		// query for total pendding
		$q_p = $conn->query("SELECT SUM(total) AS total FROM (
															SELECT COUNT(*) AS total FROM lc_period WHERE mensagens_id = 37
															UNION ALL
															SELECT COUNT(*) AS total FROM locacao WHERE status_id = 1 AND lc_period_id IS NULL
														) AS subquery;") or die(mysqli_error($conn));
		$f_p = $q_p->fetch_array();

		// query for total pendding
		$q_p2 = $conn->query("SET @groupId = (
			SELECT approver_id
			FROM gp_approver
			WHERE users_id = $session
		)");
		// query for total location
		$q_ci = $conn->query("SELECT 
						SUM(total) AS total 
					FROM (
					SELECT
					COUNT(*) AS total
					FROM `lc_period` as lc
					LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
					INNER JOIN `users` as u ON u.users_id = lc.users_id
					LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
					LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
					INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
					WHERE ms.mensagens_id = 3 AND lc.users_id != $session
						AND (
							(@groupId = 1) -- Administrador
							OR
							(@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
							OR
							(@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
							OR
							(@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
						)
			UNION ALL
					SELECT
					COUNT(*) AS total
					FROM `locacao` as lc
					LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
					INNER JOIN `users` as u ON u.users_id = lc.users_id
					LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
					LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
					INNER JOIN `status` st ON st.status_id = lc.status_id
					INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
					WHERE
						lc.lc_period_id IS NULL
						AND lc.status_id IN (2,8) 
						AND lc.users_id != $session
						AND (
							(@groupId = 1) -- Administrador
							OR
							(@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
							OR
							(@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
							OR
							(@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
						)
		) AS subquery;") or die(mysqli_error($conn));
		$f_ci = $q_ci->fetch_array();

		// query for total users
		$q_u = $conn->query("SELECT COUNT(u.users_id) as total FROM `users` as u ") or die(mysqli_error($conn));
		$f_u = $q_u->fetch_array();

		// query for total location
		$q_lc = $conn->query("SELECT COUNT(lc.locacao_id) as total FROM `locacao` as lc WHERE status_id = 4") or die(mysqli_error($conn));
		$f_lc = $q_lc->fetch_array();
	?>
	<div class="row">

		<div class="div-swing col-lg-6 col-md-6 col-sm-6">
			<a href = "reservlab.php?alter-account">
				<div class="card card-stats" style="box-shadow: 10px 10px 10px #5faa4f;">
					<div class="card-header">
						<div class="icon icon-info icon-animation">
							<span class="material-icons">fingerprint</span>
						</div>
					</div>
					<div class="card-content">
						<p class="category-animation">Administrador</p>
						<h3 class="name-animation"><?php echo $name?></h3>
					</div>
					<div class="card-footer">
						<div class="stats">
						<i class="material-icons text-location">verified_user</i>
							Usuário logado
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="div-link col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $edituser?>">
				<div class="card card-stats">
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
				</div>
			</a>
		</div>

		<div class="div-link col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $penlab?>"><div class="card card-stats" >
				<div class="card-header">
					<div class="icon icon-rose">
						<span class="material-icons">pending_actions</span>
					</div>
				</div>
				<div class="card-content">
					<p class="category"><strong>Locações Pendente</strong></p>
					<h3 class="card-title"><?php echo $f_p['total']?></h3>
				</div>
				<div class="card-footer">
					<div class="stats">
						<i class="material-icons text-status">rotate_right</i>
						Aguardando aprovação
					</div>
				</div>
			</a></div>
		</div>

		<div class="div-swing col-lg-6 col-md-6 col-sm-6" onclick="redirectToCalendar()">
			<div class="card card-stats" style="padding-bottom:5%;position:relative;box-shadow: 10px 10px 10px #5faa4f;cursor:pointer">
				<div class="card-header">
					<div class="icon icon-info" style="position: absolute;top: 0;right: 80%;width: 100%;height: 100%;padding-left:90px">
						<div class="gif-container">
							<iframe src="https://giphy.com/embed/xTiQywlOn0gKyz0l56" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
						</div>
					</div>
				</div>
				<div class="card-content">
					<p class="category">Agendar Locação</p>
					<h3 class="card-title">Calendário</h3>
				</div>
			</div>
		</div>

		<script>
		function redirectToCalendar() {
		window.location.href = "reservlab.php?calender";
		}
		</script>

		<div class="div-link col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $reslab?>">
				<div class="card card-stats">
					<div class="card-header">
						<div class="icon icon-success">
							<span class="material-icons">lock_clock</span>
						</div>
					</div>
					<div class="card-content">
						<p class="category"><strong>Reservados</strong></p>
						<h3 class="card-title"><?php echo $f_ci['total']?></h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons text-reserve">date_range</i>
							Total de reservas
						</div>
					</div>
				</div>
			</a>
		</div>
			
		<div class="div-link col-lg-3 col-md-6 col-sm-6">
			<a href="reservlab.php?<?php echo $finlab?>">
				<div class="card card-stats">
					<div class="card-header">
						<div class="icon icon-info">
							<span class="material-icons">real_estate_agent</span>
						</div>
					</div>
					<div class="card-content">
						<p class="category"><strong>Histórico de Locações</strong></p>
						<h3 class="card-title"><?php echo $f_lc['total']?></h3>
					</div>
					<div class="card-footer">
						<div class="stats">
						<i class="material-icons text-location">update</i>
							Total de locações
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>								
		
	
	<!---row-second----->

	<div class="row">
		<div class="col-lg-9 col-md-9">
			<div class="card" style="min-height:535px;">
				<div class="card-header card-header-text">
					<h4 class="card-title">Usuários Cadastrados</h4>
					<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
				</div>
				<div class="card-content table-responsive" style="max-height:485px">
					<div class="search-container">
						<input for="search-input" type="text" class="select-box" id="search-input" placeholder="Pesquisar..."/>
						<i class="material-icons" id="search-icon">search</i>
					</div>

					<script>
						// Função para filtrar os resultados da tabela com base no valor de busca
						function searchTable() {
							var input, filter, table, tr, td, i, txtValue;
							input = document.getElementById("search-input");
							filter = input.value.toUpperCase();
							table = document.getElementById("myTable");
							tr = table.getElementsByTagName("tr");

							// Iterar sobre todas as linhas da tabela e ocultar aquelas que não correspondem ao critério de busca
							for (i = 0; i < tr.length; i++) {
							td = tr[i].getElementsByTagName("td");
							for (var j = 0; j < td.length; j++) {
								if (td[j]) {
								txtValue = td[j].textContent || td[j].innerText;
								if (txtValue.toUpperCase().indexOf(filter) > -1) {
									tr[i].style.display = "";
									break; // Exibir a linha e passar para a próxima linha
								} else {
									tr[i].style.display = "none"; // Ocultar a linha se não corresponder ao critério de busca
								}
								}
							}
							}
						}

						// Adicionar um ouvinte de eventos ao campo de busca para chamar a função searchTable() sempre que o valor mudar
						document.getElementById("search-input").addEventListener("input", searchTable);

						const searchInput = document.getElementById("search-input");
						const searchIcon = document.getElementById("search-icon");

						searchInput.addEventListener("focus", function () {
						searchIcon.classList.add("active");
						});

						searchInput.addEventListener("blur", function () {
						searchIcon.classList.remove("active");
						});

					</script>


					<table class="table table-hover" id="myTable" style="cursor:pointer">

						<thead class="" style="cursor:pointer;color:#5faa4f">
							<tr>
								<th></th>
								<th><strong>Nome</strong></th>
								<th><strong>Função</strong></th>
								<th><strong>E-mail</strong></th>
								<th><strong>Telefone</strong></th>
							</tr>
						</thead>

						<?php  
							
							
							$queryad = $conn->query("SELECT users_id, 
															firstname,
															lastname,
															funcao,
															email,
															contactno,
															status
															FROM `users` 
															WHERE users_id != '$_SESSION[users_id]' AND status != '6'
															ORDER BY firstname
															") or die(mysqli_error($conn));
							if (mysqli_num_rows($queryad) == 0) {
								echo "<td>Sem usuários cadastrados</td>";
							}
							while($fetch = $queryad->fetch_array()){
							$editLink = "reservlab.php?users_id=".$fetch['users_id']."edit-account";		
						?>
						<tbody>

							<tr onclick="window.location='<?php echo $editLink ?>'">
								<td><?php if ($fetch['status'] == "5") { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-success";';} else if ($fetch['status'] == "7") { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-warning";';} else { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-danger";';}?></div></td>
								<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
								<td><?php echo $fetch['funcao']?></td>
								<td><?php echo $fetch['email']?></td>
								<td><?php $contactno = $fetch['contactno'];	$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?><?php echo $formatted_contactno?></td>
							</tr> 
							<?php
								}
							?>
						
						</tbody>
						
					</table>
			

					<script>
						$(document).ready(function() {
						// Função para ordenar a tabela
						function sortTable(columnIndex) {
							var table, rows, switching, i, x, y, shouldSwitch;
							table = document.getElementById("myTable");
							switching = true;
							while (switching) {
							switching = false;
							rows = table.getElementsByTagName("tr");
							for (i = 1; i < (rows.length - 1); i++) {
								shouldSwitch = false;
								x = rows[i].getElementsByTagName("td")[columnIndex];
								y = rows[i + 1].getElementsByTagName("td")[columnIndex];
								if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
								shouldSwitch = true;
								break;
								}
							}
							if (shouldSwitch) {
								rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
								switching = true;
							}
							}
						}
						
						// Evento de clique no cabeçalho da tabela
						$("th").click(function() {
							var columnIndex = $(this).index();
							sortTable(columnIndex);
						});
						});
					</script>

					
				</div>
			</div>
		<div>
	</div>		     
</div>
								
		    <div class="col-lg-3 col-md-12">
		        <div class="card" style="min-height:485px">
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
												LIMIT 6;") or die(mysqli_error($conn));						
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
			 
			 