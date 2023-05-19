<div class="main-content">    
    <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:725px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Alterar Dados de Cadastrais</strong></h4>
						<p class="category">Comfirme seus dados antes de salvar:</p>
                    <?php
                        $query = $conn->query("SELECT * FROM `users` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error());
                        $fetch = $query->fetch_array();
                    ?>
                    <div class = "col-md-7">	
                        <form method = "POST" action = "edit_query_account_users.php?users_id=<?php echo $fetch['users_id']?>">
                            <div class="card-foot">
                                <label><strong> Nome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['firstname']?>" name = "firstname" />
                            </div>
                            <div class="card-foot">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['lastname']?>" name = "lastname" />
                            </div>
                            <div class="card-foot">
                                <label><strong> RA:</strong></label>
                                <input type = "text" class = "form-control" id="usuario" value = "<?php echo substr($fetch['username'], 0, 4) . "/" . substr($fetch['username'], 4, 2) . "-" . substr($fetch['username'], 6, 1); ?>" name = "username" disabled = "disabled"/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Função:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['funcao']?>" name = "funcao" disabled = "disabled"/>
                            </div>
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" class = "form-control" value = "<?php echo $fetch['email']?>" name = "email" />
                            </div>
                            <div class="card-foot">
                                <label><strong> Telefone:</strong></label>
                                <?php $contactno = $fetch['contactno'];$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
                                <input type = "fone" class = "form-control" value = "<?php echo $formatted_contactno?>" name = "contactno" />
                            </div>
                            <div class="card-foot">
                                <label><strong> CPF:</strong></label>
                                <input class = "form-control" type="text" id="cpf" onblur="validateCPF(this)" value = "<?php echo $fetch['cpf']?>" placeholder="Digite apenas números" minlength="11" maxlength="14" name="cpf" required>
                            </div>
                            <div class="card-foot">
                                <label><strong> Senha:</strong></label>
                                <input type = "password" class = "form-control" placeholder="********" minlength="8" value = "" name = "password" required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Confirmar Senha:</strong></label>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" value="" class = "form-control" name = "confirme" onblur="validatePdw()" required/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button name = "edit_account_users" onclick="editsuccess()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                        <?php require_once 'edit_query_account_users.php'?>
                        <script>
                            const input = document.getElementById('usuario');

                            // adiciona um evento para formatar o número ao perder o foco do input
                            input.addEventListener('blur', function() {
                            const value = this.value;

                            // verifica se o valor tem 7 caracteres e contém apenas números
                            if (value.length === 7 && /^\d+$/.test(value)) {
                                const formattedValue = formatNumber(value);
                                
                                // define o valor formatado como o valor do input
                                this.value = formattedValue;
                            } else {
                                alert('Por favor, digite um número de 7 dígitos.');
                                this.focus();
                            }
                            });

                            // função para formatar o número
                            function formatNumber(number) {
                            const firstPart = number.substring(0, 4);
                            const secondPart = number.substring(4, 6);
                            const thirdPart = number.substring(6, 7);

                            return `${firstPart}/${secondPart}-${thirdPart}`;
                            }
                            </script>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>