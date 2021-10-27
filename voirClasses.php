<?php include("entete.php"); ?>

<?php
include("connect.php");
include("verifConnectProf.php");
$requete = "SELECT * FROM CLASSES WHERE enseignant=$id ORDER BY nom";

$classes = $mysqli->query($requete);

echo("<center><div>");
if ($classes->num_rows>0) {
	echo("<table class=tableau>");
	$requete_eleves = "SELECT COUNT(*) as nb FROM ELEVES where classe=?";
	$attente = $mysqli->prepare($requete_eleves);
	while ($classe=$classes->fetch_assoc()) {
		$idClasse = $classe["id"];
		$attente->bind_param("i",$idClasse);
		$attente->execute();
		$nbEleves = $attente->get_result()->fetch_assoc();
		$nbElevesClasse = $nbEleves["nb"];
		echo("<tr><td width=200px>".$classe["nom"]."</td>
			  <td style='height:40px;line-height:40px'>
			  <form action=voirEleves.php style='display:inline' method=post>
				<input type=hidden value='$idClasse' name='idClasse'>
				<input type=hidden name='afficherclasse'>
				<button type=submit class='bouton'><span class='material-icons'>groups</span>$nbElevesClasse</button>
			  </form>
			  <form action=actionClasse.php style='display:inline' method=post>
				<input type=hidden value='editer' name='editer'>
				<input type=hidden value=$idClasse name='idClasse'>
				<button type=submit class='bouton'><span class='material-icons'>edit</span></button>
			  </form>
			  <form action=actionClasse.php style='display:inline' method=post>
				<input type=hidden value='filRouge' name='filRouge'>
				<input type=hidden value=$idClasse name='idClasse'>
				<button type=submit class='bouton'><span class='material-icons' style='color:red'>cable</span></button>
			  </form>
			  <form action=actionClasse.php style='display:inline' method=post>
				<input type=hidden value='resultats' name='resultats'>
				<input type=hidden value=$idClasse name='idClasse'>
				<button type=submit class='bouton'><span class='material-icons'>grading</span></button>
			  </form></td>");
	}
	echo("</table>");
}
?>
<span class=ajouter>Ajouter une classe <a href="actionClasse.php?ajout"><span class='material-icons'>add_circle_outline</span></a></span>
</div>
</center>
<?php include("piedepage.php");?>		 
