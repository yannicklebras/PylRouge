<?php 
session_start();
include("connect.php");
include("verifConnectProf.php");

if (isset($_POST["csvEleves"])) {
	$contenu = $mysqli->real_escape_string($_POST["csvEleves"]);
	$idClasse =$mysqli->real_escape_string($_POST["idClasse"]);
	$_SESSION["idClasse"]=$idClasse;
	$contenus = explode("\n",$contenu);
	$message = "";
	$nbAjout = 0;
	foreach ($contenus as $eleve) {
		$eleveDetails = explode(";",$eleve);
		$nb = count($eleveDetails);
		if ($nb>1) {
			$requete = "INSERT INTO ELEVES(nom,prenom,identifiant,mdp,classe) 
						VALUES ('".$eleveDetails[0]."','".$eleveDetails[1]."','".$eleveDetails[2]."',SHA2('".$eleveDetails[3]."',256),$idClasse)";
			$requeteVerif = "SELECT * FROM ELEVES WHERE identifiant = '$eleveDetails[2]' AND classe=$idClasse";
			$nbIdentique = $mysqli->query($requeteVerif)->num_rows;
			if ($nbIdentique>0) {
				$message = $message."<br/>Erreur lors de l'ajout de ".$eleveDetails[0]." ".$eleveDetails[1]." (".$eleveDetails[2].")";
			} else {
				echo($requete);
				$mysqli->query($requete);
				$nbAjout=$nbAjout+1;
			}
		}
	}
	$message = $message."<br/>Nombre d'élèves ajoutés : $nbAjout";
	$_SESSION["erreur"]=$message;
	//echo($message);
	header("Location: voirEleves.php");
}



if (isset($_POST["editer"])) {
	$idEleve = $mysqli->real_escape_string($_POST["idEleve"]);
	$requete="SELECT * FROM ELEVES WHERE id=$idEleve";
	$eleve = $mysqli->query($requete)->fetch_assoc();
	$nom = $eleve["nom"];
	$prenom = $eleve["prenom"];
	$identifiant = $eleve["identifiant"];
	$idClasse = $eleve["classe"];
	include("entete.php");
	echo("<div><form method=POST action=actionEleve.php>nom :    <input type=text name=nom value='$nom'><br/>
							    prenom : <input type=text name=prenom value='$prenom'><br/>
							    identifiant : <input type=text name=ident value = '$identifiant'><br/>
							    mot de passe : <input type=password name=mdp1 id=chMdp1><br/>
							    confirmer le mot de passe : <input type=password name=mdp2 id=chMdp2><span id=message></span><br/>
							    <input type=hidden name=idClasse value=$idClasse><input type=hidden name=idEleve value=$idEleve>
							    <input type=submit id=btnModif name=action value='modifier'>&nbsp;<input id=btnAnnul type=submit name=action value='annuler'>
		</form></div>");
	echo("<script language=javascript>
		$('#chMdp2, #chMdp1').on('keyup', function () {
  		if  ($('#chMdp1').val()!='')  {
        		if (($('#chMdp1').val() == $('#chMdp2').val())) {
                		$('#message').html('les mots de passe correspondent').css('color', 'green');
				$('#btnModif').prop('disabled',false);
        		} else {
                		$('#message').html('les mots de passe ne correspondent pas').css('color', 'red');
				$('#btnModif').prop('disabled',true);
        		} 
  		} else { 
    			$('#message').html('');
			$('#btnModif').prop('disabled',false);
  		}
		});
		</script>");



	include("piedepage.php");
}


if (isset($_POST['action'])) {
	$todo = $_POST["action"];
	if ($todo=="annuler") {
		$_SESSION["idClasse"]=$_POST["idClasse"];
		header("Location: voirEleves.php");
		exit;
	}
	$nom = $mysqli->real_escape_string($_POST["nom"]);
	$prenom = $mysqli->real_escape_string($_POST["prenom"]);
	$identifiant = $mysqli->real_escape_string($_POST["ident"]);
	$mdp = $mysqli->real_escape_string($_POST['mdp1']);
	$idClasse = $mysqli->real_escape_string($_POST['idClasse']);
	$idEleve = $mysqli->real_escape_string($_POST["idEleve"]);
	$requeteVerif = "SELECT * FROM ELEVES WHERE identifiant='$identifiant' AND classe='$idClasse' AND id<>$idEleve";
	$nb = $mysqli->query($requeteVerif)->num_rows;
	if (($nb>0) || ($identifiant=="")) {
		$_SESSION["idClasse"]=$idClasse;
		$_SESSION['erreur']="Erreur de mise à jour pour $nom $prenom ($identifiant)";
		header('Location: voirEleves.php');
		exit;
	}
	if ($mdp == '') 
		$requete ="UPDATE ELEVES SET nom='$nom', prenom = '$prenom', identifiant = '$identifiant' WHERE id=$idEleve";
	else 
		$requete ="UPDATE ELEVES SET nom='$nom', prenom = '$prenom', identifiant = '$identifiant', mdp=SHA2('$mdp',256) WHERE id=$idEleve";
	$mysqli->query($requete);
	$_SESSION["idClasse"]=$idClasse;
	header("Location: voirEleves.php");
}


if (isset($_POST["supprimer"])) {
	$idEleve = $mysqli->real_escape_string($_POST["idEleve"]);
	$requete = "SELECT * FROM ELEVES WHERE id=$idEleve";
	$eleve = $mysqli->query($requete)->fetch_assoc();
	$nom = $eleve["nom"];
	$prenom = $eleve["prenom"];
	$identifiant = $eleve["identifiant"];
	$idClasse = $eleve["classe"];
	include("entete.php");
	echo("<center><div>Êtes-vous certain de vouloir supprimer l'élève $nom $prenom ($identifiant) ? Vous perdrez toutes les données le concernant (fils rouges effetués, notes...).<br/>
			<form method=post action=actionEleve.php>
			<input type=hidden name=idEleve value=$idEleve><input type=hidden name=idClasse value=$idClasse>
			<input type=submit name=actionSuppr value=Oui><input type=submit name=actionSuppr value=Non></form>
		</div>
		</center>");
	include("piedepage.php");
}

if (isset($_POST["actionSuppr"])) {
	$todo = $mysqli->real_escape_string($_POST["actionSuppr"]);
	$idEleve = $mysqli->real_escape_string($_POST["idEleve"]);
	$idClasse = $mysqli->real_escape_string($_POST["idClasse"]);
	if ($todo=="Non") {
		$_SESSION["idClasse"]=$idClasse;
		header("Location: voirEleves.php");
		exit;
	}
	$requete = "DELETE FROM ELEVES WHERE id=$idEleve";
	$mysqli->query($requete);
	$_SESSION["idClasse"]=$idClasse;
	header("Location: voirEleves.php");
}
