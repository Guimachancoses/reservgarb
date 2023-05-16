<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-12 col-md-9">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Laboratórios Reservados</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
					</div>
					<div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                                <th>Nome</th>
                                <th>Laboratório</th>
                                <th>Nº</th>
                                <th>Curso</th>
                                <th>Semestre</th>
                                <th>Disciplina</th>
                                <th>Qtd. Alunos</th>
                                <th>Dt. Reserva</th>
                                <th>Hr. Reserva</th>
                                <th>Hr. Devolução</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $conn->query("SELECT
                                                            u.firstname
                                                            ,u.lastname
                                                            ,lb.room_id
                                                            ,lb.room_type
                                                            ,lb.room_no
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
                                                        WHERE lc.status_id = 2") or die(mysqli_query());
                                while($fetch = $query->fetch_array()){
                            ?>
                            <tr>
                                <td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
                                <td><?php echo $fetch['room_type']?></td>
                                <td><?php echo $fetch['room_no']?></td>
                                <td><?php echo $fetch['curso']?></td>
                                <td><?php echo $fetch['semestre']?></td>
                                <td><?php echo $fetch['nm_disciplina']?></td>
                                <td><?php echo $fetch['qtd_users']?></td>
                                <td><strong><?php if($fetch['checkin'] <= date("Y-m-d", strtotime("+8 HOURS"))){echo "<label style = 'color:#ff0000;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}else{echo "<label style = 'color:#00ff00;'>".date("M d, Y", strtotime($fetch['checkin']))."</label>";}?></strong></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkin_time']))."</label>"?></td>
                                <td><?php echo "<label style = 'color:#00ff00;'>".date("h:i a", strtotime($fetch['checkout_time']))."</label>"?></td>
                                <td><?php echo "<label style = 'color:#0000FF;'><strong>" .$fetch['status']."</strong></label>"?></td>
                                <td><center><a class = "btn btn-warning" href = "checkout_query.php?locacao_id=<?php echo $fetch['locacao_id']?>" onclick = "confirmationCheckin(); return false;"><abbr title="Liberar"><i class = "material-icons">task</i></abbr></a></center></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>