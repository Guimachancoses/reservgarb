// 
//  * Trabalho - Web Site - Faculdade Einstein Limeira - 11/2022
//  *
//  *  Turma - 2º Semestre - TADS
//  *  Alunos: 
//  *          Guilherme Luiz Machado Machancoses - RA: 0005/22-1
//  *          Bruno dos Santos Gomes - RA: 0035/22-1
//  *          Carlos Danilo Alves de Souza - RA: 0322/22-1
//  

// Field validator functions
function validateFname() {
    var nome = document.getElementById('nome');    
    var nv = nome.value;    
    var cont = 0;
    
    // First-name, validator functions
    for (var i = 0; i < nv.length; i++){
        cont++;
    }
    if (cont > 0 && cont < 3 ){
        alert('Digite um nome válido');
        nome.style.background = "lightyellow";}

    if(nv == ""){
        alert('Preencha o campo nome');
        nome.style.background = "lightyellow";
        }else if (cont > 3)
        {nome.style.background = "white";}    
}

function validateLname() {
    var sobrenome = document.getElementById('sobrenome');
    var sv = sobrenome.value;
    var cont2 = 0;

    // Last-name, validator functions
    for (var c = 0; c < sv.length; c++){
        cont2++;
    }
    if (cont2 > 0 && cont2 < 3 ){
        alert('Digite um sobrenome válido');
        sobrenome.style.background = "lightyellow";}

    if(sv == ""){
        alert('Preencha o campo sobrenome');
        sobrenome.style.background = "lightyellow";
        }else if (cont2 > 3)
        {sobrenome.style.background = "white";}
}

function validateEmail() {
    var email = document.getElementById('email');
    var mail = email.value;
  
    var regx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    if (regx.test(mail)) {
      // Real-time email validation
      fetch('https://apilayer.net/api/check?access_key=PDesQtmsC490d0MPhMI6B0ToRjFI0Kit=' + mail)
        .then(response => response.json())
        .then(data => {
          if (data.format_valid && data.smtp_check) {
            email.style.background = 'white';
            return true;
          } else {
            alert('Por favor, insira um endereço de e-mail válido.');
            email.style.background = 'lightyellow';
            return false;
          }
        });
    } else {
      alert('Por favor, insira um endereço de e-mail válido.');
      email.style.background = 'lightyellow';
      return false;
    }
  }
  

// Fone function
function validateFone(){
    var fone = document.getElementById('fone');
    var s = (fone.value).replace(/\D/g, '');
    var tam = (s).length; // removendo os caracteres não numéricos

    if(fone.value == '') {
        alert("Preencha o campo telefone"); // se quiser mostrar o erro
        fone.style.background="lightyellow";
        fone.select(); // se quiser selecionar o campo enviado
        return false;
    }	
	// Elimina CPFs invalidos conhecidos	
	if (s.length != 11 || 
		s == "00000000000" || 
		s == "11111111111" || 
		s == "22222222222" || 
		s == "33333333333" || 
		s == "44444444444" || 
		s == "55555555555" || 
		s == "66666666666" || 
		s == "77777777777" || 
		s == "88888888888" || 
		s == "99999999999"){
        alert("'" + s + "' Não é um telefone Válido!"); // se quiser mostrar o erro
        fone.style.background="lightyellow";
        fone.select(); // se quiser selecionar o campo enviado
        return false;
    }

        if (tam == 11) {
            fone.value = maskfone(s); // se validou o telefone mascaramos corretamente
            fone.style.background="white";
            return true;
        }else{
            alert("'" + s + "' Não é um telefone Válido!"); // se quiser mostrar o erro
            fone.style.background="lightyellow";
            fone.select(); // se quiser selecionar o campo enviado
            return false;    
        }

}
// Phone mask function
function maskfone(Fone) {
    return "("+ Fone.substring(0, 2) + ") " + Fone.substring(2, 7) + "-" + Fone.substring(7, 11);
}
   