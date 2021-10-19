<?php
session_start();
include("connect.php");
echo("connexion");
if (isset($_POST["idProf"])) {
	$login = $mysqli->real_escape_string($_POST["idProf"]);
	$mdp = $mysqli->real_escape_string($_POST["mdpProf"]);
	$utilisateur = $mysqli->query("SELECT * FROM ENSEIGNANTS WHERE login='$login' AND mdp=SHA2('$mdp',256)");
	if ($utilisateur->num_rows<1) {
		$_SESSION["erreur"]="erreur de connection";
		print_r($_SESSION);
		header('Location: connect_prof.php');
		exit;
	} 
	$utilisateur = $utilisateur->fetch_assoc();
	$id = $utilisateur["id"];
	$nom = $utilisateur["nom"];
	$prenom = $utilisateur["prenom"];
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	$mysqli->query("INSERT INTO TOKEN(enseignant,date,jeton) VALUES($id,now(),'$token')");
	echo("INSERT INTO TOKEN(enseignant,date,jeton) VALUES($id,now(),'$token')");
	$_SESSION["prof_login"]=$login;
	$_SESSION["token"]=$token;
	$_SESSION["nom"]=$nom;
	$_SESSION["prenom"] = $prenom;
	header('Location: pdg_prof.php');
}




?>
