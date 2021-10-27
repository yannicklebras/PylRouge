<?php
include("entete.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/idea.min.css" integrity="sha512-Rfc5zQIp95eozfMCdS3B4MItUxU8orNje/t1OEhf7XwIk0DTCuMH2LG0NIgP8UGYK9L39WfUNI1c4IsM5yY/PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.2.0/markdown-it.min.js" integrity="sha512-cTQeM/op796Fp1ZUxfech8gSMLT/HvrXMkRGdGZGQnbwuq/obG0UtcL04eByVa99qJik7WlnlQOr5/Fw5B36aw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include("connect.php");
$idClasse = $_SESSION["idClasse"];
$requete="SELECT FILSROUGES.id as idFil,datedebut,datefin,QUESTIONS.titre as titre,IF(datefin<now(),1,IF(datedebut<=now(),2,0)) as passe 
	FROM FILSROUGES JOIN QUESTIONS ON FILSROUGES.question=QUESTIONS.id WHERE classe=$idClasse ORDER BY datefin";
$etapes = $mysqli->query($requete);
$thead = "<th>";
$tbody = "<td><buton class='bouton gauche' type=button><span class='material-icons'>navigate_before</span></button></td>";
$i=0;
$iAff = 0;
while ($etape=$etapes->fetch_assoc()) {
	$datedebut=$etape["datedebut"];
	$datefin = $etape["datefin"];
	if (($etape["passe"]!=1) && ($iAff==0))
		$iAff=$i-1;
	$passe = $etape["passe"];
	if ($passe==1) 
		$etatQ = "Terminé";
	elseif ($passe==2) 
		$etatQ = "En cours";
	else 
		$etatQ = "À venir";
	$thead .="<th class='col-$i'>".$etape["titre"]."<br>$etatQ<br>$datedebut à $datefin</th>";
	$idFil = $etape["idFil"];
	$requete_reponses = "SELECT ELEVES.nom, ELEVES.prenom,REPONSES.id,REPONSES.code,REPONSES.etat,REPONSES.commentaire
				FROM ELEVES
				LEFT JOIN REPONSES ON REPONSES.eleve=ELEVES.id AND REPONSES.filrouge=$idFil
				WHERE ELEVES.classe=$idClasse
				ORDER BY nom,prenom ASC";
	$eleves = $mysqli->query($requete_reponses);
	$tbody .="<td class='col-$i'><form action=actionResultats.php method=POST><table class='tableau tabresult'>";
	while ($eleve = $eleves->fetch_assoc()) {
		$nom = $eleve["nom"];
		$prenom = $eleve["prenom"];
		$code = $eleve["code"];
		$etat = $eleve["etat"];
		$idReponse = $eleve["id"];
		$commentaire = $eleve["commentaire"];
		$selectnull = "";
		$selectv = "";
		$selectnv = "";
		if (is_null($etat)) 
			$etatVis="nom traité<input type=hidden name=etats[]>";
		else {
			(is_null($etat)?$selectnull=" selected":(($etat==1)?$selectv=" selected":$selectnv=" selected"));
			$etatVis = "<SELECT NAME=etats[]><option value=0 $selectnv>non validé</option><option value=1 $selectv>validé</option></select>";
		}
		$tbody.="<td><div class=nomprenom>$nom $prenom<input type=hidden value=".((is_null($idReponse))?"-1":$idReponse)." name=idReponses[]></div></td>
			<td class=code><div class=codeAff></div><div class=codeArea style='display:none'><textarea>```Python\n$code\n```</textarea></div></td><td>$etatVis</td><td><textarea ".(is_null($etat)?"style='display:none'":"")."name=commentaires[]>$commentaire</textarea></td>";
		$tbody.="</tr>";
	}
	$i += 1;
	$tbody.="</table><center><input type=submit value='Enregistrer les modifications'></center></form></td>";

}
echo("<center><table id=tableauGeneral><thead><tr>$thead<th></th></tr></thead><tbody><tr>$tbody<td><button type=button class='bouton droit'><span class='material-icons'>navigate_next</span></button></td></tr></tbody></table></center>");
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



var iActuel = <?php echo $iAff;?> ;
var iMax = <?php echo ($i-1);?>;
$(document).ready(function(){
	$("[class^='col-']").css("display","none");
	$(".col-<?php echo $iAff;?>").css("display","block");
	$("#tableauGeneral").find(".codeAff").each(function(){
		$(this).html(md.render($(this).siblings(".codeArea").find("textarea").val()));
	});
});

$(".droit").click(function() {
	if (iActuel<iMax) {
		$(".col-"+(iActuel)).css("display","none");
		iActuel = iActuel+1;
		$(".col-"+(iActuel)).css("display","block");
	}
})
$(".gauche").click(function() {
	if (iActuel>0) {
		$(".col-"+(iActuel)).css("display","none");
		iActuel = iActuel-1;
		$(".col-"+(iActuel)).css("display","block");
	}
})

</script>

<?php include("piedepage.php");?>
