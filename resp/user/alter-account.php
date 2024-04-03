<?php require_once 'validate.php';?>
<div class="main-content">    
        <div class="row">
			<div class="col-lg-7">
				<div class="card" style="min-height:625px">
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Alterar Dados de Cadastro</strong></h4>
                            <p class="category" style="display:flex;align-items:center;justify-content:center; background-color: #f4d7d3;  border-radius: 6px;  padding: 5px;  margin-bottom: 8px; color: #000000;">
                            Para alterar o nome ou sobrenome, solicite ao administrador do sistema.</p>
						    <p class="category">Confirme seus dados antes de salvar:</p>
                    <?php
                        $query = $conn->query("SELECT * FROM `users` WHERE `users_id` = '$_SESSION[users_id]'") or die(mysqli_error($conn));
                        $fetch = $query->fetch_array();
                    ?>
                    <p id='mensagem' class="mb-1 mt-2 text-center"></p>
                    <div class = "col-md-8" style="min-height:625px">	
                        <form method = "POST" action = "alter_query_account.php?users_id=<?php echo $_SESSION['users_id']?>" enctype = "multipart/form-data" autocomplete="off" onsubmit="edituser()">
                            <div class="card-foot">
                                <label><strong> Nome:</strong></label>
                                <input  type = "text" class = "form-control" value = "<?php echo $fetch['firstname']?>" name = "firstname" disabled/>
                            </div>
                            <div class="card-foot">
                                <label><strong> Sobrenome:</strong></label>
                                <input type = "text" class = "form-control" value = "<?php echo $fetch['lastname']?>" name = "lastname" disabled/>
                            </div>
                            <div class="card-foot">
                                <label><strong> E-mail:</strong></label>
                                <input type = "email" class = "form-control" value = "<?php echo $fetch['email']?>" id="email" onblur="validateEmail()" placeholder="exemplo@mail.com.br" name = "email" required = required disabled/>
                                <span id="mail-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Telefone:</strong></label>
                                <?php $contactno = $fetch['contactno'];$formatted_contactno = '(' . substr($contactno, 0, 2) . ') ' . substr($contactno, 2, 5) . '-' . substr($contactno, 7);?>
                                <input type = "fone" class = "form-control" value = "<?php echo $formatted_contactno?>" name = "contactno" />
                                <span id="fone-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Senha:</strong></label>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                                <input type="password" id="pwd" placeholder="********" minlength="8" value="" class = "form-control" name = "password" required = required/>
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
                                <button name = "alter_query_account" onclick="editsuccess()" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
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
<script>
    // Verifica se a URL contém o parâmetro "mensagem"
    const urlParams = new URLSearchParams(window.location.search);
    const mensagem = urlParams.get('mensagem');

    if (mensagem) {
        // Adiciona a mensagem na div com ID "mensagem"
        document.getElementById("mensagem").innerHTML = `<label style="color:#ffff00;">${mensagem}</label>`;
    }
</script>   