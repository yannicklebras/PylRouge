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
$json = "";
while ($cas=$castest->fetch_assoc()) {
	$entree = $mysqli->real_escape_string($cas["entree"]);
	$sortie = $mysqli->real_escape_string($cas["sortie"]);
	$json .= "{\"id\":\"".$cas["id"]."\",\"type\":\"".$cas["type"]."\",\"entree\":\"$entree\",\"sortie\":\"$sortie\",\"resultat\":0},";
}
$json = "{\"cas\":[".substr($json,0,-1)."]}";
echo($json);
?>

