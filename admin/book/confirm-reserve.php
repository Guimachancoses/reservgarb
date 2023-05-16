<div class="main-content">  
    <div class="row">
			<div class="col-lg-10">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Confimar Reserva</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <br />
                    <div class = "col-md-12"style="min-height:700px">
                    <?php $query = $conn->query("SELECT
                                                    u.firstname
                                                    ,u.lastname
                                                    ,u.username
                                                    ,lb.room_type
                                                    ,lb.room_no
                                                    ,lb.capacity
                                                    ,c.curso
                                                    ,s.semestre
                                                    ,dc.nm_disciplina
                                                    ,dc.qtd_users
                                                    ,lc.locacao_id
                                                    ,lc.checkin
                                                    ,lc.checkin_time
                                                    ,lc.checkout_time
                                                    ,st.status
                                                FROM `locacao` as lc
                                                INNER JOIN `laboratorios` as lb
                                                ON lb.room_id = lc.room_id
                                                INNER JOIN `users` as u
                                                ON u.users_id = lc.users_id
                                                INNER JOIN `disciplinas` as dc
                                                ON dc.disciplina_id = lc.disciplina_id
                                                INNER JOIN `cursos` as c
                                                ON c.curso_id = dc.curso_id
                                                INNER JOIN `semestre` as s
                                                ON s.semester_id = dc.semester_id
                                                INNER JOIN `status` st
                                                ON st.status_id = lc.status_id
                                                WHERE lc.status_id = 1 && lc.locacao_id = '$_REQUEST[locacao_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <br />
                    <form method = "POST" action = "./save_form.php?locacao_id=<?php echo $fetch['locacao_id']?>">
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Primeiro Nome</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['firstname']?>" name = "firstname" class = "form-control" size = "35" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Sobrenome</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['lastname']?>" name = "lastname" class = "form-control" size = "35" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>RA</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo substr($fetch['username'], 0, 4) . "/" . substr($fetch['username'], 4, 2) . "-" . substr($fetch['username'], 6, 1); ?>" name = "username" class = "form-control" size = "20" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Laboratório</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['room_type']?>" name = "room_type" class = "form-control" size = "20" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Número</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['room_no']?>" name = "room_no" class = "form-control" size = "4" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Capacidade</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['capacity']?>" name = "room_no" class = "form-control" size = "4" disabled = "disabled"/>
                            </div>
                            <br style = "clear:both;"/>
                            <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Curso</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['curso']?>" name = "curso" class = "form-control" size = "20" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Semestre</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['semestre']?>" name = "semestre" class = "form-control" size = "20" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Disciplina</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['nm_disciplina']?>" name = "disciplina" class = "form-control" size = "30" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Quantidade de Aluno</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['qtd_users']?>" name = "qtd_users" class = "form-control" size = "4" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;" style = "float:left; margin-left:20px;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Data da Reserva</strong></label>
                                <br />
                                <input type = "text" value="<?php echo(date("d/m/Y", strtotime($fetch['checkin'])))?>" name = "checkin" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Hora da Reserva</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['checkin_time']?>" name = "checkin_time" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Hora da Devolução</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['checkout_time']?>" name = "checkout_time" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Status</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['status']?>" name = "status" class = "form-control" size = "15" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                        <div class="card-footer">
                        <button  name = "add_form" class = "btn btn-primary"><i class = "glyphicon glyphicon-save"></i> Confimar</button>
                        </div>
                    </form>
                    <?php require_once './save_form.php'?>
                </div>
            </div>
        </div>
</div>
</div>