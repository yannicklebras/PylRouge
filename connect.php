<?php
$login = "filrouge";
$mdp = "8BUcmh89kRg0Xn8v";
$dbname = "filrouge";
$mysqli = new mysqli("localhost",$login,$mdp,$dbname);
if ($mysqli -> connect_errno) {
  echo "Erreur de connexion à MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
