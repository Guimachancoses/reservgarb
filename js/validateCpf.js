function validateCPF() {
  // recebe um objeto
  var obj = document.getElementById("cpf");
  var s = obj.value.replace(/\D/g, "");
  var tam = s.length; // removendo os caracteres não numéricos
  var cpfError = document.getElementById("cpf-error");

  // verifica se o valor contém apenas números
  if (!/^\d+$/.test(s)) {
    alert("Por favor, digite apenas números no campo.");
    this.value = "";
  }

  if (obj.value == "") {
    obj.style.background = "lightyellow";
    cpfError.textContent = "Preencha o campo CPF";
    return false;
  }
  // Elimina CPFs invalidos conhecidos
  if (s.length == 11) {
    if (
      s == "00000000000" ||
      s == "11111111111" ||
      s == "22222222222" ||
      s == "33333333333" ||
      s == "44444444444" ||
      s == "55555555555" ||
      s == "66666666666" ||
      s == "77777777777" ||
      s == "88888888888" ||
      s == "99999999999"
    ) {
      obj.style.background = "lightyellow";
      cpfError.textContent = "Não é um CPF válido!";
      return false;
    }
  }
  if (!(tam == 11 || tam == 14 || tam == 0)) {
    // validando o tamanho
    obj.style.background = "lightyellow";
    cpfError.textContent = "Não é um CPF ou um CNPJ válido!";
    return false;
  }

  // se for CPF
  if (tam == 11) {
    if (!validaCPF(s)) {
      // chama a função que valida o CPF
      obj.style.background = "lightyellow";
      cpfError.textContent = "Não é um CPF válido!";
      return false;
    }
    obj.value = maskCPF(s); // se validou o CPF mascaramos corretamente
    obj.style.background = "white";
    cpfError.textContent = "";
    return true;
  }

  // se for CNPJ
  if (tam == 14) {
    if (!validaCNPJ(s)) {
      // chama a função que valida o CNPJ
      obj.style.background = "lightyellow";
      cpfError.textContent = "Não é um CNPJ válido!";
      return false;
    }
    obj.value = maskCNPJ(s); // se validou o CNPJ mascaramos corretamente
    obj.style.background = "white";
    cpfError.textContent = "";
    return true;
  }
}

function validaCPF(s) {
  var c = s.substr(0, 9);
  var dv = s.substr(9, 2);
  var d1 = 0;
  for (var i = 0; i < 9; i++) {
    d1 += c.charAt(i) * (10 - i);
  }
  if (d1 == 0) return false;
  d1 = 11 - (d1 % 11);
  if (d1 > 9) d1 = 0;
  if (dv.charAt(0) != d1) {
    return false;
  }
  d1 *= 2;
  for (var i = 0; i < 9; i++) {
    d1 += c.charAt(i) * (11 - i);
  }
  d1 = 11 - (d1 % 11);
  if (d1 > 9) d1 = 0;
  if (dv.charAt(1) != d1) {
    return false;
  }
  return true;
}

function validaCNPJ(CNPJ) {
  var a = new Array();
  var b = new Number();
  var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
  for (i = 0; i < 12; i++) {
    a[i] = CNPJ.charAt(i);
    b += a[i] * c[i + 1];
  }
  if ((x = b % 11) < 2) {
    a[12] = 0;
  } else {
    a[12] = 11 - x;
  }
  b = 0;
  for (y = 0; y < 13; y++) {
    b += a[y] * c[y];
  }
  if ((x = b % 11) < 2) {
    a[13] = 0;
  } else {
    a[13] = 11 - x;
  }
  if (CNPJ.charAt(12) != a[12] || CNPJ.charAt(13) != a[13]) {
    return false;
  }
  return true;
}
function maskCPF(CPF) {
  return (
    CPF.substring(0, 3) +
    "." +
    CPF.substring(3, 6) +
    "." +
    CPF.substring(6, 9) +
    "-" +
    CPF.substring(9, 11)
  );
}
function maskCNPJ(CNPJ) {
  return (
    CNPJ.substring(0, 2) +
    "." +
    CNPJ.substring(2, 5) +
    "." +
    CNPJ.substring(5, 8) +
    "/" +
    CNPJ.substring(8, 12) +
    "-" +
    CNPJ.substring(12, 14)
  );
}
