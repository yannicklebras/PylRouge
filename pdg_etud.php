<?php
include("entete.php");
include("connect.php");
include("verifConnectEtud.php");
$idClasse = $_SESSION["idClasse"];
$requete="SELECT FILSROUGES.id as idFil, FILSROUGES.datedebut, FILSROUGES.datefin, QUESTIONS.id as idQuestion, QUESTIONS.titre ,
	IF(datedebut>now(),1,IF(datefin<now(),-1,0)) as etatQuestion, REPONSES.etat as etatReponse, REPONSES.date as dateReponse, REPONSES.id as idReponse
	FROM FILSROUGES 
	JOIN QUESTIONS ON FILSROUGES.question=QUESTIONS.id
	LEFT JOIN REPONSES ON filrouge=FILSROUGES.id AND REPONSES.eleve=$id 
	WHERE classe=$idClasse ORDER BY datefin";

$filsrouges=$mysqli->query($requete);
echo("<center><table class=tableauFR>");
echo("<thead><tr><th>Titre</th><th>Date début</th><th>Date fin</th><th>Etat</th><th>Compte rendu</th></tr></thead><tbody>");
while ($fil = $filsrouges->fetch_assoc()) {
	$idFil = $fil["idFil"];
	$datedebut = $fil["datedebut"];
	$datefin = $fil["datefin"];
	$idQuestion = $fil["idQuestion"];
	$titre = $fil["titre"];
	$etatQuestion = $fil["etatQuestion"];
	$etatReponse = $fil["etatReponse"];
	$dateReponse = $fil["dateReponse"];
	$idReponse = $fil["idReponse"];
	if ($etatQuestion==-1) {
		echo("<tr class=questionPassee><td>$titre</td><td>$datedebut</td><td>$datefin</td><td>".(($etatReponse=="")?"non traité":(($etatReponse==1)?"réussi<br>($dateReponse)":"non validé<br>($dateReponse)"))."</td><td>");
		if ($etatReponse!="") 
			echo("<form method=POST action=actionEtud.php><input type=hidden value=$idReponse name=idReponse><button type=submit class=bouton><span class='material-icons'>summarize</span></button></form>");
		echo("</td></tr>");

	} elseif ($etatQuestion==1) 
		echo("<tr class=questionFuture><td>À venir</td><td>$datedebut</td><td>$datefin</td><td>non traité</td><td></td></tr>");
	else  {
		if ($etatReponse == "") 
			echo("<tr class=questionActuelle><td>$titre</td><td>$datedebut</td><td>$datefin</td><td>
				<form action=actionEtud.php method=post>
					<input type=hidden value=$idFil name=idFil>
					<button class=bouton type=submit name=faire value=faire>
						<span class='material-icons'>play_arrow</span>
					</button>
				</form></td><td></td></tr>");
		else 
			echo("<tr class=questionAtuelleTraitee><td>$titre</td><td>$datedebut</td><td>$datefin</td><td>".(($etatReponse==1)?"réussi<br>($dateReponse)":"non validé<br>($dateReponse)")."</td>
				<td><form method=POST action=actionEtud.php><input type=hidden value=$idReponse name=idReponse><button type=submit class=bouton><span class='material-icons'>summarize</span></button></form></td></tr>");
	}
}
echo("</tbody></table></center>");

include("piedepage.php");
?>
