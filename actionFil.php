<?php
session_start();
include("connect.php");
if (!isset($_POST["valider"])) {
	header("Location: index.php");
	exit;
}

$action=$mysqli->real_escape_string($_POST["valider"]);

if ($action=="Annuler") {
	header("Location: voirClasses.php");
	exit();
} else {
//	print_r($_POST);
	$idClasse = $mysqli->real_escape_string($_POST["idClasse"]);
	$questions = $_POST["idQuestion"];
	$dates = $_POST["dates"];
//	print_r($dates);
	$utilisations = $_POST["utiliser"];
	$fils=$_POST["idFil"]; 
	foreach($questions as $i=>$idQuestion) {
		$idQuestion = $mysqli->real_escape_string($idQuestion);
		$idFil = $mysqli->real_escape_string($fils[$i]);
		$datedebutfin = $mysqli->real_escape_string($dates[$i]);
		$utilisation = $mysqli->real_escape_string($utilisations[$i]);
		$requete='';
		if ($utilisation==0 and $idFil!="") {
			$requete = "DELETE FROM FILSROUGES WHERE id=$idFil";
		} elseif ($utilisation==1 and $idFil!="") {
//			echo($idFil."!");
			$datesTab = explode(" - ",$datedebutfin);
//			print_r($datesTab);
			$datedebut = date_format(date_create_from_format("d/m/Y H:i",$datesTab[0]),"Y:m:d H:i:s");
			$datefin = date_format(date_create_from_format("d/m/Y H:i",$datesTab[1]),"Y:m:d H:i:s");
			$requete = "UPDATE FILSROUGES SET datedebut='$datedebut',datefin='$datefin' WHERE id=$idFil";
		} elseif ($utilisation==1) {
			$datesTab = explode(" - ",$datedebutfin);
			$datedebut = date_format(date_create_from_format("d/m/Y H:i",$datesTab[0]),"Y:m:d H:i:s");
			$datefin = date_format(date_create_from_format("d/m/Y H:i",$datesTab[1]),"Y:m:d H:i:s");
			$requete = "INSERT INTO  FILSROUGES(question,datedebut,datefin,classe) VALUES($idQuestion,'$datedebut','$datefin',$idClasse)";
		}
//		echo("<br>".$requete);
		if ($requete!="") 
			$mysqli->query($requete);
		$_SESSION["idClasse"]=$idClasse;
		header("Location: filRouge.php");
	}
}

?>
