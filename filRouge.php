<?php
include("entete.php");
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?php
include("connect.php");
include("verifConnectProf.php");
if (isset($_SESSION["idClasse"])) {
	$idClasse=$_SESSION["idClasse"];
	unset($_SESSION["idClasse"]);
} else {
	$idClasse=$mysqli->real_escape_string($_POST["idClasse"]);
}
//$_SESSION["idClasse"]=$idClasse;
?>
<center>
Attention, vous ne pouvez pas intervenir sur une question du fil rouge à laquelle un élève a déjà répondu.
<form method=post action=actionFil.php id=formulaire>
<input type=hidden value=<?php echo $idClasse;?> name=idClasse>
<table id=tabFilRouge class=tableau>
<?php

$requete = "SELECT  FILSROUGES.id as idFilrouge, QUESTIONS.id as idQuestion, QUESTIONS.titre, QUESTIONS.enonce, QUESTIONS.niveau,FILSROUGES.datedebut,FILSROUGES.datefin  
		FROM QUESTIONS 
		LEFT JOIN FILSROUGES
		ON FILSROUGES.question = QUESTIONS.id AND FILSROUGES.classe=$idClasse
		ORDER BY niveau,datedebut,datefin ASC";
//echo($requete);
$etapes = $mysqli->query($requete);


while ($etape=$etapes->fetch_assoc()) {
	$titre = $etape["titre"];
	$idQuestion = $etape["idQuestion"];
	$niveau = $etape["niveau"];
	$datedebut= date_format(date_create($etape["datedebut"]),"d/m/Y H:i");
	$datefin= date_format(date_create($etape["datefin"]),"d/m/Y H:i");
	$idFil = $etape["idFilrouge"];
	$bloquer="";
	if (!is_null($idFil)) {
	    $requete = "SELECT * FROM REPONSES WHERE filrouge=$idFil";
	    $nbDejaFaits = $mysqli->query($requete)->num_rows;
	    $bloquer = ($nbDejaFaits>0)?" disabled":"";
	}
	echo("<tr><td> <input type=hidden name=idQuestion[] value=$idQuestion>
			<input type=hidden name=idFil[] value=$idFil>
		 $titre</td>
		 <td>".str_repeat("<span class='material-icons'>star</span>",$niveau)."</td>
		 <td><input name=dates[] type='text' id=datetimes class='datetimes' style='width:200px' ".((is_null($idFil))?"value='' disabled":" value='$datedebut - $datefin' ")."$bloquer/></td>
		 <td><input type=hidden class='util' name=utiliser[] value=".((is_null($idFil))?"0":"1").">
		     <button type=button class='bouton check'$bloquer><span class='material-icons' style='color:".((is_null($idFil))?"red":"green")."'>".((is_null($idFil))?"event_busy":"event_available")."</span></button>
		     </td>
	     </tr>");
	}
?>
</table>
<div style="display:inline-block;text-align:left;width:49%"><input type=submit value="Annuler" name=valider></div>
<div style="display:inline-block;text-align:right;width:49%"><input type=submit value="Enregistrer les modifications" name=valider></div>
</center>
</form>



<script>
$(function() {
  $('.datetimes').daterangepicker({
    timePicker: true,
    timePicker24Hour: true,
    locale: {
      format: 'DD/MM/YYYY hh:mm'
    }
  });
});

$(function(){$(".check").click(function(){
		utiliser = $(this).siblings(".util").val();
		if (utiliser==1) {
			$(this).children().css("color","red");
			$(this).children().html("event_busy");
			$(this).siblings(".util").val("0");
			$(this).closest("tr").find(".datetimes").prop("disabled",true);
		} else {
			$(this).children().css("color","green");
			$(this).children().html("event_available");
			$(this).siblings(".util").val("1");
			$(this).closest("tr").find(".datetimes").prop("disabled",false);
		}	
		return false;
	});
});

$("#formulaire").submit(function() {
	$(this).find(".datetimes").prop("disabled",false);
	
});

</script>
<?php
include("piedepage.php");
?>
