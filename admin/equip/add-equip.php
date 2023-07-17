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
						<h4 class="card-title"><strong class="text-primary"> Adicionar Equipamentos</strong></h4>
                            <p class="category">Verifique as informações antes de salvar:</p>
                    <br />
                    <div  class = "col-md-10" style="min-height:225px">	
                        <form method = "POST" enctype = "multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                            <div class="card-foot">
                                <label><strong> Tipo de Equipamento:</strong></label>
                                <input class = "form-control" required = required name = "equipment" required />
                            </div>
                            <div class="card-foot">
                                <label><strong> Setor Responsável:</strong></label>
                                <select class = "form-control" required = required name = "sector" required>
                                <option value = "">Escolha uma opção</option>
                                <option value = "T.I">T.I</option>
                                <option value = "RH">RH</option>
                                <option value = "GR">GR</option>
                                <option value = "Financeiro">Financeiro</option>
                                <option value = "Compras">Compras</option>
                                <option value = "CTE">CTE</option>
                                <option value = "Programação">Programação</option>
                                <option value = "Jurídico">Jurídico</option>
                                <option value = "Contabilidade">Contabilidade</option>
                            </select>
                                <span id="capacity-error" class="text-danger"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Descrição:</strong></label>
                                <input type = "text" class = "form-control" name = "description" required />
                                <span id="no-error" class="text-danger"></span>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button name = "add_equip" onclick="addroom()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_equip.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- <script>
    function validateForm() {
        var capacityInput = document.getElementById('capacity');
        var noInput = document.getElementById('no');
        var capacityError = document.getElementById('capacity-error');
        var noError = document.getElementById('no-error');
        var capacityValue = capacityInput.value.trim();
        var noValue = noInput.value.trim();

        // Verifica se a capacidade é um número
        if (!/^\d+$/.test(capacityValue)) {
            capacityError.innerText = 'A capacidade deve ser um número.';
            return false;
        } else {
            capacityError.innerText = '';
        }

        return true;
    }

    window.onbeforeunload = function() {
        document.querySelector('form').reset();
    };
</script> -->
