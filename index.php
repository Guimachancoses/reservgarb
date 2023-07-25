<!DOCTYPE html>
<?php require_once "login.php"?>
<?php require_once "connect.php"?>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserve Garbuio</title>

    <link rel="icon" 
        type="image/jpg" 
        href="./img/logo_title.png" />
 
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css"
    />
    <link rel="stylesheet" type = "text/css" href="css/stylelg.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
  <body>
    <!-- partial:index.partial.html -->
      <div class="container">
        <div class="row full-height justify-content-center">
          <div class="col-12 text-center align-self-center py-5">
            <div class="section pb-5 pt-5 pt-sm-2 text-center">
              <input
                class="checkbox"
                type="checkbox"
                id="reg-log"
                name="reg-log"
              />
              <label style="display:none" for="reg-log"></label>
              <div class="card-3d-wrap mx-auto">
                <div class="card-3d-wrapper">
                  <div class="card-front">
                    <div class="center-wrap">
                      <form method="POST" action="">
                        <div class="section text-center">
                          <div class="logoeinstein" align="left">
                          <img src="./img/lg_garbuio.png">
                          </div>
                          <div class="form-group">
                            <input
                              type="text"
                              name="ra"                              
                              class="form-style"
                              placeholder="Digite seu e-mail"
                              autocomplete="on"
                              required
                            />
                            <i class="input-icon uil uil-at"></i>
                          </div>
                          <div class="form-group mt-2">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                            <input
                              type="password"
                              name="password"
                              class="form-style"
                              placeholder="Digite sua senha"
                              id="pwd"
                              autocomplete="off"
                              required
                            />
                            <i class="input-icon uil uil-lock-alt"></i>
                            <span class="olho-wrapper">
                              <img class="form-inline" style="padding: 5px;" id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
                            </span>                          
                          </div>
                          <button name="login" style="color:black"class="btn mt-4">Acessar</button>
                          <div id='msgError'></div>
                          <p class="mb-2 mt-4 text-center">
                            <a href="#" class="link" id="reg-log" name="reg-log">Esqueceu sua senha?</a>
                          </p>
                        </div>
                      </form>
                      <?php require_once 'login.php'?>
                    </div>
                  </div>
                  
                  <div class="card-back">
                    <div class="center-wrap">
                      <div class="section text-center">
                        <div class="logoeinstein" align="left">
                            <img src="./img/lg_garbuio.png">
                          </div>
                          
                        <form method="POST" action="forgot_key.php" id="form-cadastro">
                        <div class="labmsg">
                            Será enviado para seu endereço de email, as instruções sobre como restabelecer seu acesso.
                          </div>
                        <div class="form-group">
                          <input
                              type="text"
                              name="cpf"
                              class="form-style"
                              placeholder="Digite seu CPF"
                              id="cpf"
                              onblur="validateCPF()"
                              autocomplete="off"
                            />
                          <i class="input-icon uil uil-user"></i>
                          <span id="cpf-error" style="color: red; font-size: smaller;"></span>
                        </div>
                        <div class="form-group mt-2">
                          <input
                            type="email"
                            name="email"
                            class="form-style"
                            placeholder="Digite seu e-mail"
                            id="email"
                            autocomplete="off"
                          />
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <button type="submit" name="forgot_key" style="color:black" class="btn mt-4">Enviar</button>
                        <div id='msgError'></div>
                        <p class="mb-0 mt-3 text-center" >
                          <a href="#" class="link" id="reg-log2" name="reg-log2">Entrar com sua conta!</a>
                        </p>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
    <!-- partial -->
  </body>
<script src = "./js/jquery.js"></script>
<script src = "./js/bootstrap.js"></script>
<script src = "./js/validateCpf.js"></script>
<script src="./js/eyesPwd.js"></script>

<script>

const forgotPasswordLink = document.querySelector('a#reg-log');

forgotPasswordLink.addEventListener('click', function(e) {
  e.preventDefault();
  const checkbox = document.querySelector('input#reg-log');
  checkbox.checked = true;
  checkbox.dispatchEvent(new Event('change'));
});

const forgotPasswordLink2 = document.querySelector('a#reg-log2');

forgotPasswordLink2.addEventListener('click', function(e) {
  e.preventDefault();
  const checkbox2 = document.querySelector('input#reg-log');
  checkbox2.checked = false;
  checkbox2.dispatchEvent(new Event('change'));
});


</script>
</html>