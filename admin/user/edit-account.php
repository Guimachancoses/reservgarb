<?php require_once 'validate.php';?>
<div class="main-content">    
    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="min-height:1050px">
            <div class="card-foot" style="padding: 10px; display: flex; justify-content: flex-start;">
                        <button class="btn btn-info form-control" onclick="goBack()" style="padding: 2px; font-size: 8px; width: 50px;">
                            <i class="material-icons" style="vertical-align: middle; margin-right: 5px;">undo</i>
                        </button>
                    </div>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                <div class="card-header card-header-text">
                    <h4 class="card-title"><strong class="text-primary"> Editar Usuário</strong></h4>
                    <p class="category">Verifique os dados antes de salvar as alterações:</p>
                <?php
                    $query = $conn->query("SELECT
                                                *,
                                                (SELECT CONCAT(us_mgr.firstname, ' ', us_mgr.lastname) 
                                                FROM gp_approver AS gp_mgr 
                                                INNER JOIN users AS us_mgr 
                                                ON gp_mgr.users_id = us_mgr.users_id
                                                WHERE gp_mgr.gp_approver_id = us.gp_approver_id) AS manager_name
                                            FROM users AS us
                                            WHERE us.users_id = '$_REQUEST[users_id]'") or die(mysqli_error($conn));
                    $fetch = $query->fetch_array();
                    // hash do password
                    $password = $fetch['password']
                ?>
                <div class = "col-md-10"style="min-height:1050px">	
                    <form id="editForm" method = "POST" action = "edit_query_account_users.php?users_id=<?php echo $fetch['users_id']?>" enctype = "multipart/form-data" autocomplete="off">
                        <div class="card-foot">
                            <label><strong> Status:</strong></label>
                            <select class = "form-control" name = "status">
                                <option value = "<?php echo $fetch['status']?>"><?php if ($fetch['status'] == "5") { echo 'Ativo';} else if ($fetch['status'] == "7") { echo 'Não atribuido';} else { echo 'Inativo';}?></option>
                                <option value = "5">Ativo</option>
                                <option value = "6">Inativo</option>
                                <option value = "7">Não atribuído</option>
                            </select>
                        </div>
                        <div class="card-foot">
                            <label><strong> Nome:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['firstname']?>" name = "firstname" required/>
                        </div>
                        <div class="card-foot">
                            <label><strong> Sobrenome:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['lastname']?>" name = "lastname" required/>
                        </div>
                        <div class="card-foot">
                            <label><strong> Função:</strong></label>
                            <select class = "form-control" required = required name = "funcao"required>
                                <option value = "<?php echo $fetch['funcao']?>"><?php echo $fetch['funcao']?></option>
                                <option value="Administrador">Administrador</option>
                                <option value="Aprovador">Aprovador</option>
                                <option value="Usuário">Usuário</option>
                            </select>
                        </div>
                        <div class="card-foot">
                            <label><strong> E-mail:</strong></label>
                            <input type = "email" id="email" class = "form-control" onblur="validateEmail()" value = "<?php echo $fetch['email']?>" name = "email" required/>
                            <span id="mail-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Telefone:</strong></label>
                            <?php $contactno = $fetch['contactno'];$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
                            <input type = "fone" id="fone" class = "form-control" onblur="validateFone()" value = "<?php echo $formatted_contactno?>" name = "contactno" required/>
                            <span id="fone-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> CPF:</strong></label>
                            <input class = "form-control" type="text" id="cpf" value = "<?php echo $fetch['cpf']?>" onblur="validateCPF(this)"  placeholder="Digite apenas números" minlength="11" maxlength="14" name="cpf" required>
                            <span id="cpf-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Senha:</strong></label>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                            <input type = "password" id="pwd" class = "form-control" onblur="validateRx()" onclick="clearPassword()" placeholder="********" minlength="8" value = "<?php echo $password?>" name = "password" required/>
                            <span id="pwd-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Confirmar Senha:</strong></label>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                            <input type="password" id="pwd2" placeholder="********" minlength="8" value="<?php echo $password?>" class = "form-control" name = "confirme" onblur="validatePdw()" disabled/>
                            <span id="pwd2-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="card-foot">
                            <label><strong> Gerente Responsável:</strong></label>
                            <select class="form-control" name="manager_name">
								<option value="<?php echo $fetch['gp_approver_id']?>"><?php echo ($fetch['manager_name'] != "") ? $fetch['manager_name'] : "Escolha umas das opções" ?></option>
								<?php  
									$querysf = $conn->query("SELECT
                                    us.firstname,
                                    us.lastname,
                                    gp.gp_approver_id
                                FROM gp_approver gp
                                INNER JOIN users as us 
                                on gp.users_id = us.users_id") or die(mysqli_error($conn));
									while($fetchsf = $querysf->fetch_array()){
									$gp_approver_id = $fetchsf['gp_approver_id'];
								?>	
								<option value="<?php echo $gp_approver_id?>"><?php echo $fetchsf['firstname']." ".$fetchsf['lastname']?></option>';
								<?php
								} 
								?>
							</select>
                        </div>
                        <div class="card-foot">
                            <label><strong> Alterar senha no próximo login:</strong></label>
                            <input id="checkbox" type="checkbox" name="checkbox" <?php echo $fetch['first_lg'] != 1 ? 'checked' : ''; ?>/>                         
                        </div>
                        <br />
                        <div class="card-foot">
                            <button name = "edit_account_users" onclick="edituser()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                        </div>
                    </form>
                    <?php require_once 'edit_query_account_users.php'?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onbeforeunload = function() {
        document.querySelector('form').reset();
    };
</script>

<script>
    // Função para limpar o campo Senha e ativar o campo Confirmar Senha
    function clearPassword() {
        document.getElementById('pwd').value = ''; // Limpa o valor do campo Senha
        document.getElementById('pwd2').value = ''; // Limpa o valor do campo Confirmar Senha
        document.getElementById('pwd2').removeAttribute('disabled'); // Remove o atributo disabled do campo Confirmar Senha
        document.getElementById('pwd2').setAttribute('required', 'true'); // Define o atributo required para o campo Confirmar Senha
    }
</script>

<script>
    function edituser() {
        var checkbox = document.getElementById('checkbox');
        var form = document.getElementById('editForm');

        // Verifica se a caixa de seleção está marcada
        if (!checkbox.checked) {
            // Se não estiver marcada, atribui um valor vazio ao campo 'checkbox'
            checkbox.value = "";
        }

        // Submete o formulário
        form.submit();
    }
</script>
