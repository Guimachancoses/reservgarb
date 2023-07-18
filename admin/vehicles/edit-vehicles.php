<div class="main-content">  
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
                    <h4 class="card-title"><strong class="text-primary"> Editar Veículo</strong></h4>
                        <p class="category">Verifique as informações antes de salvar:</p>
                        <br />
                <?php
                    $query = $conn->query("SELECT * FROM `vehicles` WHERE `vehicle_id` = '$_REQUEST[vehicle_id]'") or die(mysqli_error($conn));
                    $fetch = $query->fetch_array();
                ?>
                <div  class = "col-md-10" style="min-height:225px">	
                    <form method = "POST" enctype = "multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                        <div class="card-foot">
                            <label><strong> Nome:</strong></label>
                            <input class = "form-control" value = "<?php echo $fetch['name']?>" name = "name" required />
                        </div>
                        <div class="card-foot">
                            <label><strong> Modelo:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['model']?>" name = "model" required />
                            <span id="capacity-error" class="text-danger"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Informações:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['description']?>" name = "description" required />
                            <span id="no-error" class="text-danger"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Nome do Arquivo <small>( Imagem )</small>:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['photo']?>" name = "photo" required />
                            <span id="photo-error" class="text-danger"></span>
                        </div>
                        <br />
                        <div class="card-foot">
                            <button name="edit-vehicle" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                        </div>
                    </form>
                    <?php require_once 'edit_query_vehicle.php'?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function validateForm() {
        var name = document.getElementsByName('name');
        var model = document.getElementsByName('model');
        var description = document.getElementsByName('description');
        var photo = document.getElementsByName('photo');

    if (
        name === "" ||
        model === "" ||
        description === "" ||
        photo === ""
    ) {
        // Um ou mais campos estão vazios, não exiba o alerta
        return false;
    }
    alert("Veículo inserido com sucesso!!!");
        return true;
    }

    window.onbeforeunload = function() {
        document.querySelector('form').reset();
    };
</script>
