<!doctype html>
<?php
  require_once 'connect.php';
	require_once 'validate.php';
	require_once 'name.php';
?>
<?php // tempo de expiração em segundos
	$tempo_expiracao = 420; 
	// cria um cookie com o nome 'sessao' e o valor '1234'
	setcookie('sessao', '1234', time() + $tempo_expiracao);?>
<html lang="pt-br">
  <head>

    <!-- timezone -->
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.0.1/build/global/luxon.min.js"></script>
 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <title>Reserve Garbuio</title>

    <link rel="icon" 
      type="image/jpg"
      href="../img/logo_title.png" />
      
    <!-- Calender CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
      
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!----css3---->
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/style-calender.css">

		<!--google fonts -->	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- calendar links -->
    <link rel="stylesheet" type="text/css" href="<?=$base_url?>../css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$base_url?>../css/calendar.css">
    <link href="<?=$base_url?>../css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?=$base_url?>../js/es-ES.js"></script>
    <script src="<?=$base_url?>../js/jquery.min.js"></script>
    <script src="<?=$base_url?>../js/moment.js"></script>
    <script src="<?=$base_url?>../js/bootstrap.min.js"></script>
    <script src="<?=$base_url?>../js/bootstrap-datetimepicker.js"></script>
    <script src="../js/updateLocation.js"></script>	
    <link rel="stylesheet" href="<?=$base_url?>../css/bootstrap-datetimepicker.min.css" />

	  <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
<body>
  
<div class="wrapper">

  <div class="body-overlay"></div>
  <script>
        // Função para limpar o console
        function limparConsole() {
            console.clear();
        }

        // Chamando a função de limpeza ao carregar a página
        window.onload = limparConsole;
    </script>