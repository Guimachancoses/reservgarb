<div class="main-content">    
    <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Editar Usuário</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <?php
                        $query = $conn->query("SELECT * FROM `softwares` WHERE `software_id` = '$_REQUEST[software_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <div class = "col-md-7">	
                        <form method = "POST" action = "edit_query_software.php?software_id=<?php echo $fetch['software_id']?>">
                        <div class="card-footer">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" value="<?php echo $fetch['name']?>" name = "name" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Editor:</strong></label>
                                <input type = "text" class = "form-control" value="<?php echo $fetch['editor']?>" name = "editor" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Versão:</strong></label>
                                <input type = "text" class = "form-control" value="<?php echo $fetch['version']?>" name = "version" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Lançado:</strong></label>
                                <input type="date" class = "form-control" value="<?php echo $fetch['realesed']?>" name = "realesed" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "edit_software" onclick="editsuccess()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                        <?php require_once 'edit_query_software.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>