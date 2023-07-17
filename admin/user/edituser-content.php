<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-20">
				<div class="card" style="min-height:755px">
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
					<h4 class="card-title"><strong class="text-primary"> Editar Usuários</strong></h4>
						<p class="category">Escolha qual usuário você deseja editar, ativar, inativar ou excluir:</p>
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
									<th></th>
									<th>Nome</th>
									<th>Função</th>
									<th>E-mail</th>
									<th>Telefone</th>
									<th>Status</th>
									<th class="text-center">Ação</th>
								</tr>
							</thead>

							<tbody>

								<?php  
										$queryad = $conn->query("SELECT users_id, firstname, lastname, funcao, email, contactno, status FROM `users` WHERE users_id != '$_SESSION[users_id]'ORDER BY firstname") or die(mysqli_error());
										while($fetch = $queryad->fetch_array()){
									?>
									<tr>
										<td><?php if ($fetch['status'] == "5") { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-success";';} else if ($fetch['status'] == "7") { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-warning";';} else { echo '<div class="steamline" style="padding-top:10px"><div class="sl-item sl-danger";';}?></td>
										<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
										<td><?php echo $fetch['funcao']?></td>
										<td><?php echo $fetch['email']?></td>
										<?php $contactno = $fetch['contactno'];
										$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
										<td><?php echo $formatted_contactno?></td>
										<td><?php if ($fetch['status'] == "5") { echo ' &#9989 <small style="color:green">Ativo</small>';} else if ($fetch['status'] == "7") { echo '<small style="color:#F9C851">Não atribuído</small>';} else { echo ' &#10071<small style="color:red">Inativo</small>';}?></td>
										<td class="text-center">
											<center>
												<!-- Exibe linha com opções para inativar caso status seja retornado ativo -->
												<?php if($fetch['status'] == '5'): ?>
													<a class = "btn btn-warning" href = "reservlab.php?users_id=<?php echo $fetch['users_id']."edit-account"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a>&#160<a class = "btn btn-success" href = "change_status_block.php?users_id=<?php echo $fetch['users_id']?>"><abbr title="Inativar"><i class = "material-icons">lock_open</i></abbr></a>												
												<!-- Exibe linha com opções para ativar caso status seja retornado inativo -->
												<?php elseif($fetch['status'] == "6"): ?>
													<a class = "btn btn-warning" href = "reservlab.php?users_id=<?php echo $fetch['users_id']."edit-account"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a>&#160<a class = "btn btn-danger" href = "change_status_active.php?users_id=<?php echo $fetch['users_id']?>"><abbr title="Ativarr"><i class = "material-icons">lock</i></abbr></a>												
												<!-- Exibe linha com opções para deletar caso status seja retornado NULL -->
												<?php elseif($fetch['status'] == "7"): ?>
													<a class = "btn btn-warning" href = "reservlab.php?users_id=<?php echo $fetch['users_id']."edit-account"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a>&#160<a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_account.php?users_id=<?php echo $fetch['users_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a>												
												<?php endif; ?>
											</center>
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
				</div>
			<div>
		</div>
		     
</div>
		   
		    

			 
			 