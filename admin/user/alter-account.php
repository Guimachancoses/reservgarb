<?php require_once 'validate.php';?>
<div class="main-content">    
    <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:725px">
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
						<h4 class="card-title"><strong class="text-primary"> Alterar Dados de Cadastrais</strong></h4>
                    <?php
                        $query = $conn->query("SELECT * FROM `users` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
                        $fetch = $query->fetch_array();
                    ?>
					<p class="category"><?php echo $fetch['funcao']?>, comfirme seus dados antes de salvar:</p>
                    
                    <div class = "col-md-10"style="min-height:850px">	
                        <form method = "POST" action = "alter_query_account.php" enctype = "multipart/form-data" autocomplete="off" onsubmit="edituser()">
                            <div class="card-foot">
                                <label><strong> Nome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['firstname']?>" name = "firstname" />
                            </div>
                            <div class="card-foot">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['lastname']?>" name = "lastname" />
                            </div>
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" id="email" class = "form-control" onblur="validateEmail()" value = "<?php echo $fetch['email']?>" name = "email" />
                                <span id="mail-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Telefone:</strong></label>
                                <?php $contactno = $fetch['contactno'];$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
                                <input type = "fone" id="fone" class = "form-control" onblur="validateFone()" value = "<?php echo $formatted_contactno?>" name = "contactno" />
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
                                <input type = "password" id="pwd" class = "form-control" placeholder="********" onblur="validateRx()" minlength="8" value = "" name = "password" required/>
                                <span id="pwd-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Confirmar Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" onblur="validatePdw()" value="" class = "form-control" name = "confirme" onblur="validatePdw()" required/>
                                <span id="pwd2-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button type="submit" name = "alter_query_account" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                        <?php require_once 'alter_query_account.php'?>
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