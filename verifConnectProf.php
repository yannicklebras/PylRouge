<?php
if (!isset($_SESSION["token"])) {
	$_SESSION["erreur"]="Erreur de connexion";
	header("Location: connect_prof.php");
	exit;
	}
$token = $_SESSION["token"];
$requete = "SELECT * FROM TOKEN WHERE jeton='$token'";
$connexion = $mysqli->query($requete);
if ($connexion->num_rows<1) {
	$_SESSION["erreur"]="Erreur de connexion";
        header("Location: connect_prof.php");
        exit;
        }
$id = $connexion->fetch_assoc()["enseignant"];
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$statut = "prof";
?>

