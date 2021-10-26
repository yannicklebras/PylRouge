<?php
include("entete.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/idea.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.2.0/markdown-it.min.js"></script>
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
//print_r($_SESSION);
include("connect.php");
if (isset($_SESSION["prof_login"])) 
	include("verifConnectProf.php");
elseif (isset($_SESSION["etud_login"])) 
	include("verifConnectEtud.php");
else 
	header("Location: index.php");
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
<form method=post id=formulaire action="validQuestion.php">
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
</div>
<textarea id=editor1 name=code><?php echo $prerempli; ?></textarea>

<center><button id=tester>tester sur les exemples</button><button id=valider>Valider le script</button></center>
<div class="termPython" id="divtest"></div>
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

async function main() {
        let pyodide = await loadPyodide({
          indexURL: "https://cdn.jsdelivr.net/pyodide/v0.18.1/full/",
        });
        return pyodide;
      }
      let pyodideReadyPromise = main();

  // Pyodide is now ready to use...

async function evaluatePython(code,cas,attendu,div) {
        let pyodide = await pyodideReadyPromise;
        try {
          var sortie = pyodide.runPython(code+"\n"+cas);
	  if (sortie != attendu) {
		div.append(">>> "+cas+"<br/>"+sortie+"<br/><span style='color:red'># attendu : "+attendu+"</span><br/>")
	  } else {	
          //input.val(output);
	  	div.append(">>> "+cas+"<br/>"+sortie+"<br/><span style='color:green'># attendu : "+attendu+"</span><br/>")
          }
	} catch (err) {
          div.append(">>> "+cas+"<br/><pre class='messageErreur'>"+(err)+"</pre><br/># attendu : "+attendu+"<br/>");
        }
      }

async function evaluatePythonFull(code,cas,attendu,json) {
        let pyodide = await pyodideReadyPromise;
        try {
          var sortie = pyodide.runPython(code+"\n"+cas);
		return sortie;
        } catch (err) {
		return err;
        }
      }


castest = new Map();
<?php
$casdetest->data_seek(0);
while ($cas=$casdetest->fetch_assoc()) {
	echo("castest.set(\"".$mysqli->real_escape_string($cas["entree"])."\",\"".$mysqli->real_escape_string($cas["sortie"])."\");\n");
}
?>

$("#tester").click(function() {
	$("#divtest").html("");
	for  (let [entree,sortie] of castest) {
		evaluatePython(editor1.getValue(),entree,sortie,$("#divtest"));
	}
	return false;
});


$("#valider").click(function(){
	$.ajax({
		method:"POST",
		url:"testsQuestion.php",
		dataType:"json",
		data:{idQuestion:"<?php echo $idQuestion;?>"},
		success:async function(a) {
			cass = a;
			for (cas of cass["cas"]) {
				cas["resultat"]= await evaluatePythonFull(editor1.getValue(),cas["entree"],cas["sortie"],cas);
				$("#formulaire").append("<input type=hidden name=resultat[] value="+cas["resultat"]+"><input type=hidden name=resultatid[] value="+cas["id"]+">");
			}
			$("#formulaire").submit();
		}
	});	
	return false;

});

</script>
<?php
include("piedepage.php");
?>
