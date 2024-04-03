<?php require_once 'validate.php';?>
<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-9">
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
					<h4 class="card-title"><strong class="text-primary">Pedidos Reservados</strong></h4>
						<p class="category">Caso queira liberar a reserva, clique do botão ao lado:</p>
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
                                <th>Dt. Reserva</th>
                                <th>Hr. Reserva</th>
                                <th>Hr. Devolução</th>
                                <th>Aprovador</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $session_id = $_SESSION['users_id'];
                                $perPage = 10; // Número de resultados por página
                                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual (por padrão, é a página 1)
                                $offset = ($page - 1) * $perPage; // Offset para a consulta SQL
                                $totalResults = $conn->query("SELECT COUNT(*) as total FROM locacao WHERE users_id != $session_id AND status_id IN (2,8)")->fetch_assoc()['total']; // Total de resultados no banco de dados
                                $totalPages = ceil($totalResults / $perPage); // Total de páginas necessárias
                                $current_page = min($page, $totalPages); // Página atual não pode ser maior que o total de páginas
                                
                                $querypd2 = $conn->query("SELECT
                                    lc.locacao_id,
                                    lb.room_id,
                                    u.firstname,
                                    u.lastname,
                                    COALESCE(lb.room_type, vs.name, eq.equipment) as locacao,
                                    lc.checkin,
                                    lc.checkin_time,
                                    lc.checkout_time,
                                    lc.approver_id,
                                    lc.gp_approver_id,
                                    CONCAT(appr.firstname, ' ', LEFT(appr.lastname, 1)) AS approver_name,
                                    st.status
                                FROM `locacao` as lc
                                LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                                INNER JOIN `users` as u ON u.users_id = lc.users_id
                                LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                                LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                                INNER JOIN `status` st ON st.status_id = lc.status_id
                                INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
                                INNER JOIN `gp_approver` AS gp ON gp.gp_approver_id = lc.gp_approver_id
                                LEFT JOIN `users` AS appr ON appr.users_id = gp.users_id
                                WHERE
                                    lc.status_id IN (2,8)
                                    AND lc.users_id != $session_id
                                ORDER BY  lc.checkin ASC, st.status ASC
                                LIMIT $perPage OFFSET $offset") or die(mysqli_error($conn));
                                
                                if (mysqli_num_rows($querypd2) == 0) {
                                    echo "<td>Sem reservas...</td>";
                                }                        
                                while ($fetch = $querypd2->fetch_array()) {
                            ?>
                            <tr <?php if($fetch['status'] == 'Atrasado') echo 'style="background-color: #f4d7d3;"'; ?>>
                                <td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
                                <td><?php echo $fetch['locacao']?></td>
                                <td><strong><?php if($fetch['checkin'] <= date("Y-m-d", strtotime("+8 HOURS"))){echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}else{echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}?></strong></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkin_time']))."</label>"?></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkout_time']))."</label>"?></td>
                                <td>
                                    <?php
                                        $approver_name = $fetch['approver_name'];
                                        $adminName = ($approver_name == 'Guilherme M' or $approver_name == 'Bruno R') ? 'Administrador' : $approver_name;
                                        echo "<label >$adminName</label>";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $status = $fetch['status'];
                                        $cor = ($status == 'Atrasado') ? '#ff0000' : '#0000FF';
                                        echo "<label style='color: $cor;'><strong>$status</strong></label>";
                                    ?>
                                </td>
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
                                <a class="n-overlay" href="reservlab.php?reslab&page=<?php echo ($page - 1); ?>">Anterior</a>
                            </li>
                        <?php } ?>
                        <?php if (mysqli_num_rows($querypd2) == $perPage && $totalPages > 1) { ?>
                            <li class="page-item">
                                <a class="n-overlay" href="reservlab.php?reslab&page=<?php echo ($page + 1); ?>">Próxima</a>
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
