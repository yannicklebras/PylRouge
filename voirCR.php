<?php
include("entete.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/idea.min.css" integrity="sha512-Rfc5zQIp95eozfMCdS3B4MItUxU8orNje/t1OEhf7XwIk0DTCuMH2LG0NIgP8UGYK9L39WfUNI1c4IsM5yY/PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.2.0/markdown-it.min.js" integrity="sha512-cTQeM/op796Fp1ZUxfech8gSMLT/HvrXMkRGdGZGQnbwuq/obG0UtcL04eByVa99qJik7WlnlQOr5/Fw5B36aw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script language=javascript>
window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']]
  }
};

</script>



<?php
include("connect.php");
include("verifConnectEtud.php");
if (!isset($_SESSION["idReponse"])) {
	header("Location: pdg_etud.php");
	exit;
}
$idReponse = $_SESSION["idReponse"];
$requete1 = "SELECT * FROM REPONSES where id=$idReponse	";
$reponse = $mysqli->query($requete1)->fetch_assoc();
$idFil = $reponse["filrouge"];
$requete2 = "SELECT FILSROUGES.datedebut,FILSROUGES.datefin,IF(datefin<now(),1,0) as estPasse,QUESTIONS.enonce,QUESTIONS.correction,QUESTIONS.titre,QUESTIONS.retour FROM FILSROUGES JOIN QUESTIONS on QUESTIONS.id=FILSROUGES.question
		WHERE FILSROUGES.id=$idFil";
$donneesQuestion = $mysqli->query($requete2)->fetch_assoc();
$titre = $donneesQuestion["titre"];
$datedebut = strftime('%A %d %B %Y, %H:%M',date_create_from_format("Y-m-d H:i:s",$donneesQuestion["datedebut"])->getTimestamp());
$datefin = strftime('%A %d %B %Y, %H:%M',date_create_from_format("Y-m-d H:i:s",$donneesQuestion["datefin"])->getTimestamp());
$dateEtud = strftime('%A %d %B %Y, %H:%M',date_create_from_format("Y-m-d H:i:s",$reponse["date"])->getTimestamp());
$estPasse = $donneesQuestion["estPasse"];
$enonce = $donneesQuestion["enonce"];
$correction = $donneesQuestion["correction"];
$retour = $donneesQuestion["retour"];
$codeEtud = $reponse["code"];

$requete3 = "SELECT * FROM DETAILSREPONSES 
		WHERE fil=$idFil AND etudiant=$id ORDER BY type";
$reponsesTests = $mysqli->query($requete3);


echo("<h2>$titre</h2>\n");
echo("Question ouverte du $datedebut au $datefin, traitée le $dateEtud.<br>");
echo("<div id=enonce></div><div style='display:none' id=enonceFantome><textarea>$enonce</textarea></div>");
echo("<center><table id=tableauCodes><thead><tr><th style='width:400px'>Votre proposition</th><th style='width:400px'>La proposition de correction</th></tr>");
echo("<tr><td>```Python\n$codeEtud\n```</td><td>".(($estPasse==1)?"```Python\n$correction\n```":"La correction s'affichera après la clôture de la question")."</td></tr></table></center>");
echo("<div id=retour></div><div style='display:none' id=retourFantome><textarea>".(($estPasse==1)?$retour:"Le commentaire sera affiché après la clôture de la question")."</textarea></div>");
echo("<h3>Votre réussite aux tests<h3>");
echo("<div class=termPython>");
while ($cas=$reponsesTests->fetch_assoc()) {
	$entree = $cas["entree"];
	$sortie = $cas["sortie"];
	$reponseEtud = $cas["resultat"];
	$type = $cas["type"];
	if ($reponseEtud==$sortie) 
		$couleur="green";
	else
		$couleur="red";
	if ($type!=3 || $estPasse==1)
		echo(">>> $entree<br>$reponseEtud<br><span style='color:$couleur'>#Reponse attendue :$sortie</span><br>");
}
echo("</div>");
if ($estPasse==0)
	echo("<center>Les résultats aux tests cachés apparaîtront après la clôture de la question</center>");

?>
<script language=javascript>
md = new window.markdownit({
                        highlight: function (str, lang) {
                                if (lang && hljs.getLanguage(lang)) {
                                        try {
                                                return hljs.highlight(str, { language: lang }).value;
                                        } catch (__) {}
                                }
                                return ''; // use external default escaping
                        }
                });

$(document).ready(function (){
	$("#tableauCodes").find("td").each(function() {
		$(this).html(md.render($(this).html()));
		});
	$("#enonce").html(md.render($("#enonceFantome").find("textarea").val()));
	$("#retour").html(md.render($("#retourFantome").find("textarea").val()));
	MathJax.typeset();
});
</script>
<?php
include("piedepage.php");




?>
