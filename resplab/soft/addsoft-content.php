<div class="main-content">    
        <div class="row">
			<div class="col-lg-7">
				<div class="card" style="min-height:950px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar Software</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <div class = "col-md-8" style="min-height:850px">	
                        <form method = "POST" action="#">
                            <div class="card-footer">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" name = "name" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Editor:</strong></label>
                                <input type = "text" class = "form-control" name = "editor" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Versão:</strong></label>
                                <input type = "text" class = "form-control" name = "version" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Lançado:</strong></label>
                                <input type="date" class = "form-control" name = "realesed" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "add_soft" onclick="successSoft()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_soft.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>