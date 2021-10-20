<?php
include("entete.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/idea.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.2.0/markdown-it.min.js">
<script src="https://cdn.jsdelivr.net/pyodide/v0.18.1/full/pyodide.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<link rel=stylesheet href="codemirror/lib/codemirror.css">
<link rel=stylesheet href="codemirror/theme/idea.css">
<script src="codemirror/lib/codemirror.js"></script>
<script src="codemirror/mode/markdown/markdown.js"></script>
<script src="codemirror/mode/python/python.js"></script>

<script language=javascript>
window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']]
  }
};

</script>

<script src="src/ace.js" crossorigin="anonymous" ></script>
<style type="text/css" media="screen">
.CodeMirror {
  border: 1px solid #eee;
  height: auto;
  width: 100%;
  min-height:100px
}
.CodeMirror-scroll {
  overflow-y: hidden;
  overflow-x: auto;
    }
</style>



<?php
include("connect.php");
include("verifConnectProf.php");
$idQuestion = $_SESSION["idQuestion"];
$statut = $_SESSION["statut"];

$requete = "SELECT * FROM QUESTIONS WHERE id=$idQuestion";
$question=$mysqli->query($requete)->fetch_assoc();

$requeteCas = "SELECT * FROM CASTEST WHERE question=$idQuestion AND type=1";
$casdetest = $mysqli->query($requeteCas);

$titre = $question['titre'];
$enonce = $question['enonce'];
$prerempli = $question['prerempli'];
?>




<h3><?php echo $titre;?></h3>
<form method=post>
<div id="enonce">
<?php echo $enonce; ?>
</div>
<div id="exemples">
Exemples de tests pour l'évaluation :
<div class="termPython">
<?php
while ($cas = $casdetest->fetch_assoc()) {
	$entree = $cas["entree"];
	$sortie = $cas["sortie"];
	echo(">>>".$entree."<br/>".$sortie."<br/>");
}
?>
</div>

<textarea id=editor1><?php echo $prerempli; ?></textarea>
</form>



<script language=javascript>
var editor1 = CodeMirror.fromTextArea(document.getElementById("editor1"), {
        mode: 'python',
        lineNumbers: true,
        lineWrapping: true,
        viewPortMargin:10,
        theme: "idea",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
        });

md = new window.markdownit({
                        highlight: function (str, lang) {
                                if (lang && hljs.getLanguage(lang)) {
                                        try {
                                                return hljs.highlight(str, { language: lang }).value;
                                        } catch (__) {}
                                }
                                return ''; // use external default escaping
                        }
                });
$("#enonce").html(md.render($('#enonce').html()));
//MathJax.typeset();
</script>
<?php
include("piedepage.php");
?>
