<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-10 col-md-12">
				<div class="card" style="min-height:750px">
					<div class="card-header card-header-text">
                        <h4 class="card-title"><strong class="text-primary"> Editar Veículos</strong></h4>
						<p class="category">Escolha qual veículo você deseja editar ou excluir:</p>
					</div>
                        <div style = "margin-left:20px;background-color:white;" class = "container">
                            <div class = "panel panel-default">
                                <div class = "panel-body">
                                    <strong><h3></h3></strong>
                                    <?php
                                        require_once 'connect.php';
                                        $query = $conn->query("SELECT * FROM `vehicles`") or die(mysql_error());
                                        while($fetch = $query->fetch_array()){
                                    ?>
                                        <div class = "well" style = "height:300px; width:100%;margin-left:20px;">
                                            <div style = "float:left;">
                                                <img src = "../photo/<?php echo $fetch['photo']?>" height = "250" width = "350"/>
                                            </div>
                                            <div style = "float:left; margin-left:10px;color:black;">
                                                <h3><?php echo "Nome: ".$fetch['name']?></h3>
                                                <h3><?php echo "Modelo: ".$fetch['model']?></h3>
                                                <h3><?php echo "Descrição: ".$fetch['description']?></h3>
                                                <br /><br /><br /><br /><br /><br /><br /><br /><br />
                                                <a style = "margin-left:580px;" href = "add_reserve.php?vehicle_id=<?php echo $fetch['vehicle_id']?>" class = "btn btn-info"><i class = "glyphicon glyphicon-list"></i> Editar</a>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                <br />
            
        </div>
</div>
