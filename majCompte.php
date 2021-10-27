<?php
session_start();
include("connect.php");
//echo("bonjour");
//print_r($_SESSION);
//print_r($_POST);
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
//	echo($requete);
//	echo("ok");
	header("Location: pdg_prof.php");
}
if (isset($_SESSION["etud_login"])) {
//	echo("bonjou");
//	print_r($_SESSION);	
	include("verifConnectEtud.php");
	$chNom = $_POST["chNom"];
	$chPrenom = $_POST["chPrenom"];
	$chMdp = $_POST["chMdp1"];
	if ($chMdp=="") 
		$requete = "UPDATE ELEVES set nom='$chNom', prenom='$chPrenom' WHERE id=$id";
	else 
		$requete = "UPDATE ELEVES set nom='$chNom', prenom='$chPrenom', mdp=SHA2('$chMdp',256) WHERE id=$id";
	$_SESSION["nom"]=$chNom;
	$_SESSION["prenom"]=$chPrenom;
	$mysqli->query($requete);
//	echo($requete);
//	echo("ok");
	header("Location: pdg_etud.php");
}
?>
