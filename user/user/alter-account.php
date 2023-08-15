<div class="main-content">    
        <div class="row">
			<div class="col-lg-7">
				<div class="card" style="min-height:950px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Alterar Dados de Cadastrais</strong></h4>
						    <p class="category">Comfirme seus dados antes de salvar:</p>
                    <?php
                        $query = $conn->query("SELECT * FROM `users` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <div class = "col-md-8" style="min-height:850px">	
                        <form method = "POST" action = "aleter_query_account.php?users_id=<?php echo $_SESSION['users_id']?>">
                            <div class="card-footer">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" value = "<?php echo $fetch['firstname']?>" name = "firstname" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['lastname']?>" name = "lastname" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" class = "form-control" value = "<?php echo $fetch['email']?>" id="email" onblur="validateEmail()" placeholder="exemplo@mail.com.br" name = "email" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Telefone:</strong></label>
                                <?php $contactno = $fetch['contactno'];$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
                                <input type = "fone" class = "form-control" value = "<?php echo $formatted_contactno?>" name = "contactno" />
                            </div>
                            <div class="card-footer">
                                <label><strong> Senha:</strong></label>
                                <input type="password" id="pwd" placeholder="********" minlength="8" value="" class = "form-control" name = "password" required = required/>
                            </div>
                            <div class="card-footer">
                                <label><strong> Confirmar Senha:</strong></label>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" value="" class = "form-control" name = "confirme" onblur="validatePdw()" required = required/>
                            </div>
                            <br />
                            <div class="card-footer">
                                <button name = "alter_query_account" onclick="editsuccess()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                        <?php require_once 'alter_query_account.php'?>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>