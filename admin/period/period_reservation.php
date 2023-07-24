<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-11 col-md-10">
				<div class="card" style="min-height:750px">
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
					<h4 class="card-title"><strong class="text-primary"> Reservas por Período Pendentes</strong></h4>
						<p class="category">Clique em aprovar ou excluir o pedido de reserva:</p>
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

                        <thead class="text-primary" style="cursor:pointer">
                            <tr>
                                <th>Nome</th>
                                <th>Locação</th>
                                <th>Dia da Semana</th>
                                <th>Dt. Reserva</th>
                                <th>Dt. Devolução</th>
                                <th>Hr. Reserva</th>
                                <th>Hr. Devolução</th>
                                <th>Status</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $session_id = $_SESSION['users_id'];
                                $perPage = 10; // Número de resultados por página
                                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual (por padrão, é a página 1)
                                $offset = ($page - 1) * $perPage; // Offset para a consulta SQL
                                $totalResults = $conn->query("SELECT COUNT(*) as total FROM lc_period as lc INNER JOIN mensagens as ms WHERE ms.mensagens_id = 2")->fetch_assoc()['total']; // Total de resultados no banco de dados
                                $totalPages = ceil($totalResults / $perPage); // Total de páginas necessárias
                                $current_page = min($page, $totalPages); // Página atual não pode ser maior que o total de páginas

                                $querypd = $conn->query("SET @groupId = (
                                    SELECT approver_id
                                    FROM gp_approver
                                    WHERE users_id = $session_id
                                )");
                                
                                $querypd2 = $conn->query("SELECT
                                    lc.lc_period_id,
                                    u.firstname,
                                    u.lastname,
                                    COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                    CASE lc.weekday
                                    WHEN 'Monday' THEN 'Segunda-feira'
                                    WHEN 'Tuesday' THEN 'Terça-feira'
                                    WHEN 'Wednesday' THEN 'Quarta-feira'
                                    WHEN 'Thursday' THEN 'Quinta-feira'
                                    WHEN 'Friday' THEN 'Sexta-feira'
                                    WHEN 'Saturday' THEN 'Sábado'
                                    WHEN 'Sunday' THEN 'Domingo'
                                    ELSE 'Todos os dias' END AS dia_semana,
                                    lc.checkin,
                                    lc.checkout,
                                    lc.checkin_time,
                                    lc.checkout_time,
                                    lc.approver_id,
                                    ms.assunto
                                FROM `lc_period` as lc
                                LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                INNER JOIN `users` as u ON u.users_id = lc.users_id
                                LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
                                WHERE ms.mensagens_id = 2
                                    AND (
                                        (@groupId = 1) -- Administrador
                                        OR
                                        (@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
                                        OR
                                        (@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
                                        OR
                                        (@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
                                    )
                                ORDER BY  lc.checkin ASC
                                LIMIT $perPage OFFSET $offset") or die(mysqli_error($conn));
                                
                                if (mysqli_num_rows($querypd2) == 0) {
                                    echo "<td>Sem reservas pendentes...</td>";
                                }                        
                                while ($fetch = $querypd2->fetch_array()) {
                            ?>
                            <tr>
                                <td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
                                <td><?php echo $fetch['locacao']?></td>
                                <td><?php echo $fetch['dia_semana']?></td>
                                <td><strong><?php if($fetch['checkin'] <= date("Y-m-d", strtotime("+8 HOURS"))){echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}else{echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}?></strong></td>
                                <td><strong><?php if($fetch['checkout'] <= date("Y-m-d", strtotime("+8 HOURS"))){echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkout']))."</label>";}else{echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkout']))."</label>";}?></strong></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkin_time']))."</label>"?></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkout_time']))."</label>"?></td>
                                <td>
                                    <?php
                                    $assunto = $fetch['assunto'];
                                    if ($assunto === "Solicitações pendentes!") {
                                        echo "<label style='color:#449D44;'><strong><small>Pendente</small></strong></label>";
                                    } else {
                                        echo "<label style='color:#449D44;'><strong><small>" . $assunto . "</small></strong></label>";
                                    }
                                    ?>
                                </td>
                                <td><center><a style="padding:1px" class = "btn btn-success" href = "reservlab.php?lc_period_id=<?php echo $fetch['lc_period_id']."confirm-reserve"?>"><abbr title="Aprovar"><i class = "material-icons">thumb_up_alt</i></abbr></a> <a style="padding:1px" class = "btn btn-danger" onclick = "confirmationDelete(); return false;" href = "delete_pending.php?lc_period_id=<?php echo $fetch['lc_period_id']?>"><abbr title="Excluir"><i class = "material-icons">thumb_down_alt</i></abbr></a></center></td>
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
                <!-- Paginação -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) { ?>
                            <li class="page-item">
                                <a class="n-overlay" href="reservlab.php?penlab&page=<?php echo ($page - 1); ?>">Anterior</a>
                            </li>
                        <?php } ?>
                        <?php if (mysqli_num_rows($querypd2) == $perPage && $totalPages > 1) { ?>
                            <li class="page-item">
                                <a class="n-overlay" href="reservlab.php?penlab&page=<?php echo ($page + 1); ?>">Próxima</a>
                            </li>
                        <?php } ?>
						<li>
						<?php
							if ($totalPages > 1) {
								echo "<p style=\"margin-left:10px;padding:10px;color:#5faa4f\"> Página $current_page de $totalPages</p>";
							} else {
								echo "<p style=\"margin-left:10px;padding:10px;color:#5faa4f\"> Página 1</p>";
							}
						?>
                        </li>
                    </ul>
                   
                </nav>
            </div>
        </div>
</div>
