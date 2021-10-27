<?php
session_start();
include("connect.php");
//echo("connexion");
//print_r($_POST);
//exit;

if (isset($_POST["idProf"])) {
	$login = $mysqli->real_escape_string($_POST["idProf"]);
	$mdp = $mysqli->real_escape_string($_POST["mdpProf"]);
	$utilisateur = $mysqli->query("SELECT * FROM ENSEIGNANTS WHERE login='$login' AND mdp=SHA2('$mdp',256)");
	if ($utilisateur->num_rows<1) {
		$_SESSION["erreur"]="erreur de connection";
//		print_r($_SESSION);
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
//	echo("INSERT INTO TOKEN(enseignant,date,jeton) VALUES($id,now(),'$token')");
	$_SESSION["prof_login"]=$login;
	$_SESSION["token"]=$token;
	$_SESSION["nom"]=$nom;
	$_SESSION["prenom"] = $prenom;
	$_SESSION["statut"] = "prof";
	header('Location: pdg_prof.php');
}
if(isset($_POST["idEtud"])) {
	$login = $mysqli->real_escape_string($_POST["idEtud"]);
	$mdp = $mysqli->real_escape_string($_POST["mdpEtud"]);
	$classe="";
	if (isset($_POST["idClasse"])) {
		$mdp=$_SESSION["mdp"];
		unset($_SESSION["mdp"]);
		unset($_SESSION["idEtud"]);
		$classe=" AND classe=".$_POST["idClasse"];
	}
	$utilisateur = $mysqli->query("SELECT * FROM ELEVES WHERE identifiant='$login' AND mdp=SHA2('$mdp',256)$classe");
	if ($utilisateur->num_rows<1) {
		$_SESSION["erreur"]="erreur de connection";
		//print_r($_SESSION);
		header('Location: connect_etud.php');
		exit;
	}
	if ($utilisateur->num_rows>1) {
		$_SESSION["idEtud"]=$login;
		$_SESSION["mdp"]=$mdp;
		header("Location: verifClasseEtud.php");
		exit;
	}
	$utilisateur = $utilisateur->fetch_assoc();
	$id = $utilisateur["id"];
	$nom=$utilisateur["nom"];
	$prenom = $utilisateur["prenom"];
	$idClasse = $utilisateur["classe"];
	$token=bin2hex(openssl_random_pseudo_bytes(16));
	$requeteToken="INSERT INTO  TOKEN(etudiant,date,jeton) VALUES($id,now(),'$token')";
	$mysqli->query($requeteToken);
	$_SESSION["etud_login"]=$login;
	$_SESSION["token"]=$token;
	$_SESSION["nom"]=$nom;
	$_SESSION["prenom"]=$prenom;
	$_SESSION["idClasse"]=$idClasse;
	$_SESSION["statut"]="etudiant";
	header('Location: pdg_etud.php');
}
?>
