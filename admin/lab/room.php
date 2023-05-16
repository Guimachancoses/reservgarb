<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-12">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
                        <h4 class="card-title"><strong class="text-primary"> Editar Laboratórios</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
					</div>
					<div class="card-content table-responsive"> 
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Tipo de Laboratório</th>
                                <th>Capacidade</th>
                                <th>Número do Laboratório</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error());
                            while($fetch = $query->fetch_array()){
                        ?>	
                            <tr>
                                <td><?php echo $fetch['room_type']?></td>
                                <td><?php echo $fetch['capacity']?></td>
                                <td><?php echo $fetch['room_no']?></td>
                                <td><center><a class = "btn btn-warning" href = "reservlab.php?room_id=<?php echo $fetch['room_id']."edit-room"?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_room_query.php?room_id=<?php echo $fetch['room_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></center></td>
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
</div>