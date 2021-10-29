<?php
session_start();
include("connect.php");
include("verifConnectEtud.php");
if (isset($_POST["faire"])) {
	$_SESSION["idFil"]=$mysqli->real_escape_string($_POST["idFil"]);
	$requete = "SELECT question FROM FILSROUGES WHERE id=".$_SESSION["idFil"];;
//	echo($requete);
	$_SESSION["idQuestion"]=$mysqli->query($requete)->fetch_assoc()["question"];
	$_SESSION["statut"]="etud";
	header("Location: faireQuestion.php");
	exit;
}

if (isset($_POST["idReponse"])) {
	$idReponse = $_POST["idReponse"];
	$_SESSION["idReponse"] = $idReponse;
	header("Location: voirCR.php");
	exit;
}


