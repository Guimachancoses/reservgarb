<div class="main-content">	
	<!---row-second----->
    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="min-height:750px">
                <div class="card-header card-header-text">
                    <h4 class="card-title"><strong class="text-primary"> Editar Veículos</strong></h4>
                    <p class="category">Escolha qual veículo você deseja editar ou excluir:</p>
                </div>
                <div class="card-content table-responsive" style="padding:2px">
                    <div style = "background-color:white;" class = "container">
                        <div class = "panel panel-default">
                            <?php
                                require_once 'connect.php';
                                $query = $conn->query("SELECT * FROM `vehicles`") or die(mysql_error());
                                while($fetch = $query->fetch_array()){
                            ?>
                                <div class = "well" style = "height:280px; width:100%;">
                                    <div style = "float:left;height:250px; width:500px">
                                        <img src = "../photo/<?php echo $fetch['photo']?>" height = "250" width = "70%"/>
                                    </div>
                                    <div style = "float:left; margin-top:120px;margin-bottom:10px">
                                        <h3 class="category"><?php echo '<strong class="text-primary">Nome: </strong>'.$fetch['name']?></h3>
                                        <h3 class="category"><?php echo '<strong class="text-primary">Modelo: </strong>'.$fetch['model']?></h3>
                                        <h3 class="category"><?php echo '<strong class="text-primary">Descrição: </strong>'.$fetch['description']?></h3>
                                        </br>
                                        <a class = "btn btn-warning" href = "add_reserve.php?vehicle_id=<?php echo $fetch['vehicle_id']?>"><abbr title="Editar"><i class = "material-icons">edit_note</i></abbr></a> <a class = "btn btn-danger" onclick = "confirmationDelete(this); return false;" href = "delete_room_query.php?vehicle_id=<?php echo $fetch['vehicle_id']?>"><abbr title="Deletar"><i class = "material-icons">delete</i></abbr></a></td>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
    
