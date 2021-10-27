<?php
session_start();
$horsConnexion=1;
if (isset($_SESSION["erreur"])) $message=("<span class='erreur'>Erreur de connexion</span>");
session_destroy();
unset($_SESSION);
require("entete.php");?>
<center>
<h1>Connexion Enseignant</h1>
<div class="formulaireconnexion">
	<?php if (isset($message)) echo $message;?>
	<form action="identification.php" method=POST>
		identifiant:<br/>
		<input class="login" type=text name=idProf><br/>
		mot de passe:<br/>
		<input class="login" type=password name=mdpProf><br/>
		<input class="bouton" type=submit value="connexion">
	</form>
</div>
</center>
<?php include("piedepage.php");?>
