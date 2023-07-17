<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-6">
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
					<h4 class="card-title"><strong class="text-primary"> Grupo de Aprovadores</strong></h4>
						<p class="category">Escolha qual grupo você deseja adicionar um aprovador:</p>
					</div>
					<div class="card-content table-responsive"> 
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Grupo</th>
                                <th>Qtd</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = $conn->query("SELECT 
                                                    ap.approver_id,
													ap.approvers,
                                                    COALESCE(COUNT(gp.gp_approver_id), 0) AS num_approvers
                                                FROM approver AS ap
                                                LEFT JOIN gp_approver AS gp
                                                ON ap.approver_id = gp.approver_id
                                                GROUP BY ap.approver_id") or die(mysqli_error());
                            while($fetch = $query->fetch_array()){
                        ?>	
                            <tr>
                                <td><?php echo $fetch['approvers']?></td>
								<td class="text-center"><?php echo $fetch['num_approvers']?></td>
                                <td class="text-center"><center><a style="padding:0px;position:absolute" class = "btn btn-info d-flex justify-content-center" href = "reservlab.php?approver_id=<?php echo $fetch['approver_id']."add-approver"?>"><abbr title="Adicionar"><i class = "material-icons">add</i></abbr></a></center></td>
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