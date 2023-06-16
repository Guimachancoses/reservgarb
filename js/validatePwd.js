const pwd = document.getElementById("pwd");
const pwd2 = document.getElementById("pwd2");
var pwdError = document.getElementById("pwd-error");
var pwd2Error = document.getElementById("pwd2-error");

function validateRx() {
  var pwdv = pwd.value;

  const regx =
    /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/;

  if (regx.test(pwdv)) {
    pwd.style.background = "white";
    pwdError.textContent = "";
    return true;
  } else {
    pwdError.textContent =
      "* Sua senha deve conter pelo menos, 1 letra minúscula, 1 letra maiúscula,1 número, 1 caractere especial e ter pelo menos 8 caracteres.";
    pwd.style.background = "lightyellow";
    return false;
  }
}

function validatePwd(item) {
  item.setCustomValidity("");
  item.checkValidity();

  if (item == pwd2) {
    if (item.value === pwd.value) {
      item.setCustomValidity("");
      pwd2.style.background = "white";
      pwd2Error.textContent = "";
    } else {
      item.setCustomValidity("As senhas digitadas estão diferentes");
      pwd2Error.textContent = "As senhas digitadas estão diferentes";
      pwd2.style.background = "lightyellow";
    }
  }
}

// Solicita validação a cada alteração de entrada

pwd.addEventListener("input", function () {
  validatePwd(pwd);
});
pwd2.addEventListener("input", function () {
  validatePwd(pwd2);
});
