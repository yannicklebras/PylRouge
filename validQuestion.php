<?php
include("entete.php");
include("connect.php");
include("verifConnectProf.php");
$tests = $_POST["resultatid"];
$resultats = $_POST["resultat"];
echo("<div class='termPython'>");
$nbOK=0;
$nbFail=0;
$nbPublic=0;
foreach ($tests as $i=>$idTest) {
	$requete = "SELECT * FROM CASTEST WHERE id=$idTest";
	$test = $mysqli->query($requete)->fetch_assoc();
	$type = $test["type"];
	$entree = $test["entree"];
	$sortie = $test["sortie"];
	$resultat = $resultats[$i];
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
include("piedepage.php");
?>

