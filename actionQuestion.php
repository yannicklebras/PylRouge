<?php
session_start();
include("connect.php");
include("verifConnectProf.php");
if (isset($_POST["editer"])) {
	echo("bonjour");
	$idQuestion = $mysqli->real_escape_string($_POST["idQuestion"]);
	$_SESSION["editQuestion"] = $idQuestion;
	header("Location: editQuestion.php");
	exit;
}

if (isset($_GET["ajout"])) {
	$idQuestion = -1;
	$_SESSION["editQuestion"] = $idQuestion;
	header("Location: editQuestion.php");
	exit;
}

if (isset($_POST["supprimer"])) {
	include("entete.php");
	$idQuestion = $mysqli->real_escape_string($_POST["idQuestion"]);
	$requete = "SELECT titre FROM QUESTIONS WHERE  id=$idQuestion";
	
	$titre = $mysqli->query($requete)->fetch_assoc()['titre'];
	echo("<center>Êtes-vous certain de vouloir supprimer la question '$titre' ?");
	echo("<form action=actionQuestion.php method=POST>
		<input type=hidden name=idQuestion value=$idQuestion>
		<input type=submit name=actionsuppr value=valider>
		<input type=submit name=actionsuppr value=annuler></form></center>");
	include("piedepage.php");
}

if (isset($_POST["actionsuppr"])) {
	$action = $mysqli->real_escape_string($_POST["actionsuppr"]);
	if ($action=="annuler") {
		header("Location: voirQuestions.php");
		exit;
	}
	$idQuestion = $mysqli->real_escape_string($_POST['idQuestion']);
	$requete1 = "DELETE FROM QUESTIONS WHERE id=$idQuestion";
	$requete2 = "DELETE FROM CASTEST WHERE question=$idQuestion";
	$mysqli->query($requete1);
	$mysqli->query($requete2);
	header("Location: voirQuestions.php");
}

if (isset($_POST["action"])) {
	if ($_POST["action"]=="annuler") {
		header("Location: voirQuestions.php");
		exit;
	}
//	print_r($_POST);
	$idQuestion = $mysqli->real_escape_string($_POST["idQuestion"]);
	$titre = $mysqli->real_escape_string($_POST["titre"]);
	$enonce = $mysqli->real_escape_string($_POST["enonce"]);
	$prerempli = $mysqli->real_escape_string($_POST["prerempli"]);
	$retour = $mysqli->real_escape_string($_POST["retour"]);
	$etoiles = $mysqli->real_escape_string($_POST["stars"]);
	$casType = $_POST["casType"];
	$casEntree = $_POST["casEntree"];
	$casSortie = $_POST["casSortie"];
	$corrige = $mysqli->real_escape_string($_POST["corrige"]);
	if ($idQuestion < 0) {
		$requeteNouv = "INSERT INTO QUESTIONS(titre,enonce,prerempli,correction,niveau,retour,enseignant) VALUES ('nouvelle question','','','',1,'',$id)";
		echo($requeteNouv);
		$mysqli->query($requeteNouv);
		$idQuestion  =$mysqli->insert_id;
	}
	$requete = "UPDATE QUESTIONS SET titre='$titre',enonce='$enonce', prerempli='$prerempli',retour='$retour',niveau=$etoiles,correction='$corrige' WHERE id=$idQuestion";
	echo($requete);
	$mysqli->query($requete);
	$requeteDel = "DELETE FROM CASTEST WHERE question='$idQuestion'";
	$mysqli->query($requeteDel);
	echo("bonjour");
	print_r($casType);
	foreach ($casType as $i => $type) {
		$type = $mysqli->real_escape_string($type);
		$entree = $mysqli->real_escape_string($casEntree[$i]);
		$sortie = $mysqli->real_escape_string($casSortie[$i]);
		$requeteIns = "INSERT INTO CASTEST(question,entree,sortie,type) VALUES ($idQuestion,'$entree','$sortie','$type')";
		$mysqli->query($requeteIns);
	}
	header("Location: voirQuestions.php");
	exit;
}


if (isset($_POST["voir"])) {
	$_SESSION["statut"]="prof";
	$_SESSION["idQuestion"]=$_POST["idQuestion"];
	header("Location: faireQuestion.php");
	exit;
}
