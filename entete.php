<!DOCTYPE html>
<?php session_start();?>

<html>
<head>
<meta charset="UTF-8">
<TITLE>Fil Rouge Python</TITLE>
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
if (isset($_SESSION["prof_login"])) {
	echo "<div class='entete'>
		<a href='modifCompte.php'><span class='material-icons' style='vertical-align: text-top;'>perm_identity</span>".$_SESSION['nom']." ".$_SESSION["prenom"]."</a>
		<a href='pdg_prof.php'><span class='material-icons' style='vertical-align: text-top;'>home</span></a>
		<a href='connect_prof.php'><span class='material-icons' style='vertical-align: text-top;'>logout</span></a>
		</div> ";
}
?>
