<?php
session_start();
include("connect.php");
include("verifConnectProf.php");
//print_r($_POST);
$reponses = $_POST["idReponses"];
$etats = $_POST["etats"];
$commentaires = $_POST["commentaires"];
$requete = "UPDATE REPONSES SET etat=?, commentaire=? WHERE id=?";
$maj_prepare = $mysqli->prepare($requete);
foreach($reponses as $i=>$idReponse) {
	$etat = $mysqli->real_escape_string($etats[$i]);
	$commentaire = $mysqli->real_escape_string($commentaires[$i]);
	//echo("idreponse $i: $idReponse<br>");
	if ($idReponse>=0){ 
//		print_r($maj_prepare);
//		echo("$etat - $commentaire - $idReponse");
		$maj_prepare->bind_param('isi',$etat,$commentaire,$idReponse);
		$maj_prepare->execute();
	}
}
header("Location: voirResultats.php");
?>
