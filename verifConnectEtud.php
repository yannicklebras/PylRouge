<?php
if (!isset($_SESSION["token"])) {
	$_SESSION["erreur"]="Erreur de connexion 1";
	header("Location: connect_etud.php");
	exit;
	}
$token = $_SESSION["token"];
$requete = "SELECT * FROM TOKEN WHERE jeton='$token' and etudiant>-1";
$connexion = $mysqli->query($requete);
if ($connexion->num_rows<1) {
	$_SESSION["erreur"]="Erreur de connexion 2";
        header("Location: connect_etud.php");
        exit;
        }
$id = $connexion->fetch_assoc()["etudiant"];
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$statut = "etudiant";
?>

