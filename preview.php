<?php
$markdown = str_replace("\\","\\\\",$_POST["texte"]);
$markdown = str_replace("_","\_",$markdown);

require_once "phpmarkdown/MarkdownInterface.php";
require_once "phpmarkdown/Markdown.php";
require_once "phpmarkdown/MarkdownExtra.php";
echo (Michelf\MarkdownExtra::defaultTransform($markdown));
?>


