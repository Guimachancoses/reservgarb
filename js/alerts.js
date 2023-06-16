// Função para exibir mensagem de inserir ao usuário, não permitir confirmção com campos vazios
function adduser() {
  var firstName = document.getElementsByName("firstname")[0].value;
  var lastName = document.getElementsByName("lastname")[0].value;
  var userName = document.getElementsByName("username")[0].value;
  var funcao = document.getElementsByName("funcao")[0].value;
  var email = document.getElementsByName("email")[0].value;
  var fone = document.getElementsByName("contactno")[0].value;
  var cpf = document.getElementsByName("cpf")[0].value;
  var pwd = document.getElementsByName("password")[0].value;
  var pwd2 = document.getElementsByName("confirme")[0].value;

  if (
    firstName === "" ||
    lastName === "" ||
    userName === "" ||
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

  if (apiResponse === "Laboratório já existe") {
    // A API retornou a mensagem de laboratório existente, não exiba o alerta
    return;
  }

  alert("Laboratório inserido com sucesso!!!");
}

// Função para exibir mensagem de inserir a software, não permitir confirmção com campos vazios
function addsoft() {
  var nameSoft = document.getElementsByName("name")[0].value;
  var editor = document.getElementsByName("editor")[0].value;
  var version = document.getElementsByName("version")[0].value;
  var realesed = document.getElementsByName("realesed")[0].value;

  if (nameSoft === "" || editor === "" || version === "" || realesed === "") {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  alert("Software inserido com sucesso!!!");
}

// Função para exibir mensagem de inserir a disciplina, não permitir confirmação com campos vazios
function addsubj() {
  var nameDisp = document.getElementsByName("nm_disciplina")[0].value;
  var curso = document.getElementsByName("curso")[0].value;
  var semestre = document.getElementsByName("semestre")[0].value;
  var qtdUsers = document.getElementsByName("qtd_users")[0].value;
  var date = document.getElementsByName("date")[0].value;

  if (
    nameDisp === "" ||
    curso === "" ||
    semestre === "" ||
    qtdUsers === "" ||
    date === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return false;
  }

  // Verifica se a data é válida
  var isValidDate = validateDate(date);

  if (isValidDate) {
    alert("Disciplina inserida com sucesso!!!");
    return true;
  } else {
    return false;
  }
}

var dateLt = document.getElementById("dtletivo");
var dt = dtletivo.value;
var mailError = document.getElementById("dt-error");

function validateDate(date) {
  var hoje = new Date();
  var dnasc = new Date(date);

  var tempo = hoje.getFullYear() - dnasc.getFullYear();

  var m = hoje.getMonth() - dnasc.getMonth();
  if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
    tempo--;
  }

  if (tempo <= -5 || tempo > 2) {
    mailError.textContent = "Há algo errado com seu ano letivo.";
    dateLt.style.background = "lightyellow";
    return false;
  } else {
    mailError.textContent = ""; // Limpar mensagem de erro se a data estiver dentro do intervalo aceitável
    dateLt.style.background = ""; // Limpar cor de fundo se a data estiver dentro do intervalo aceitável
    return true;
  }
}

// Solicita validação a cada alteração de entrada
dateLt.addEventListener("input", function () {
  validateDate(dateLt);
});

// Função para exibir mensagem de inserir chamado, não permitir confirmção com campos vazios
function addcall() {
  var roomId = document.getElementsByName("room_id")[0].value;
  var categoriaId = document.getElementsByName("categora_id")[0].value;
  var assuntos = document.getElementsByName("assuntos")[0].value;
  var prioridadeid = document.getElementsByName("prioridade_id")[0].value;

  if (
    roomId === "" ||
    categoriaId === "" ||
    assuntos === "" ||
    prioridadeid === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  alert("Chamado aberto com sucesso!!!");
}

// Função para exibir mensagem de editar ao usuário, não permitir confirmção com campos vazios
function edituser() {
  var firstName = document.getElementsByName("firstname")[0].value;
  var lastName = document.getElementsByName("lastname")[0].value;
  var userName = document.getElementsByName("username")[0].value;
  var funcao = document.getElementsByName("funcao")[0].value;
  var email = document.getElementsByName("email")[0].value;
  var fone = document.getElementsByName("contactno")[0].value;
  var cpf = document.getElementsByName("cpf")[0].value;
  var pwd = document.getElementsByName("password")[0].value;
  var pwd2 = document.getElementsByName("confirme")[0].value;

  if (
    firstName === "" ||
    lastName === "" ||
    userName === "" ||
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

  if (isNaN(parseInt(capacity))) {
    // Campo "capacity" não é um número
    document.getElementById("capacity-error").textContent =
      "Apenas números são aceitos.";
    return false;
  }

  if (isNaN(parseInt(roomNo))) {
    // Campo "room_no" não é um número
    document.getElementById("no-error").textContent =
      "Apenas números são aceitos.";
    return false;
  }

  // Todos os campos estão preenchidos e "capacity" e "room_no" são números
  return true;
}

// Função para exibir mensagem de editar software, não permitir confirmção com campos vazios
function editsoft() {
  var nameSoft = document.getElementsByName("name")[0].value;
  var editor = document.getElementsByName("editor")[0].value;
  var version = document.getElementsByName("version")[0].value;
  var realesed = document.getElementsByName("realesed")[0].value;

  if (nameSoft === "" || editor === "" || version === "" || realesed === "") {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  alert("As alterações de software, foram feitas com sucesso!!!");
}

// Função para exibir mensagem de editar a disciplina, não permitir confirmção com campos vazios
function editsubj() {
  var nameDisp = document.getElementsByName("nm_disciplina")[0].value;
  var curso = document.getElementsByName("curso")[0].value;
  var semestre = document.getElementsByName("semestre")[0].value;
  var qtdUsers = document.getElementsByName("qtd_users")[0].value;
  var date = document.getElementsByName("date")[0].value;

  if (
    nameDisp === "" ||
    curso === "" ||
    semestre === "" ||
    qtdUsers === "" ||
    date === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return false;
  }

  // Verifica se a data é válida
  var isValidDate = validateDate(date);

  if (isValidDate) {
    alert("Disciplina editada com sucesso!!!");
    return true;
  } else {
    return false;
  }
}

var dateLt = document.getElementById("dtletivo");
var dt = dtletivo.value;
var mailError = document.getElementById("dt-error");

function validateDate(date) {
  var hoje = new Date();
  var dnasc = new Date(date);

  var tempo = hoje.getFullYear() - dnasc.getFullYear();

  var m = hoje.getMonth() - dnasc.getMonth();
  if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
    tempo--;
  }

  if (tempo <= -5 || tempo > 2) {
    mailError.textContent = "Há algo errado com seu ano letivo.";
    dateLt.style.background = "lightyellow";
    return false;
  } else {
    mailError.textContent = ""; // Limpar mensagem de erro se a data estiver dentro do intervalo aceitável
    dateLt.style.background = ""; // Limpar cor de fundo se a data estiver dentro do intervalo aceitável
    return true;
  }
}

// Solicita validação a cada alteração de entrada
dateLt.addEventListener("input", function () {
  validateDate(dateLt);
});

// Função para exibir mensagem de editar chamado, não permitir confirmção com campos vazios
function editcall() {
  var roomId = document.getElementsByName("room_id")[0].value;
  var categoriaId = document.getElementsByName("categora_id")[0].value;
  var assuntos = document.getElementsByName("assuntos")[0].value;
  var prioridadeid = document.getElementsByName("prioridade_id")[0].value;

  if (
    roomId === "" ||
    categoriaId === "" ||
    assuntos === "" ||
    prioridadeid === ""
  ) {
    // Um ou mais campos estão vazios, não exiba o alerta
    return;
  }

  alert("Chamado reaberto com sucesso!!!");
}

// Funções de confirmação
function confreserv() {
  alert("Reserva aprovada!!!");
}
