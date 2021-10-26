<!DOCTYPE html>
<?php session_start();?>

<html>
<head>
<meta charset="UTF-8">
<TITLE>pylrouge - Fil Rouge Python</TITLE>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;700&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php 

setlocale(LC_TIME, 'fr_FR.UTF-8');
date_default_timezone_set('Europe/Paris');

if (isset($_SESSION["prof_login"])) {
	echo "<div class='entete'>
		<div style='display:inline-block;width:90px'><img width='90px' src=logo.png></div>
		<div style='display:inline-block;width:820px;text-align:right'><a href='modifCompte.php'><span class='material-icons' style='vertical-align: text-top;'>perm_identity</span>".$_SESSION['nom']." ".$_SESSION["prenom"]."</a>
		<a href='pdg_prof.php'><span class='material-icons' style='vertical-align: text-top;'>home</span></a>
		<a href='connect_prof.php'><span class='material-icons' style='vertical-align: text-top;'>logout</span></a></div>
		</div><div id=principal> ";

}elseif (isset($_SESSION["etud_login"])) {
	echo "<div class='entete'>
		<div style='display:inline-block;width:90px'><img width='90px' src=logo.png></div>
		<div style='display:inline-block;width:820px;text-align:right'><a href='modifCompte.php'><span class='material-icons' style='vertical-align: text-top;'>perm_identity</span>".$_SESSION['nom']." ".$_SESSION["prenom"]."</a>
		<a href='pdg_etud.php'><span class='material-icons' style='vertical-align: text-top;'>home</span></a>
		<a href='connect_etud.php'><span class='material-icons' style='vertical-align: text-top;'>logout</span></a></div>
		</div><div id=principal> ";

}else{
	echo "<div class='entete'>
		<div style='display:inline-block;width:90px'><img width='90px' src=logo.png></div>
		<div style='display:inline-block;width:820px;text-align:right'></div>
		</div><div id=principal> ";

}



?>
