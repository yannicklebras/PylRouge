<?php
include("entete.php");
include("connect.php");
$requete = "SELECT CLASSES.nom, CONCAT(ENSEIGNANTS.nom,ENSEIGNANTS.prenom) as prof, CLASSES.id 
		FROM ELEVES 
		JOIN CLASSES ON ELEVES.classe=CLASSES.id 
		JOIN ENSEIGNANTS ON ENSEIGNANTS.id=CLASSES.enseignant 
		WHERE ELEVES.identifiant = '".$_SESSION['idEtud']."' AND ELEVES.mdp=SHA2('".$_SESSION["mdp"]."',256)";
$choix = $mysqli->query($requete);
$select = "<SELECT name=idClasse>";
while($etudiant=$choix->fetch_assoc()) {
	$classe= $etudiant["nom"];
	$prof = $etudiant["prof"];
	$idClasse = $etudiant["id"];
	$select .="<OPTION VALUE=$idClasse>$classe ($prof)</OPTION>\n";
	}
$select.="</SELECT>";
echo("<FORM  METHOD=POST ACTION='identification.php'>Veuillez préciser votre classe : $select
		<input TYPE=HIDDEN NAME=idEtud VALUE='".$_SESSION['idEtud']."'>
		<INPUT TYPE=SUBMIT VALUE=Valider></FORM>");

include("piedepage.php");
?>
