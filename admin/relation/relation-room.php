<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-12">
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
                        <h4 class="card-title"><strong class="text-primary"> Excluir Dados das Salas</strong></h4>
						<p class="category" style="display:flex;align-items:center;justify-content:center; background-color: #f4d7d3;  border-radius: 6px;  padding: 5px;  margin-bottom: 8px; color: #000000;">Essa área é destinada para apagar todas as informações vinculadas a um laboratório, caso desejar "Excluir um Laboratório". Atenção, pois, ao clicar sobre o botão de exclusão, todas os dados serão deletados do laboratório permanentemente, não sendo possível recuperá-los
						</p>
					</div>
					<div class="card-content table-responsive"> 
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Tipo de Laboratório</th>
                                <th>Nº</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = $conn->query("SELECT * 
                                                        FROM `laboratorios` lb
                                                        WHERE 
                                                        EXISTS (
                                                            SELECT 1
                                                            FROM locacao
                                                            WHERE room_id = lb.room_id
                                                        )") or die(mysqli_error());
                            if (mysqli_num_rows($query) == 0) {
								echo "<td>Sem laboratórios com informações em outras tabelas...</td>";
							}
                            while($fetch = $query->fetch_array()){
                        ?>	
                            <tr>
                                <td><?php echo $fetch['room_type']?></td>

                                <td><?php echo $fetch['room_no']?></td>
                                <td><center><a class = "btn btn-danger" onclick = "confirmationDeletedbl(this); return false;" href = "delete_relation-room.php?room_id=<?php echo $fetch['room_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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