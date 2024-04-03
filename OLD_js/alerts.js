// Função para exibir mensagem de inserir ao usuário, não permitir confirmção com campos vazios
function adduser() {
  var firstName = document.getElementsByName("firstname")[0].value;
  var lastName = document.getElementsByName("lastname")[0].value;
  var funcao = document.getElementsByName("funcao")[0].value;
  var email = document.getElementsByName("email")[0].value;
  var fone = document.getElementsByName("contactno")[0].value;
  var cpf = document.getElementsByName("cpf")[0].value;
  var pwd = document.getElementsByName("password")[0].value;
  var pwd2 = document.getElementsByName("confirme")[0].value;

  if (
    firstName === "" ||
    lastName === "" ||
    funcao === "" ||
    email === "" ||
    fone === "" ||
    cpf === "" ||
    pwd === "" ||
    pwd2 === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  if (apiResponse === "Usuário já inserido no sistema.") {
    // A API retornou a mensagem de laboratório existente, não exiba o alerta
    return;
  }

  alert("Usuário inserido com sucesso!!!");
}

// Função para exibir mensagem de inserir ao laboratório, não permitir confirmção com campos vazios
function addroom() {
  var roomType = document.getElementsByName("room_type")[0].value;
  var capacity = document.getElementsByName("capacity")[0].value;
  var roomNo = document.getElementsByName("room_no")[0].value;

  if (roomType === "" || capacity === "" || roomNo === "") {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  if (apiResponse === "Sala já existe") {
    // A API retornou a mensagem de laboratório existente, não exiba o alerta
    return;
  }

  alert("Sala inserido com sucesso!!!");
}

// Função para exibir mensagem de editar ao usuário, não permitir confirmção com campos vazios
function edituser() {
  var firstName = document.getElementsByName("firstname")[0].value;
  var lastName = document.getElementsByName("lastname")[0].value;
  var funcao = document.getElementsByName("funcao")[0].value;
  var email = document.getElementsByName("email")[0].value;
  var fone = document.getElementsByName("contactno")[0].value;
  var cpf = document.getElementsByName("cpf")[0].value;
  var pwd = document.getElementsByName("password")[0].value;
  var pwd2 = document.getElementsByName("confirme")[0].value;

  if (
    firstName === "" ||
    lastName === "" ||
    funcao === "" ||
    email === "" ||
    fone === "" ||
    cpf === "" ||
    pwd === "" ||
    pwd2 === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  alert("As alterações de usuário, foram feitas com sucesso!!!");
}

function editroom() {
  var roomType = document.getElementsByName("room_type")[0].value;
  var capacity = document.getElementsByName("capacity")[0].value;
  var roomNo = document.getElementsByName("room_no")[0].value;

  if (roomType === "" || capacity === "" || roomNo === "") {
    // Um ou mais campos estão vazios, não exiba o alerta
    return false;
  }

  alert("As alterações da sala, foram feitas com sucesso!!!");
  return true;
}

// Funções de confirmação
function confreserv() {
  alert("Reserva aprovada!!!");
}
