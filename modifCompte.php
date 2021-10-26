<?php 
include("entete.php"); 
include("connect.php");
if ($_SESSION["statut"]=="prof") 
	include("verifConnectProf.php"); 
elseif ($_SESSION["statut"]=="etudiant")
	include("verifConnectEtud.php");
$nom=$_SESSION["nom"];
$prenom=$_SESSION["prenom"];
//print_r($_SESSION);
?>
Modification de votre compte : 
<div><form name="modifCompteProf" action="majCompte.php" method="POST">
nom : <input type=text name=chNom value="<?php echo($nom);?>"><br/>
prénom : <input type=text name=chPrenom value="<?php echo($prenom);?>"><br/>
mot de passe : <input type=password id=chMdp1 name=chMdp1 value=""><br/>
confirmer le mot de passe : <input type=password id=chMdp2 name=chMdp2 value=""><span id=message></span><br/>
<input type=submit value="Enregistrer les modifications"> 
</form>
</div>



<script language=javascript>
$('#chMdp2, #chMdp1').on('keyup', function () {
  if  ($('#chMdp1').val()!="")  {
  	if (($('#chMdp1').val() == $('#chMdp2').val())) {
    		$('#message').html('les mots de passe correspondent').css('color', 'green');
  	} else {
    		$('#message').html('les mots de passes ne correspondent pas').css('color', 'red');
	} 
  } else { 
    $('#message').html("");
  }
});
</script>

<?php include("piedepage.php"); ?>


