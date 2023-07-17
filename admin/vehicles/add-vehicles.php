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
                    <h4 class="card-title"><strong class="text-primary"> Adicionar Veículo</strong></h4>
                        <p class="category">Verifique as informações antes de salvar:</p>
                <br />
                <div  class = "col-md-10" style="min-height:225px">	
                    <form method = "POST" enctype = "multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                        <div class="card-foot">
                            <label><strong> Nome:</strong></label>
                            <input class = "form-control" required = required name = "name" required />
                        </div>
                        <div class="card-foot">
                            <label><strong> Modelo:</strong></label>
                            <input type = "text" class = "form-control" name = "model" required />
                            <span id="capacity-error" class="text-danger"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Informações:</strong></label>
                            <input type = "text" class = "form-control" name = "description" required />
                            <span id="no-error" class="text-danger"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Nome do Arquivo <small>( Imagem )</small>:</strong></label>
                            <input type = "text" class = "form-control" name = "photo" required />
                            <span id="photo-error" class="text-danger"></span>
                        </div>
                        <br />
                        <div class="card-foot">
                            <button name = "add_vehicles" onclick="addroom()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                        </div>
                    </form>
                    <?php require_once 'add_query_vehicle.php'?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onbeforeunload = function() {
        document.querySelector('form').reset();
    };
</script>
