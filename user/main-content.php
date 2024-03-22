<?php require_once 'validate.php';?>
<div class="main-content" >
	<?php
		$session = $_SESSION['users_id'];
		// query for total pendding
		$q_p2 = $conn->query("SET @groupId = (
			SELECT approver_id
			FROM gp_approver
			WHERE users_id = $session_id
		)");
	
		$q_p = $conn->query("SELECT SUM(total) AS total FROM (
				SELECT
				COUNT(*) AS total
				FROM `lc_period` as lc
				LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
				INNER JOIN `users` as u ON u.users_id = lc.users_id
				LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
				LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
				INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
				WHERE ms.mensagens_id = 37
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
					lc.status_id = 1
					AND lc.users_id != $session_id
					AND ms.mensagens_id = 2
					AND lc.lc_period_id IS NULL
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
		$f_p = $q_p->fetch_array();

		// query for total location
		$q_ci = $conn->query("SELECT SUM(total) AS total FROM (
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
								  lc.lc_period_id IS NOT NULL
								AND lc.status_id = 2 
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

		// total for total pendding location per period
		$q_perday = $conn->query("SELECT
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
									AND lc.status_id = 1 
									AND lc.users_id = $session") or die(mysqli_error($conn));
		$f_perday = $q_perday->fetch_array();
		
		// total for total pendding location per period
		$q_perper = $conn->query("SELECT
							COUNT(*) AS total
							FROM `lc_period` as lc
							LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
							INNER JOIN `users` as u ON u.users_id = lc.users_id
							LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
							LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
							INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
							WHERE ms.mensagens_id = 37 AND lc.users_id != $session
								AND (
									(@groupId = 1) -- Administrador
									OR
									(@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
									OR
									(@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
									OR
									(@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
								)") or die(mysqli_error($conn));
		$f_perper = $q_perper->fetch_array();

		// query for total pendding my location
		$q_u = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `users_id` = $session && status_id = 1 ") or die(mysqli_error($conn));
		$f_u = $q_u->fetch_array();
		
		// query for total my location
		$q_lc = $conn->query("SELECT count(*) as total FROM `locacao` WHERE users_id = $session and status_id = 2 and lc_period_id IS NULL") or die(mysqli_error($conn));
		$f_lc = $q_lc->fetch_array();
	?>
	
	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6">
			<a href = "reservlab.php?alter-account">
				<div class="div-swing card card-stats" style="box-shadow: 10px 10px 10px #5faa4f;">
					<div class="card-header">
						<div class="icon icon-info icon-animation">
							<span class="material-icons">fingerprint</span>
						</div>
					</div>
					<div class="card-content">
						<p class="category-animation">Usuário</p>
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

		<div class="col-lg-6 col-md-6 col-sm-6" id="calendarCard">
			<div class="div-swing card card-stats" style="padding-bottom:5%;positon:relative;box-shadow: 10px 10px 10px #5faa4f;">
				<div class="card-header">
					<div class="icon icon-info">
						<div class="gif-container" style="position: absolute;top: 0;right: 80%;width: 100%;height: 100%;padding-left:90px">
							<iframe src="https://giphy.com/embed/xTiQywlOn0gKyz0l56" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen ></iframe>
						</div>
					</div>
				</div>
				<div class="card-content">
					<p class="category">Agendar Locação</p>
					<h3 class="card-title">Calendário</h3>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6" id="reservPen">
			<div class="div-swing card card-stats" style="padding-bottom:5%;positon:relative;box-shadow: 10px 10px 10px #5faa4f;">
				<div class="card-header">
					<div class="icon icon-info">
						<div class="gif-container" style="position: absolute;top: 0;right: 80%;width: 100%;height: 100%;margin-left:90px">
							<iframe src="https://giphy.com/embed/wq1I3ILdsvYJub8Rwx" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen ></iframe>
						</div>
					</div>
				</div>
				<div class="card-content">
					<p class="category">Reservas Pendentes</p>
					<h3 class="card-title"><?php echo $f_perday['total']?></h3>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6" id="reservAp">
			<div class="div-swing card card-stats" style="padding-bottom:5%;positon:relative;box-shadow: 10px 10px 10px #5faa4f;">
				<div class="card-header">
					<div class="icon icon-info" >
						<div class="gif-container" style="position: absolute;top: 0;right: 80%;width: 100%;height: 100%;margin-left:90px">
							<iframe src="https://giphy.com/embed/X3Rns1xcaxigefgM6S" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen ></iframe>
						</div>
					</div>
				</div>
				<div class="card-content">
					<p class="category">Reservas Aprovadas</p>
					<h3 class="card-title"><?php echo $f_lc['total']?></h3>
				</div>
			</div>
		</div>

		
		<script>
			const calendarCard = document.getElementById('calendarCard');
			const reservPen = document.getElementById('reservPen');
			const reservAp = document.getElementById('reservAp');
			const gifContainer = calendarCard.querySelector('.gif-container');

			gifContainer.addEventListener('click', function(event) {
				event.stopPropagation();
			});

			calendarCard.addEventListener('click', function() {
				window.location.href = "reservlab.php?rscalender";
			});
			reservPen.addEventListener('click', function() {
				window.location.href = "reservlab.php?mybookp";
			});
			reservAp.addEventListener('click', function() {
				window.location.href = "reservlab.php?mybookr";
			});
		</script>

	</div>								
		
	
	<!---row-second----->

	<div class="row">
		<div class="col-lg-9 col-md-20">
			<div class="card" style="min-height:535px;">
				<div class="card-header card-header-text">
					<h4 class="card-title">Meus Pedidos de Reservas Aguardando Aprovação</h4>
					<p class="category">Clique sobre uma pedido para visualizá-lo:</p>
				</div>
				<div class="card-content table-responsive">
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

					<table class="table table-hover" id="myTable">

						<thead class="" style="cursor:pointer;color:#5faa4f">
							<tr>
								<th></th>
								<th><strong>Nome</strong></th>
								<th><strong>Locação</strong></th>
								<th><strong>Dt. Reserva</strong></th>
								<th><strong>Hr. Reserva</strong></th>
							</tr>
						</thead>

							<?php  
								
								$perPage = 6; // Número de resultados por página
								$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual (por padrão, é a página 1)
								$offset = ($page - 1) * $perPage; // Offset para a consulta SQL
								$totalResults = $conn->query("SELECT COUNT(*) as total FROM locacao as lc INNER JOIN mensagens as ms WHERE lc.status_id = 1 && ms.mensagens_id = 2 && lc.users_id != '$_SESSION[users_id]' && lc.lc_period_id IS NULL")->fetch_assoc()['total']; // Total de resultados no banco de dados
								$totalPages = ceil($totalResults / $perPage); // Total de páginas necessárias
								$current_page = min($page, $totalPages); // Página atual não pode ser maior que o total de páginas
								
								$querypd2 = $conn->query("SELECT
															lc.locacao_id,
															u.firstname,
															u.lastname,
															COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
															COALESCE(lb.room_no, vs.model) as description,
															lc.checkin,
															lc.checkin_time,
															lc.checkout_time,
															lc.approver_id,
															st.status
														FROM `locacao` as lc
														LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
														INNER JOIN `users` as u ON u.users_id = lc.users_id
														LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
														LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
														INNER JOIN `status` st ON st.status_id = lc.status_id
														INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
														WHERE
															lc.status_id = 1
															AND lc.users_id = '$_SESSION[users_id]' 
															AND ms.mensagens_id = 2
															AND lc.lc_period_id IS NULL
														ORDER BY  lc.checkin ASC
														LIMIT $perPage OFFSET $offset") or die(mysqli_error($conn));
								if (mysqli_num_rows($querypd2) == 0) {
									echo "<td></td>";
									echo "<td>Sem reservas pendentes...</td>";
									echo "<td></td>";
									echo "<td></td>";
									echo "<td></td>";
								}                        
								while ($fetch = $querypd2->fetch_array()) {
									$editLink = "reservlab.php?locacao_id=".$fetch['locacao_id']."mybookp";
							?>
						<tbody>		
								<tr onclick="window.location='<?php echo $editLink ?>'">
									<td><?php if ($fetch['status'] == "5") { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-success";';} else if ($fetch['status'] == "Pendente") { echo '<div class="steamline" style="padding-top:5px"><div class="sl-item sl-warning";';} else { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-danger";';}?></td>
									<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
									<td><?php echo $fetch['locacao']?></td>
									<td><strong><?php if($fetch['checkin'] <= date("Y-m-d", strtotime("+8 HOURS"))){echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}else{echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}?></strong></td>
									<td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkin_time']))."</label>"?></td>
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
				
					<!-- Paginação -->
					<nav>
						<ul class="pagination justify-content-center">
							<?php if ($page > 1) { ?>
								<li class="page-item">
									<a class="n-overlay" href="reservlab.php?page=<?php echo ($page - 1); ?>">Anterior</a>
								</li>
							<?php } ?>
							<?php if (mysqli_num_rows($querypd2) == $perPage && $totalPages > 1) { ?>
								<li class="page-item">
									<a style="margin-left:10px" class="n-overlay" href="reservlab.php?page=<?php echo ($page + 1); ?>">Próxima</a>
								</li>
							<?php } ?>
							<li>
								<?php
									if ($totalPages > 1) {
										echo "<p style=\"margin-left:10px;color:#5faa4f\"> Página $current_page de $totalPages</p>";
									} else {
										echo "<p style=\"margin-left:10px;padding:5px;color:#5faa4f\"> Página 1</p>";
									}
								?>
							</li>
						</ul>					
					</nav>
				</div>
			</div>
		<div>
	</div>		     
</div>
								
		    <div class="col-lg-3 col-md-12">
		        <div class="card" style="min-height:535px">
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
			 
			 