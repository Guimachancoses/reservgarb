<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-8 col-md-2">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Excluir Dados dos Usuários</strong></h4>
						<p class="category" style="display:flex;align-items:center;justify-content:center; background-color: #f4d7d3;  border-radius: 6px;  padding: 5px;  margin-bottom: 8px; color: #000000;">Essa área é destinada para apagar todas as informações vinculadas a um usuário, caso desejar "Excluir um Usuário". Atenção, pois, ao clicar sobre o botão de exclusão, todas os dados serão deletados do usuário permanentemente, não sendo possível recuperá-los
						</p>
					</div>
					<div class="card-content table-responsive">
						<table class="table table-hover">

							<thead class="text-primary">
								<tr>
									<th>Nome</th>
									<th>E-mail</th>
									<th class="text-center">Ação</th>
								</tr>
							</thead>

							<tbody>

							<?php
								$perPage = 8; // Número de resultados por página
								$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual (por padrão, é a página 1)
								$offset = ($page - 1) * $perPage; // Offset para a consulta SQL
								$totalResults = $conn->query("SELECT COUNT(*) as total FROM users WHERE funcao != 'Administrador'")->fetch_assoc()['total']; // Total de resultados no banco de dados
								$totalPages = ceil($totalResults / $perPage); // Total de páginas necessárias
								$current_page = min($page, $totalPages); // Página atual não pode ser maior que o total de páginas   
								$queryad = $conn->query("SELECT 
															users_id, 
															firstname, 
															lastname,
															email 
															FROM `users` as u
															WHERE u.funcao != 'Administrador'
															AND EXISTS (
																		SELECT 1
																		FROM req_software
																		WHERE users_id = u.users_id
																	)
																	OR EXISTS (
																		SELECT 1
																		FROM disciplinas
																		WHERE users_id = u.users_id
																	)
																	OR EXISTS (
																		SELECT 1
																		FROM activities
																		WHERE users_id = u.users_id && users_id != 1
																	)
																	OR EXISTS (
																		SELECT 1
																		FROM locacao
																		WHERE users_id = u.users_id
																	)																	
															ORDER BY firstname
															LIMIT $perPage OFFSET $offset") or die(mysqli_error());
								if (mysqli_num_rows($queryad) == 0) {
									echo "<td>Sem usuários com relações em outras tabelas</td>";
								}
								while($fetch = $queryad->fetch_array()){
								?>
								<tr>
									<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
									<td><?php echo $fetch['email']?></td>
									<td><center><a name = "delete_relation" class = "btn btn-danger" onclick = "confirmationDeletedb(this); return false;" href = "delete_relation-user.php?users_id=<?php echo $fetch['users_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
								</tr>
								<?php
									}
								?>
							
							</tbody>
							
						</table>
						<!-- Paginação -->
						<nav>
							<ul class="pagination justify-content-center">
								<?php if ($page > 1) { ?>
									<li class="page-item">
										<a class="n-overlay" href="reservlab.php?edituser&page=<?php echo ($page - 1); ?>">Anterior</a>
									</li>
								<?php } ?>
								<?php if (mysqli_num_rows($queryad) == $perPage && $totalPages > 1) { ?>
									<li class="page-item">
										<a class="n-overlay" href="reservlab.php?edituser&page=<?php echo ($page + 1); ?>">Próxima</a>
									</li>
								<?php } ?>
								<li>
								<?php
									if ($totalPages > 1) {
										echo "<p style=\"margin-left:10px\" class=\"text-primary\"> Página $current_page de $totalPages</p>";
									} else {
										echo "<p style=\"margin-left:10px;padding:5px\" class=\"text-primary\"> Página 1</p>";
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
		   
		    
  </div>
			 
			 