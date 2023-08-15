<div class="main-content">    
        <div class="row">
			<div class="col-lg-6">
                <div class="card" style="min-height:650px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Alterar Disciplina</strong></h4>
						<p class="category">Verifique os dados antes de salvar:</p>
                    <?php
                        $query = $conn->query("SELECT * 
                                                FROM `disciplinas` as dc 
                                                INNER JOIN semestre as st
                                                ON dc.semester_id = st.semester_id
                                                INNER JOIN cursos as cr
                                                ON dc.curso_id = cr.curso_id
                                                WHERE users_id = '$_SESSION[users_id]' AND `disciplina_id` = '$_REQUEST[disciplina_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <div class = "col-md-9" style="min-height:650px">	
                        <form method = "POST" action = "edit_query_subject.php?disciplina_id=<?php echo $fetch['disciplina_id']?>">
                            <div class="card-footer">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" value="<?php echo$fetch['nm_disciplina']?>" name = "nm_disciplina" required = required/>
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
                                    <option value="" disabled selected>Escolha uma das opções</option>
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
                                <input type="number" min="1" max="100" id="qtd_users" value="<?php echo$fetch['qtd_users']?>" class = "form-control" name = "qtd_users" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Início do Ano Letivo:</strong></label>
                                <input type="date" id="date" class = "form-control" value="<?php echo$fetch['date']?>" name = "date" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "edit_query_subject" onclick="editsuccess()" class = "btn btn-warning form-control d-flex justify-content-center"><i style="color:black " class = "material-icons">save</i><strong> Salvar alterações</strong></button>
                            </div>
                        </form>
                        <?php require_once 'edit_query_subject.php'?>

                </div>
            </div>
        </div>
</div>
</div>