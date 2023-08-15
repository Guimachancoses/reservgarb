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

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <title>Reserve Lab</title>

     <link rel="icon" 
        type="image/jpg"
        href="https://scontent.fcpq8-1.fna.fbcdn.net/v/t39.30808-6/328476839_904244333952155_2647975080732862430_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeFTl15UXEzg_5M_mkXUeo2FhL8UvCp3iAaEvxS8KneIBsT-xoZUE2Vlf9A6rZZootsRgjQ33X1-iZxGCAaSWvgb&_nc_ohc=bZq4bTH6s0gAX_RHhWa&_nc_ht=scontent.fcpq8-1.fna&oh=00_AfCThSnTT5trsoDKxGZO-PvXg-VGx6fKJOT2CRrp3Gd4jw&oe=6439D9E5" />
      
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	
	
	
	<!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  
<div class="wrapper">


        <div class="body-overlay"></div>