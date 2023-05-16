<?php
// Recebe os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

// Configurações do email
$para = 'guilherme.machancoses@gmail.com';
$assunto = 'Solicitação de cadastro';
$mensagem = "Nome: $nome\n" .
            "Email: $email\n" .
            "Mensagem: $mensagem\n";

// Envia o email
mail($para, $assunto, $mensagem);
?>

