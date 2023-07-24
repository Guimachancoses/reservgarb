<div class="main-content">    
        <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:610px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Recuperar Acesso</strong></h4>
                        <p class="category" style="display:flex;align-items:center;justify-content:center; background-color: #f4d7d3;  border-radius: 6px;  padding: 5px;  margin-bottom: 8px; color: #000000;">
                           Insira o seu endereço de e-mail, o "Código de verificação", sua nova senha e confirme. Após salvar as alterações volte ao "Login" e acesse com sua nova senha.
                           Depois de ultizar o "Código de verificação" ele espirará não sendo possível utiliza-lo novamente. 
                        </p>
                    <div class = "col-md-10"style="min-height:510px">	
                        <form method = "POST" action = "alter_query_pwd.php" autocomplete="off">
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input  type = "email" class = "form-control" onblur="validateEmail()" placeholder="Digite seu e-mail:" id="email" name = "email" autocomplete="off" required = required/>
                                <span id="mail-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Código de Verificação:</strong></label>
                                <input  type = "text" maxlength="8" class = "form-control" placeholder="Insira aqui seu código:" name = "codigo" autocomplete="off" required = required/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd" placeholder="********" minlength="8" value="" class = "form-control" name = "password" autocomplete="off" onblur="validateRx()" required = required/>
                                <span id="pwd-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Confirmar Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd2" placeholder="********" minlength="8" value="" class = "form-control" name = "confirme" autocomplete="off" onblur="validatePdw()" required = required/>
                                <span id="pwd2-error" style="color: red; font-size: smaller;"></span>
                                <img class = "form-inline" style = "cursor:pointer;padding:5px;float: right;" id="olho2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII="/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button name = "alter_query_pwd" onclick="editsuccess()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                    <?php require_once 'alter_query_pwd.php'?>
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
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('input[name="password"]').setAttribute("autocomplete", "new-password");
  });
</script>
