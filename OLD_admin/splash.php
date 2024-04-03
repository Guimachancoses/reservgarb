<!DOCTYPE html>
<html class="no-js">
<?php
	require_once 'connect.php';
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/main.css">
	<title>Reserve Garbuio</title>

  	<link rel="icon" 
      type="image/jpg"
      href="../img/logo_title.png" 
	  />
	<script>
        document.addEventListener("DOMContentLoaded", function () {
            var images = ["background_1.jpg", "background_2.jpg", "background_login.jpg","background_login5.jpg","background_login3.jpg","background_login6.jpg","background_login100.jpg","background_login101.jpg","background_login103.jpg","background_login104.jpg","background_login106.jpg","background_login107.jpg"]; // Coloque o nome das suas imagens aqui
            var randomImage = images[Math.floor(Math.random() * images.length)];
            var imageUrl = "../img/" + randomImage; // Certifique-se de que o diretório esteja correto
            document.body.style.backgroundImage = "url(" + imageUrl + ")";
        });
    </script>
</head>
<body >

	<div id="loader-wrapper" style="padding-bottom:40px">
		<img style="padding-bottom:25px;padding-left:30px;display:flex;align-items:center;justify-content:center;z-index: 0;" src="../img/lg_garbuio2.png"></img>
		<div style="display:flex;align-items:center;justify-content:center;opacity:0.9;color:white;letter-spacing: 2px;"><h2><strong>Reserve Garbuio</strong></h3></div>
		<div id="loader"></div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="../js/main.js"></script>

</body>
</html>
