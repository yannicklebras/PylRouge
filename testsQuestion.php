<?php
session_start();
header('Content-Type: application/json');
include("connect.php");
if (isset($_SESSION["prof_login"])) 
	include("verifConnectProf.php");
elseif (isset($_SESSION["etud_login"]))
	include("verifConnectEtud.php");
$idQuestion = $mysqli->real_escape_string($_POST["idQuestion"]);
$requeteCas = "SELECT * FROM CASTEST WHERE question=$idQuestion";
$castest = $mysqli->query($requeteCas);
$liste  = array();
while ($cas=$castest->fetch_assoc()) {
	$entree = $cas["entree"];
	$sortie = $cas["sortie"];
	$json_array = array("id"=>$cas["id"],"type"=>$cas["type"],"entree"=>$entree,"sortie"=>$sortie,"resultat"=>0);
	array_push($liste,$json_array);
}
$json = array("cas"=>$liste);
echo(json_encode($json));
?>

