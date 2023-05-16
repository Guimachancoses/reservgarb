//--------------------------------------------------------------------------------------------------------------------------------------
// função para verificar se o cookie ainda está presente - caso não faça logout na conta
function verificarCookie() {
    if (!document.cookie.match(/^(.*;)?\s*sessao\s*=\s*[^;]+(.*)?$/)) {
      // o cookie não está mais presente, então faz uma requisição AJAX para destruir a sessão
      var xhr = new XMLHttpRequest();
      xhr.open('GET', './destroy_seccion.php', true);
      xhr.send();
    }
  }
  
  // chama a função de verificação a cada 5 segundos
  setInterval(verificarCookie, 5000);
  