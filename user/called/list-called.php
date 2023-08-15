<div class="main-content">
		
	<!---row-second----->

		<div class="row">
			<div class="col-lg-12 col-md-9">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
					<h4 class="card-title"><strong class="text-primary"> Lista de Chamados - Abertos/Finalizados</strong></h4>
						<p class="category">Acompanhe seu chamado podendo editar ou reabrir, caso finalizado e excluir o chamado:</p>
					</div>
					<div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Nº Chamado</th>
                                <th>Laborátorio</th>
                                <th>Nº</th>
                                <th>Categoria</th>
                                <th>Assunto</th>
                                <th>Prioridade</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $conn->query("SELECT
                                                            ch.chamado_id,
                                                            lb.room_type,
                                                            lb.room_no,
                                                            ct.categoria,
                                                            ch.assuntos,
                                                            pr.prioridade,
                                                            st.status
                                                        FROM chamados as ch
                                                        INNER JOIN laboratorios as lb
                                                        ON ch.room_id = lb.room_id
                                                        INNER JOIN categorias as ct
                                                        ON ch.categoria_id = ct.categoria_id
                                                        INNER JOIN prioridades as pr
                                                        ON ch.prioridade_id = pr.prioridade_id
                                                        INNER JOIN status as st
                                                        ON st.status_id = ch.status_id
                                                        WHERE ch.users_id = '$_SESSION[users_id]'
                                                        ORDER BY st.status DESC") or die(mysqli_error());
                                if (mysqli_num_rows($query) == 0) {
                                    echo "<td>Sem Chamados</td>";
                                }
                                while($fetch = $query->fetch_array()){
                            ?>
                            <tr>
                            <td>
                                <?php echo $fetch['chamado_id']?></td>
                                <td><?php echo $fetch['room_type']?></td>
                                <td><?php echo $fetch['room_no']?></td>
                                <td><?php echo $fetch['categoria']?></td>
                                <td><?php echo $fetch['assuntos']?></td>
                                <td><?php echo $fetch['prioridade']?></td>
                                <td>
                                    <?php 
                                        if ($fetch['status'] == 'Pendente') {
                                        echo "<label style='color:#449D44;'><strong>".$fetch['status']."</strong></label>";
                                        } else if ($fetch['status'] == 'Finalizado') {
                                        echo "<label style='color:#800000;'><strong>".$fetch['status']."</strong></label>";
                                        } else {
                                        echo $fetch['status'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <center>
                                        <!-- Exibe linha com opções para alteração caso status seja retornado pendente -->
                                        <?php if($fetch['status'] == 'Finalizado'): ?>
                                        <a style="padding:1px" class="btn btn-info" href="reservlab.php?chamado_id=<?php echo $fetch['chamado_id']."&reopen-called"?>">
                                            <abbr title="Reabrir"><i class="material-icons">launch</i></abbr>
                                        </a>
                                        <!-- Exibe linha com opções para reabrir caso status seja retornado finalizado -->
                                        <?php elseif($fetch['status'] == 'Pendente'): ?>
                                        <a style="padding:1px" class="btn btn-warning" href="reservlab.php?chamado_id=<?php echo $fetch['chamado_id']."&reopen-called"?>">
                                            <abbr title="Editar"><i class="material-icons">edit_note</i></abbr>
                                        </a>
                                        <a style="padding:1px" class="btn btn-danger" onclick="confirmationDelete(); return false;" href="delete_called.php?chamado_id=<?php echo $fetch['chamado_id']?>">
                                            <abbr title="Deletar"><i class="material-icons">delete</i></abbr>
                                        </a>
                                        <?php endif; ?>
                                    </center>
                                </td>
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