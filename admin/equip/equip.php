<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-8">
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
                        <h4 class="card-title"><strong class="text-primary"> Editar Equipamentos</strong></h4>
						<p class="category">Escolha qual equipamento você deseja editar ou excluir:</p>
					</div>
					<div class="card-content table-responsive"> 
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Tipo da Equipamento</th>
                                <th>Setor</th>
                                <th>Descrição</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = $conn->query("SELECT * FROM `equipment`") or die(mysqli_error($conn));
                            if (mysqli_num_rows($query) == 0) {
								echo "<td>Sem equipamento cadastrado</td>";
							}
                            while($fetch = $query->fetch_array()){
                        ?>	
                            <tr>
                                <td><?php echo $fetch['equipment']?></td>
                                <td><?php echo $fetch['sector']?></td>
                                <td><?php echo $fetch['description']?></td>
                                <td><center><a class = "btn btn-warning" href = "reservlab.php?equip_id=<?php echo $fetch['equip_id']."edit-equip"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_equip_query.php?equip_id=<?php echo $fetch['equip_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
                            </tr>
                        <?php
                            }
                        ?>	
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
