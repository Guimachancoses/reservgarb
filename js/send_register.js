function enviarCadastro(event) {
    event.preventDefault(); // impede o envio padrão do formulário
  
    const form = event.target; // obtém o formulário atual
  
    // obtém os valores dos campos do formulário
    const nome = form.elements.logname.value;
    const email = form.elements.logemail.value;
    const senha = form.elements.logpass.value;
  
    // envia uma solicitação para a API
    fetch('register_mail_query.php', {
      method: 'POST',
      body: JSON.stringify({ nome, email, senha }), // envia os dados como JSON
      headers: {
        'locai': 'application/json'
      }
    })
    .then(response => response.json()) // converte a resposta para JSON
    .then(data => {
      console.log(data); // faz algo com os dados da resposta
    })
    .catch(error => {
      console.error(error); // lida com possíveis erros
    });
  }
  
  