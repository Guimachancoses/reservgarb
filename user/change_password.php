<!DOCTYPE html>
<?php
	require_once 'connect.php';
	require_once 'validate.php';

?>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
	<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
  />

  <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css"
  />

  <title>Reserve Garbuio</title>

  <link rel="icon" 
      type="image/jpg"
      href="../img/logo_title.png" />

  <link 
    rel="stylesheet" 
    type = "text/css" 
    href="../css/stylelg.css" ]
  />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<script>
        document.addEventListener("DOMContentLoaded", function () {
            var images = ["background_1.jpg", "background_2.jpg", "background_login.jpg","background_login5.jpg","background_login3.jpg"]; 
            var randomImage = images[Math.floor(Math.random() * images.length)];
            var imageUrl = "../img/" + randomImage; // Certifique-se de que o diretório esteja correto
            document.body.style.backgroundImage = "url(" + imageUrl + ")";
        });
    </script>
	<style>
		/* Estilo para posicionar o ícone do olho à direita */
		.input-wrapper {
		  position: relative;
		  display: inline-block;
		}
	
		.olho-wrapper {
		  position: absolute;
		  top: 50%;
		  right: 5px;
		  transform: translateY(-50%);
		  cursor: pointer;
		}
	  </style>
</head>
<body >

	<div id="loader-wrapper" style="padding-bottom:400px">
		<img style="padding-bottom:25px;padding-left:30px;display:flex;align-items:center;justify-content:center;z-index: 0;" src="../img/lg_garbuio2.png"></img>
		<div style="display:flex;align-items:center;justify-content:center;opacity:0.9;color:white;letter-spacing: 2px;"><p><strong>Olá solicitamos que você crie</strong></p></div>
		<div style="padding-top: 0px;;display:flex;align-items:center;justify-content:center;opacity:0.9;color:white;letter-spacing: 2px;"><p><strong>uma nova senha!</strong></p></div>
		<div class="center-wrap">
			<form id="meuFormulario" method="POST" action="change_password_query.php" enctype = "multipart/form-data">
			  <div class="section text-center">
				<div class="" align="left">
				</div>
				</br>
				<div class="form-group mt-2">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
					<input type="password" name="password_old" class="form-style" placeholder="Digite sua senha antiga" id="pwd3" autocomplete="off" required/>
					<i class="input-icon uil uil-lock-alt"></i>
					<span class="olho-wrapper">
					  <img class="form-inline" style="padding: 5px;" id="olho3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
					</span>                          
				</div>
				<div class="form-group mt-2">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
					<input type="password" name="password_new" class="form-style" placeholder="Digite sua senha nova" id="pwd" autocomplete="off" required/>
					<i class="input-icon uil uil-lock-alt"></i>
					<span class="olho-wrapper">
					  <img class="form-inline" style="padding: 5px;" id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
					</span>                          
				</div>
				<div class="form-group mt-2">
				  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
				  <input type="password" name="password_conf" class="form-style" placeholder="Confirme sua senha" onblur="validatePdw()" id="pwd2" autocomplete="off" required/>
				  <i class="input-icon uil uil-lock-alt"></i>
				  <span class="olho-wrapper">
					<img class="form-inline" style="padding: 5px;" id="olho2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
				  </span>
				  <span id="pwd2-error" style="color: red; font-size: smaller;"></span>                          
				</div>
				  <button type="submit" name="change_password" id="submitBtn" style="color:black"class="btn mt-4" onclick="limparURL()">Acessar</button>
				<div id='mensagem'></div>
				  <p class="mb-2 mt-4 text-center">
				</p>
			  </div>
			</form>
			<?php require_once 'change_password_query.php'?>
		  </div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<!-- <script src="../js/main.js"></script> -->
	<script>
    // Função para alternar a visibilidade da senha no input
    $("#olho").click(function () {
      var input = $("#pwd");
      var tipo = input.attr("type");

      if (tipo === "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  </script>

	<script>
	// Verifica se a URL contém o parâmetro "mensagem"
	const urlParams = new URLSearchParams(window.location.search);
	const mensagem = urlParams.get('mensagem');

	if (mensagem) {
		// Adiciona a mensagem na div com ID "mensagem"
		document.getElementById("mensagem").innerHTML = `<label>${mensagem}</label>`;
	}

	// function limparURL() {
	// 	// Obtém a URL atual
	// 	let currentUrl = window.location.href;

	// 	// Encontra a posição do índice da string "index.php"
	// 	let indexPhpIndex = currentUrl.indexOf("index.php");

	// 	if (indexPhpIndex !== -1) {
	// 	// Remove tudo que está após "index.php" na URL
	// 	let newUrl = currentUrl.substring(0, indexPhpIndex + "index.php".length);

	// 	// Atualiza a URL sem recarregar a página
	// 	window.history.pushState({}, "", newUrl);
	// 	}
	// }
	// 
	</script>

	<script src = "../js/jquery.js"></script>
	<script src = "../js/bootstrap.js"></script>
	<script src="../js/eyesPwd.js"></script>
	<script src="../js/validatePwd.js"></script>

</body>
	
</html>
