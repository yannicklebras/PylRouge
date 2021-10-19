<?php session_start(); ?>
<?php include("connect.php"); ?>
<?php include("verifConnectProf.php"); ?>
<?php 

if (isset($_GET["ajout"])) {
	include("entete.php");
	if (isset($_SESSION["erreur"])) {
		$message="<span style='color:red'>".$_SESSION["erreur"]."</span><br/>";
		unset($_SESSION["erreur"]);
	}
	echo("<center><div>$message<form action='actionClasse.php?ValAjout' method='post'>Nom de la classe à créer :<br/><input type=text name=nom><br/><input type=submit value='Créer la classe'></form></div></center>");
	include("piedepage.php");
}

if (isset($_GET["ValAjout"])) {
	$requete = "SELECT * FROM CLASSES WHERE nom='".$mysqli->real_escape_string($_POST['nom'])."' AND enseignant=$id";
	$nb = $mysqli->query($requete)->num_rows;
	if ($nb>0) {
		$_SESSION["erreur"]="Le nom ".$mysqli->real_escape_string($_POST['nom'])." est déjà pris";
		header('Location: actionClasse.php?ajout');
	} else {
		$requete = "INSERT INTO CLASSES(nom,enseignant) VALUES('".$mysqli->real_escape_string($_POST["nom"])."',$id)";
		echo($requete);
		$mysqli->query($requete);
		header("Location: voirClasses.php");
	}
}

if (isset($_POST["supprimer"])) {
	$idClasse = $mysqli->real_escape_string($_POST['idClasse']);
	$requete = "SELECT * FROM CLASSES WHERE id=$idClasse";
	$classe = $mysqli->query($requete)->fetch_assoc();
	$nom = $classe['nom'];
	include("entete.php");
	echo("<center><div>Voulez-vous vraiment supprimer la classe $nom ? Vous perdrez les élèves et les fils rouges programmés.<br/>
		<form action=actionClasse.php style='display:inline' method=post><input type=hidden value=$idClasse name=idClasse><input type=hidden name=ValSupprimer><input type=submit value=oui></form>
		<form action=actionClasse.php style='display:inline' method=post><input type=hidden name=AnnulSupprimer><input type=submit value=non></form>");
	include("piedepage.php");
}

if (isset($_POST["ValSupprimer"])) {
	$idClasse=$mysqli->real_escape_string($_POST['idClasse']);
	$requete = "DELETE FROM CLASSES WHERE id=$idClasse";
	$mysqli->query($requete);
	header("Location: voirClasses.php");
}

if (isset($_POST["AnnulSupprimer"])) {
	header("Location: voirClasses.php");
}

if (isset($_POST["editer"])) {
	include("entete.php");
	$idClasse=$mysqli->real_escape_string($_POST["idClasse"]);
	$requete = "SELECT * FROM CLASSES WHERE id=$idClasse";
	$classe = $mysqli->query($requete)->fetch_assoc();
	$nom = $classe["nom"];
	if (isset($_SESSION["erreur"])) {
		$message="<span style='color:red'>".$_SESSION["erreur"]."</span><br/>";
		unset($_SESSION["erreur"]);
	}
	echo("<center><div>$message<form action='actionClasse.php' method='post'><input type=hidden name=ValEditer><input type=hidden name=idClasse value=$idClasse>Nouveau nom de la classe :<br/><input type=text name=nom value='$nom'><br/><input type=submit value='Modifier le nom'></form></div></center>");
	include("piedepage.php");
}

if (isset($_POST['ValEditer'])) {
	$idClasse = $mysqli->real_escape_string($_POST["idClasse"]);
	$nom = $mysqli->real_escape_string($_POST["nom"]);
	$requete = "SELECT * FROM CLASSES WHERE enseignant=$id AND nom='$nom' AND id<>$idClasse";
	$nb = $mysqli->query($requete)->num_rows;
	if ($nb>0) {
		include("entete.php");
		$requete = "SELECT * FROM CLASSES WHERE id=$idClasse";
		$classe = $mysqli->query($requete)->fetch_assoc();
		$ancnom = $classe["nom"];
		echo("<center><div><span style='color:red'>Le nom $nom est déjà pris</span><br/><form action='actionClasse.php' method='post'><input type=hidden name=ValEditer><input type=hidden name=idClasse value=$idClasse>Nouveau nom de la classe :<br/><input type=text name=nom value='$ancnom'><br/><input type=submit value='Modifier le nom'></form></div></center>");
		include("piedepage.php");
		exit;
	}
	$requete = "UPDATE CLASSES SET nom='$nom' WHERE id=$idClasse";
	$mysqli->query($requete);
	header("Location: voirClasses.php");
}



?>

