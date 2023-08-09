<?php require_once 'validate.php';?>
<div class="main-content">   
        <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:950px">
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
						<h4 class="card-title"><strong class="text-primary"> Adicionar Usuário</strong></h4>
						<p class="category">Verifique as informações antes de salvar:</p>
                    <div class = "col-md-10" style="min-height:950px">	
                        <form method = "POST" action="#" enctype = "multipart/form-data" autocomplete="off">
                        <div class="card-foot">
                                <label><strong> Status:</strong></label>
                                <select class = "form-control" name = "status">
                                    <option value = "7">Escolha uma das opções</option>
                                    <option value = "5">Ativo</option>
                                    <option value = "6">Inativo</option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" name = "firstname" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" name = "lastname" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong>Função:</strong></label>
                                <select class="form-control" name="funcao" required>
                                    <option value="">Escolha uma das opções</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Aprovador">Aprovador</option>
                                    <option value="Usuário">Usuário</option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" class = "form-control" id="email" onblur="validateEmail()" placeholder="exemplo@mail.com.br" name = "email" required = required/>
                                <span id="mail-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Telefone:</strong></label>
                                <input type = "tel" class = "form-control" id="fone" onblur="validateFone()" placeholder="Digite apenas números" name = "contactno" required = required/>
                                <span id="fone-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> CPF:</strong></label>
                                <input class = "form-control" type="text" id="cpf" onblur="validateCPF()" placeholder="Digite apenas números" minlength="11" maxlength="14" name="cpf" required = required>
                                <span id="cpf-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd" placeholder="********" minlength="8" value="" class = "form-control" name = "password" onblur="validateRx()" required = required/>
                                <span id="pwd-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Confirmar Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" value="" class = "form-control" name = "confirme" onblur="validatePdw()" required = required/>
                                <span id="pwd2-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button type="submit" name = "add_account" onclick="adduser()" class = "btn btn-info form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'add_query_account.php'?>
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