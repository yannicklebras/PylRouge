<?php
session_start();
$horsConnexion=1;
if (isset($_SESSION["erreur"])) $message=("<span class='erreur'>".$_SESSION["erreur"]."</span>");
session_destroy();
unset($_SESSION);
require("entete.php");?>
<center>
<h1>Connexion Etudiant</h1>
<div class="formulaireconnexion">
	<?php if (isset($message)) echo $message;?>
	<form action="identification.php" method=POST>
		identifiant:<br/>
		<input class="login" type=text name=idEtud><br/>
		mot de passe:<br/>
		<input class="login" type=password name=mdpEtud><br/>
		<input class="bouton" type=submit value="connexion">
	</form>
</div>
</center>
<?php include("piedepage.php");?>
