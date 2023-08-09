<?php require_once 'validate.php';?>
<div class="main-content">	
	<!---row-second----->
    <div class="row">
        <div class="col-lg-9">
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
                        <h4 class="card-title"><strong class="text-primary">Veículos</strong></h4>
                        <p class="category">Escolha qual veículo você deseja reservar e verifique a sua disponibilidade:</p>
                    </div>
                    <div class="card-content table-responsive" style="padding:2">
                        <div class = "panel panel-default" >
                            <?php
                                require_once 'connect.php';
                                $query = $conn->query("SELECT * FROM `vehicles` ORDER BY vehicle_id Desc") or die(mysqli_error($conn));
                                while($fetch = $query->fetch_array()){
                            ?>
                            <div class="card">
                                <div class = "well" style = "height:280px; width:100%;">
                                    <div class="div-image" style = "float:left;height:250px; width:600px">
                                        <img class="image" src="../photo/<?php echo $fetch['photo']?>" alt="../photo/gar.jpg" height="250" width="70%" onmouseover="changeImage(this)" onmouseout="restoreImage(this)">
                                    </div>
                                    <div style = "float:left; margin-top:120px;margin-bottom:10px">
                                        <h3 class="category"><?php echo '<strong class="text-primary">Nome: </strong>'.$fetch['name']?></h3>
                                        <h3 class="category"><?php echo '<strong class="text-primary">Modelo: </strong>'.$fetch['model']?></h3>
                                        <h3 class="category"><?php echo '<strong class="text-primary">Descrição: </strong>'.$fetch['description']?></h3>
                                        </br>
                                        <a class="btn btn-info" href="reservlab.php?rscalender" style="display: flex; align-items: center; text-decoration: none;justify-content:center;">
                                            <span style="margin-right: 5px;color:white">Reservar</span>
                                            <i class="material-icons" style="margin-left: 5px;">schedule</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <script>
                            function changeImage(element) {
                                // Armazena a imagem original em um atributo personalizado
                                element.setAttribute('data-original-image', element.src);
                                element.src = "../photo/gar.jpg";
                            }

                            function restoreImage(element) {
                                // Restaura a imagem original ao tirar o mouse da imagem
                                var originalImage = element.getAttribute('data-original-image');
                                element.src = originalImage;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>



        
    
