<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="assets/css/profile.css">
	<link rel="stylesheet" type="text/css" href="assets/css/settings.css">
	<link rel="stylesheet" type="text/css" href="assets/css/settings_stud.css">
	<link rel="stylesheet" type="text/css" href="assets/css/themes.css">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


  	<script type="text/javascript" src="tableexp/libs/FileSaver/FileSaver.min.js"></script>
  	<script type="text/javascript" src="tableexp/libs/jsPDF/jspdf.min.js"></script>
	<script type="text/javascript" src="tableexp/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
	<script type="text/javascript" src="tableexp/tableExport.min.js"></script>

	<link rel="shortcut icon" href="assets/pictures/favicon.ico" type="image/x-icon">
	<link rel="icon" href="assets/pictures//favicon.ico" type="image/x-icon">

	<style>
   		body {
    	background: #dfeff2;
   }
  </style>
</head>
<body style="font-size: 14pt;">
	<header class="header_back">
		<div class="container">
			<div class="header_inner">
				<div class="logo">МАИ</div>
				<nav class="kaf">Кафедра 805</nav>
			</div>
		</div>
		<nav class="nav">
			<a class="nav_link" href="index.php">Главная</a>  
			<a class="nav_link" href="NIRS.php">Темы НИРС</a>  
			<a class="nav_link" href="VKR.php">Темы ВКР</a>
			<a class="nav_link" href="teachers.php">Преподаватели</a>
			<?php 
				if (isset($_SESSION["user_id_s"])) {
					echo "<a class='nav_link'; href='studentid{$_SESSION["user_id_s"]}''>Профиль</a>";
					echo "<a class='nav_link'; href='logout.php'>Выйти</a>";
				}
				else if (isset($_SESSION["user_id_p"])){
						echo "<a class='nav_link'; href='teacherid{$_SESSION["user_id_p"]}''>Профиль</a>";
						echo "<a class='nav_link'; href='logout.php'>Выйти</a>";
					} 
					else {
					echo "<a class='nav_link'; href='login.php'>Войти</a>";
				}
			?>
			
		</nav>
	</header>