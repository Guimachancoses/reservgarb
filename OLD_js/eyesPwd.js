// View password old

var senha3 = $('#pwd3');
var olho3= $("#olho3");

olho3.mousedown(function() {
  senha3.attr("type", "text");
});

olho3.mouseup(function() {
  senha3.attr("type", "password");
});
// para evitar o problema de arrastar a imagem e a senha continuar exposta
$( "#olho3" ).mouseout(function() { 
  $("#pwd3").attr("type", "password");
});

// View password

var senha = $('#pwd');
var olho= $("#olho");

olho.mousedown(function() {
  senha.attr("type", "text");
});

olho.mouseup(function() {
  senha.attr("type", "password");
});
// para evitar o problema de arrastar a imagem e a senha continuar exposta
$( "#olho" ).mouseout(function() { 
  $("#pwd").attr("type", "password");
});

// View Password confirmation

var senha2 = $('#pwd2');
var olho2= $("#olho2");

olho2.mousedown(function() {
  senha2.attr("type", "text");
});

olho.mouseup(function() {
  senha2.attr("type", "password");
});
// para evitar o problema de arrastar a imagem e a senha continuar exposta
$( "#olho2" ).mouseout(function() { 
  $("#pwd2").attr("type", "password");

  
});