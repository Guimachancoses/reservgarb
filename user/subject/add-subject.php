<div class="main-content">    
        <div class="row">
			<div class="col-lg-5 ">
				<div class="card" style="min-height:650px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar Disciplina</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> -->
                    <div class = "col-md-10"style="min-height:650px">	
                        <form method = "POST" action="#">
                            <div class="card-footer">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" name = "nm_disciplina" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Curso:</strong></label>
                                <select class = "form-control" name = "curso" required = required>
                                    <option value="" disabled selected>Escolha uma das opções</option>
                                    <?php 
                                        $querycr = $conn->query("SELECT * FROM cursos") or die (mysqli_error());
                                        while ($fetchcr = $querycr->fetch_array()) {
                                    ?>
                                    <option value = "<?php echo $fetchcr['curso']?>"><?php echo $fetchcr['curso']?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Semestre:</strong></label>
                                <select class = "form-control" name = "semestre" required = required>
                                    <option value="semestre" disabled selected>Escolha uma das opções</option>
                                    <?php 
                                        $querycr = $conn->query("SELECT * FROM semestre") or die (mysqli_error());
                                        while ($fetchcr = $querycr->fetch_array()) {
                                    ?>
                                    <option value = "<?php echo $fetchcr['semestre']?>"><?php echo $fetchcr['semestre']?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                              <div class="card-footer">
                                <label><strong> Qtd. Alunos:</strong></label>
                                <input type="number" min="1" max="100" id="qtd_users" class = "form-control" name = "qtd_users" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Início do Ano Letivo:</strong></label>
                                <input type="date" id="date" class = "form-control" name = "date" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "add_subject" onclick="success()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_subject.php'?>

                </div>
            </div>
        </div>
</div>
</div>