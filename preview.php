<?php
$markdown = str_replace("\\","\\\\",$_POST["texte"]);
$markdown = str_replace("_","\_",$markdown);
require_once "parsedown/Parsedown.php";
$parser = new Parsedown();
echo ($parser->text($markdown));
?>


