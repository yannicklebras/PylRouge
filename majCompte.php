<?php
session_start();
include("connect.php");
echo("bonjou");
if (isset($_SESSION["prof_login"])) {
	include("verifConnectProf.php");
	$chNom = $_POST["chNom"];
	$chPrenom = $_POST["chPrenom"];
	$chMdp = $_POST["chMdp1"];
	if ($chMdp=="") 
		$requete = "UPDATE ENSEIGNANTS set nom='$chNom', prenom='$chPrenom' WHERE id=$id";
	else 
		$requete = "UPDATE ENSEIGNANTS set nom='$chNom', prenom='$chPrenom', mdp=SHA2('$chMdp',256) WHERE id=$id";
	$_SESSION["nom"]=$chNom;
	$_SESSION["prenom"]=$chPrenom;
	$mysqli->query($requete);
	echo($requete);
	echo("ok");
}
?>

