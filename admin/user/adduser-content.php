<div class="main-content">    
        <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:950px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Adicionar Usuário</strong></h4>
						<!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                    <div  class = "col-md-10" style="min-height:850px">	
                        <form method = "POST" action="#">
                            <div class="card-foot">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" name = "firstname" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" name = "lastname" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> RA:</strong></label>
                                <input type = "text" class = "form-control" id="ra" placeholder="Digite apenas números" name = "username" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Função:</strong></label>
                                <select class = "form-control" name = "funcao" required = required>
                                    <option value = "">Escolha uma opções</option>
                                    <option value = "Administrador">Administrador</option>
                                    <option value = "Responsável Laboratório">Responsável Laboratório</option>
                                    <option value = "Professor(a)">Professor(a)</option>
                                    <option value = "Usuário">Usuário</option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" class = "form-control" id="email" onblur="validateEmail()" placeholder="exemplo@mail.com.br" name = "email" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Telefone:</strong></label>
                                <input type = "tel" class = "form-control" id="fone" onblur="validateFone()" placeholder="Digite apenas números" name = "contactno" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> CPF:</strong></label>
                                <input class = "form-control" type="text" id="cpf" onblur="validateCPF()" placeholder="Digite apenas números" minlength="11" maxlength="14" name="cpf" required = required>
                            </div>
                            <div class="card-foot">
                                <label><strong> Senha:</strong></label>
                                <input type="password" id="pwd" placeholder="********" minlength="8" value="" class = "form-control" name = "password" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Confirmar Senha:</strong></label>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" value="" class = "form-control" name = "confirme" onblur="validatePdw()" required = required/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button name = "add_account" onclick="success()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_account.php'?>

                        <script>
                            const input = document.getElementById('ra');

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