<div class="main-content">  
    <div class="row">
			<div class="col-lg-7">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Reabrir Chamado</strong></h4>
						<p class="category">Altere seu chamado, depois salve para reabri-lo:</p>
                    <div class = "col-md-10"style="min-height:700px">
                    <?php $query = $conn->query("SELECT
                                                    ch.chamado_id,
                                                    lb.room_type,
                                                    lb.room_no,
                                                    ct.categoria,
                                                    ch.assuntos,
                                                    ch.msg_chamado,
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
                                                WHERE ch.chamado_id = '$_REQUEST[chamado_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <form method = "POST" action = "save_alter-called.php?chamado_id=<?php echo $fetch['chamado_id']?>">
                            <div class="card-footer">
                                <label><strong> Número do Chamado:</strong></label>
                                <input class = "form-control" id="chamado" name = "chamado" value="<?php echo $_REQUEST['chamado_id']?>" disabled = "disabled"/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Status do Chamado:</strong></label>
                                <input class = "form-control" id="status_id" name = "status" value="<?php echo $fetch['status']?>" disabled = "disabled"/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Laboratório:</strong></label>
                                <input class = "form-control" id="room_id" name = "room_id" value="<?php echo $fetch['room_type']." - Nº ". $fetch['room_no']?>" disabled = "disabled"/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Categoria:</strong></label>
                                <input class = "form-control" id="categoria_id" name = "categoria_id" value="<?php echo $fetch['categoria']?>" disabled = "disabled"/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Assunto:</strong></label>
                                <input type = "text" class = "form-control" id="assuntos" name = "assuntos" value="<?php echo $fetch['assuntos']?>" disabled = "disabled"/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Prioridade:</strong></label>
                                <select class = "form-control" id="prioridade_id" name = "prioridade_id" required = required>
                                    <option value = ""disabled selected>Escolha uma opções</option>
                                    <?php 
                                        $querypr = $conn->query("SELECT * FROM prioridades") or die (mysqli_error());
                                        while($fetchpr = $querypr->fetch_array()){
                                        $prioridade_id = $fetchpr['prioridade_id'];
                                    ?>
                                    <option value = "<?php echo $prioridade_id?>"><?php echo $fetchpr['prioridade']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label for="menssagem"><strong> Editar Menssagem:</strong></label>
                                <textarea style="resize: none;" class = "form-control" rows="13" cols="40" id="menssagem"  name = "menssagem" ><?php echo $fetch['msg_chamado']?></textarea>
                                <p><label for="review"></label> <small class="caracteres"></small></p>
                            </div>
                            <script>
                                $(document).on("input", "#menssagem", function() {
                                var limite = 500;
                                var informativo = "caracteres restantes.";
                                var caracteresDigitados = $(this).val().length;
                                var caracteresRestantes = limite - caracteresDigitados;

                                if (caracteresRestantes <= 0) {
                                    var comentario = $("textarea[name=menssagem]").val();
                                    $("textarea[name=menssagem]").val(comentario.substr(0, limite));
                                    $(".caracteres").text("0 " + informativo);
                                } else {
                                    $(".caracteres").text(caracteresRestantes + " " + informativo);
                                }
                            });            
                            </script>
                            <div class="card-footer">
                                <button name = "alter_called" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-save"></i> Salvar Alteração</button>
                            </div>
                        </form>
                    </form>
                    <?php require_once './save_alter-called.php'?>
                </div>
            </div>
        </div>
</div>
</div>