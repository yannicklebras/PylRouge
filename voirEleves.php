<?php include("entete.php");
include("connect.php");
include("verifConnectProf.php");

if (isset($_SESSION["idClasse"])) {
	$idClasse = $_SESSION["idClasse"];
	//unset($_SESSION["idClasse"]);
} else {
	$idClasse = $mysqli->real_escape_string($_POST["idClasse"]);
}
$requete = "SELECT * FROM ELEVES WHERE classe=$idClasse";
$eleves = $mysqli->query($requete);

echo("<center><div>");
echo("<p style='color:red'>");
echo $_SESSION["erreur"];
unset($_SESSION["erreur"]);
echo("</p>");
if ($eleves->num_rows>0) {
        echo("<table class=tableau>");
        while ($eleve=$eleves->fetch_assoc()) {
                $idEleve = $eleve["id"];
                echo("<tr><td style='min-width:150px'>".$eleve["nom"]."</td>
			  <td style='min-width:150px'>".$eleve["prenom"]."</td>
			  <td>".$eleve["identifiant"]."</td>
                          <td style='height:40px;line-height:40px'>
                          <form action=actionEleve.php style='display:inline' method=post>
                                <input type=hidden value='editer' name='editer'>
                                <input type=hidden value=$idEleve name='idEleve'>
                                <button type=submit class='bouton'><span class='material-icons'>edit</span></button>
                          </form>
                          <form action=actionEleve.php style='display:inline' method=post>
                                <input type=hidden value='supprimer' name='supprimer'>
                                <input type=hidden value=$idEleve name='idEleve'>
                                <button type=submit class='bouton'><span class='material-icons'>delete</span></button>
                          </form></td>");
        }
        echo("</table>");
}
?>
</div>
<div style="border:2px solid #ffe0b3;padding:10px;margin-top:10px;margin-bottom:10px;display:inline-block">
</p>Ajouter des élèves (format: nom;prenom;identifiant;mot de passe)<br/>
<form method="POST" action="actionEleve.php">
<input type=hidden value="<?php echo $idClasse;?>" name=idClasse>
<TEXTAREA PLACEHOLDER="Dupont;Martin;mdupont;abcd123!&#10;Legrand;Jean;jlegrand;1234abc!" STYLE="width:440px;height:90px" name=csvEleves></TEXTAREA><br/>
<button  type=submit class="bouton"><span class='material-icons'>add_circle_outline</span></button>
</form>
</div>
</CENTER>
<?php include("piedepage.php"); ?>
