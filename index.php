<?php 
session_start();
session_destroy();
unset($_SESSION);
include("entete.php");?>

<center>
	<div class="tuile tuile-accueil"><a href="connect_prof.php" class="fill-div">Enseignant</a></div>
	<div class="tuile tuile-accueil"><a href="connect_etud.php" class="fill-div">Étudiant</a></div>
</center>
<?php include("piedepage.php");?>
