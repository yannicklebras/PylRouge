<?php include("entete.php"); ?>

<?php
include("connect.php");
include("verifConnectProf.php");
$requete = "SELECT * FROM QUESTIONS WHERE enseignant=$id ORDER BY niveau,titre";

$questions = $mysqli->query($requete);

echo("<center><div>");
if ($questions->num_rows>0) {
	echo("<table class=tableau>");
	while ($question=$questions->fetch_assoc()) {
		$idQuestion = $question["id"];
		$requeteDejaTraitee = "SELECT * FROM REPONSES JOIN FILSROUGES ON REPONSES.filrouge = FILSROUGES.id WHERE FILSROUGES.question=$idQuestion";
		$nbDT = $mysqli->query($requeteDejaTraitee)->num_rows;
		$niveau = $question["niveau"];
		echo("<tr><td width=200px>".$question["titre"]."</td>
			  <td>".str_repeat("<span class='material-icons'>star</span>",$niveau).str_repeat("<span class='material-icons'>star_border</span>",5-$niveau)."</td>
			  <td style='height:40px;line-height:40px'>
			  <form action=actionQuestion.php style='display:inline' method=post>
				<input type=hidden value='editer' name='editer'>
				<input type=hidden value=$idQuestion name='idQuestion'>
				<button type=submit class='bouton'><div><span class='material-icons' style=".(($nbDT>0)?" 'width:5px'":"'margin-right:5px'").">edit</span>".(($nbDT>0)?"<sub><span class='material-icons' style='scale:0.7;position:relative;color:red' title='Attention la question a déjà été traitée par un étudiant'>priority_high</span></sub>":"")."</div></button>
			  </form>
			  <form action=actionQuestion.php style='display:inline' method=post>
				<input type=hidden value='voir' name='voir'>
				<input type=hidden value=$idQuestion name='idQuestion'>
				<button type=submit class='bouton'><span class='material-icons'>visibility</span></button>
			  </form>
			  <form action=actionQuestion.php style='display:inline' method=post>
				<input type=hidden value='supprimer' name='supprimer'>
				<input type=hidden value=$idQuestion name='idQuestion'>
				<button type=submit class='bouton'><span class='material-icons'>delete</span></button>
			  </form></td>");
	}
	echo("</table>");
}
?>
<form action=actionQuestion.php metod=post class=ajouter>
	<input type=hidden name=ajout value=1>
	<button type=submit class=bouton>
		<span class=ajouter>Ajouter une question <span class='material-icons'>add_circle_outline</span></span>
	</button>
</form>
</div>
</center>
<?php include("piedepage.php");?>		 
