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
        href="https://www.garbuio.com.br/wp-content/uploads/2021/08/cropped-favicon-270x270.png" />
 
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css"
    />
    <link rel="stylesheet" type = "text/css" href="css/stylelg.css" />
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
                              maxlength="7"
                              class="form-style"
                              placeholder="Insira seu usuário"
                              id="usuario"
                              autocomplete="on"
                            />
                            <i class="input-icon uil uil-user"></i>
                          </div>
                          <div class="form-group mt-2">
                            <input
                              type="password"
                              name="password"
                              class="form-style"
                              placeholder="Digite sua senha"
                              id="senha"
                              autocomplete="off"
                              required
                            />
                            <i class="input-icon uil uil-lock-alt"></i>
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
                          
                        <form method="POST" action="" id="form-cadastro">
                        <div class="labmsg">
                            Será enviado para seu endereço de email, as instruções sobre como restabelecer seu acesso.
                          </div>
                        <div class="form-group">
                          <input
                              type="text"
                              name="ra"
                              maxlength="7"
                              class="form-style"
                              placeholder="Insira seu usuário"
                              id="usuario"
                              autocomplete="on"
                            />
                          <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input
                            type="email"
                            name="logemail"
                            class="form-style"
                            placeholder="Digite seu email"
                            id="logemail"
                            autocomplete="on"
                          />
                          <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                          <input
                            type="text"
                            name="cpf"
                            class="form-style"
                            placeholder="Digite seu CPF"
                            id="cpf"
                            autocomplete="off"
                          />
                          <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <a href="#" style="color:black" class="btn mt-4">Enviar</a>
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
    <!-- partial -->
  </body>
<script src = "./js/jquery.js"></script>
<script src = "./js/bootstrap.js"></script>
<script src="./js/send_register.js"></script>

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
    // alert('Por favor, digite um número de 7 dígitos.');
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