<?php
include("entete.php");
include("connect.php");
if (isset($_SESSION["prof_login"]))
	include("verifConnectProf.php");
elseif (isset($_SESSION["etud_login"]))
	include("verifConnectEtud.php");
$tests = $_POST["resultatid"];
if (isset($_SESSION["idFil"]))
	$idFil = $_SESSION["idFil"];
else 
	$idFil=-1;
//print_r($_SESSION);
unset($_SESSION["idFil"]);
$resultats = $_POST["resultat"];
$statut=$_SESSION["statut"];
$code=$mysqli->real_escape_string($_POST["code"]);
echo("<div class='termPython'>");
$nbOK=0;
$nbFail=0;
$nbPublic=0;
$insertions = "";
foreach ($tests as $i=>$idTest) {
	$insertions .= "($idFil,$id,$idTest,";
	$requete = "SELECT * FROM CASTEST WHERE id=$idTest";
	$test = $mysqli->query($requete)->fetch_assoc();
	$type = $test["type"];
	$entree = $test["entree"];
	$sortie = $test["sortie"];
	$resultat = $resultats[$i];
	$insertions .= "'$resultat','$entree','$sortie','$type'),";
	if ($resultat==$sortie){ 
		$couleur="green";
		$nbOK+=1;
	}else{
		$couleur="red";
		$nbFail+=1;
	}
	if ($type!=3){
		$nbPublic+=1; 
		echo(">>> ".$entree."<br/>".$resultat."<br/>"."<span style='color:$couleur'>#attendu : ".$sortie."</span><br/>");
	}
}
echo("</div>");
echo("<div>Nombre de tests réussis : $nbOK/".($nbOK+$nbFail)." (dont ".($nbOK+$nbFail-$nbPublic)." tests cachés)</div>");
if ($statut=="prof") {
	echo("<a class=lien href='voirQuestions.php'><span class='material-icons'>keyboard_return</span>Retourner aux questions</a>");
} elseif ($statut=="etudiant") {
	if  ($nbFail==0)  
		$etat = 1;
	else
		$etat = 0;
	$requete1 = "INSERT INTO REPONSES(filrouge,eleve,date,etat,code) VALUES ($idFil,$id,now(),$etat,'$code')";
	$requete2 = "INSERT INTO DETAILSREPONSES(fil,etudiant,castest,resultat,entree,sortie,type) VALUES ".substr($insertions,0,-1);
//	echo($requete1);
	echo("Résultats enregistrés, vous pourrez voir le détail et la correction sur la page d'accueil");
	$mysqli->query($requete1);
	$mysqli->query($requete2);
	echo("<center><form action=pdg_etud.php><button type=submit class=bouton><span class='material-icons'>home</span></button></form></center>");
}

include("piedepage.php");
?>

