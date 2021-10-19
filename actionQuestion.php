<?php
session_start();
include("connect.php");
include("verifConnectProf.php");
if (isset($_POST["editer"])) {
	echo("bonjour");
	$idQuestion = $mysqli->real_escape_string($_POST["idQuestion"]);
	$_SESSION["editQuestion"] = $idQuestion;
	header("Location: editQuestion.php");
	exit;
}
