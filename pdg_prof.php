<?php 
include("entete.php"); ?>
<?php 
include("connect.php");
include("verifConnectProf.php");
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$login = $_SESSION["prof_login"];
?>
<center>
<div class="tuile tuile-classes"><a href="voirClasses.php" class="fill-div">Classes</a></div>
<div class="tuile tuile-questions"><a href="voirQuestions.php" class="fill-div">Questions</a></div>
</center>
<?php include("piedepage.php"); ?>
