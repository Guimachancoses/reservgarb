<?php require_once 'validate.php';?>
<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-8 col-md-2">
				<div class="card" style="min-height:625px">
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
					<h4 class="card-title"><strong class="text-primary"> Excluir Dados dos Usuários</strong></h4>
						<p class="category" style="border-color:ffab2f; border:1px solid; border-radius: 6px; display:flex; align-items:center; justify-content:center; background-color: #ffedbf; padding: 5px;  margin-bottom: 8px; color: #ffab2f;">Essa área é destinada para apagar todas as informações vinculadas a um usuário, caso desejar "Excluir um Usuário". Atenção, pois, ao clicar sobre o botão de exclusão, todas os dados serão deletados do usuário permanentemente, não sendo possível recuperá-los
						</p>
					</div>
					<br />
					<div class="search-container">
                        <input for="search-input" type="text" class="select-box" id="search-input" placeholder="Pesquisar..." />
                        <i class="material-icons" id="search-icon">search</i>
                    </div>

                    <script>
                        function searchTable() {
                            var input, filter, table, tr, td, i, txtValue, display;
                            input = document.getElementById("search-input");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");

                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td");
                                display = "none";
                                for (var j = 0; j < td.length; j++) {
                                    var cell = td[j];
                                    if (cell) {
                                        txtValue = cell.textContent || cell.innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            display = "";
                                            break;
                                        }
                                    }
                                }
                                tr[i].style.display = display;
                            }
                        }

                        document.getElementById("search-input").addEventListener("input", searchTable);

                        const searchInput = document.getElementById("search-input");
                        const searchIcon = document.getElementById("search-icon");

                        searchInput.addEventListener("focus", function() {
                            searchIcon.classList.add("active");
                        });

                        searchInput.addEventListener("blur", function() {
                            searchIcon.classList.remove("active");
                        });
                    </script>
					<div class="card-content table-responsive" style="max-height:423px">
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
								$queryad = $conn->query("SELECT 
															users_id, 
															firstname, 
															lastname,
															email 
															FROM `users` as u
															WHERE u.funcao != 'Administrador'
															AND EXISTS (
																		SELECT 1
																		FROM gp_approver
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
															ORDER BY firstname") or die(mysqli_error($conn));
								if (mysqli_num_rows($queryad) == 0) {
									echo "<td>Sem usuários com relações em outras tabelas</td>";
								}
								while($fetch = $queryad->fetch_array()){
								?>
								<tr>
									<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
									<td><?php echo $fetch['email']?></td>
									<td><center><a name = "delete_relation" class = "btn btn-danger" onclick = "confirmationDeletedb(this); return false;" href = "delete_relation-user.php?users_id=<?php echo $fetch['users_id']?>"><abbr style="display:flex;text-decoration:none" title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
			 
			 