<div class="main-content">    
        <div class="row">
			<div class="col-lg-7">
				<div class="card" style="min-height:950px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Abertura de Chamado</strong></h4>
						<p class="category">Escolha para qual laboratório você quer abrir um chamado e descreva sua menssagem:</p>
                    <div class = "col-md-10" style="min-height:850px">	
                        <form method = "POST">
                            <div class="card-footer">
                                <label><strong> Laboratório:</strong></label>
                                <select class = "form-control" id="room_id" name = "room_id" required = required>
                                    <option value = "" disabled selected> Escolha uma das opções</option>
                                    <?php 
                                        $querylb = $conn->query("SELECT * FROM laboratorios") or die (mysqli_error());
                                        while($fetchlb = $querylb->fetch_array()){
                                        $room_id = $fetchlb['room_id'];
                                    ?>
                                    <option value = "<?php echo $room_id?>">Lab. <?php echo $fetchlb['room_type']. " - Nº ".$fetchlb['room_no']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Categoria:</strong></label>
                                <select class = "form-control" id="categoria_id" name = "categoria_id" required = required>
                                    <option value = ""disabled selected> Escolha uma das opções</option>
                                    <?php 
                                        $queryct = $conn->query("SELECT * FROM categorias") or die (mysqli_error());
                                        while($fetchct = $queryct->fetch_array()){
                                        $categoria_id = $fetchct['categoria_id'];
                                    ?>
                                    <option value = "<?php echo $categoria_id?>"><?php echo $fetchct['categoria']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <label><strong> Assunto:</strong></label>
                                <input type = "text" class = "form-control" id="assuntos" name = "assuntos" required = required/>
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
                                <label for="menssagem"><strong> Menssagem:</strong></label>
                                <textarea style="resize: none;" class = "form-control" rows="13" cols="40" id="menssagem"  name = "menssagem"></textarea>
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
                                <button name = "add_called" onclick="success()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_called.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>