<div class="main-content">  
    <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar Laboratório</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <br />
                    <div  class = "col-md-10" style="min-height:670px">	
                        <form method = "POST" enctype = "multipart/form-data">
                            <div class="card-foot">
                                <label><strong> Tipo de Laboratório:</strong></label>
                                <select class = "form-control" required = required name = "room_type">
                                    <option value = "">Escolha uma opção</option>
                                    <option value = "Informática">Informática</option>
                                    <option value = "Fisioterápia">Fisioterápia</option>
                                    <option value = "Elétrica">Elétrica</option>
                                    <option value = "Nutrição">Nutrição</option>
                                    <option value = "Estética">Estética</option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Capacidade:</strong></label>
                                <input type = "text" class = "form-control" name = "capacity" />
                            </div>
                            <div class="card-foot">
                                <label><strong> Número do Laboratório:</strong></label>
                                <input type = "text" class = "form-control" name = "room_no" />
                            </div>
                            <br />
                            <div class="card-foot">
                                <button name = "add_room" onclick="addroom()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_room.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>
