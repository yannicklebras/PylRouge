<?php 
include("entete.php");
?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<link rel=stylesheet href="codemirror/lib/codemirror.css">
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
  min-height:50px
}
.CodeMirror-scroll {
  overflow-y: hidden;
  overflow-x: auto;
    }
</style>

<?php
include("connect.php");
include("verifConnectProf.php");
if (isset($_SESSION["editQuestion"])) {
	$requete = "SELECT * FROM QUESTIONS WHERE id=".$mysqli->real_escape_string($_SESSION["editQuestion"]);
	$question = $mysqli->query($requete)->fetch_assoc();
	$titre = $question["titre"];
	$enonce = $question["enonce"];
	$prerempli = $question["prerempli"];
	$correction = $question["correction"];
	$niveau = $question["niveau"];
	$retour = $question["retour"];
	$enseignant = $question["enseignant"];
	$idQuestion = $question["id"];
}
?>


<form  method=post action=actionQuestion.php>
<table width=100%>
<tr><td width=200px>Titre : </td><td><input type=text name=titre value="<?php echo $titre;?>"></td></tr>
<tr><td>Énoncé : </td><td><div id=texte0><TEXTAREA name=enonce id=editor0 ><?php echo $enonce;?></TEXTAREA></div>
			  <div id="preview0" style="border-width:1pt;border-style:solid;display:none;"></div></td></tr>
<tr><td>Code prérempli :</td><td><textarea id="editor1"><?php echo $prerempli;?></textarea></td></tr>
<tr><td>Corrigé :</td><td><textarea id="editor2"><?php echo $correction;?></textarea></td></tr>
<tr><td>Niveau :</td><td><div>  <label>
    <input type="radio" name="stars" value="1" <?php echo ($niveau==1)?"checked":""; ?>/>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="2" <?php echo ($niveau==2)?"checked":""; ?>/>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="3" <?php echo ($niveau==3)?"checked":""; ?>/>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>   
  </label>
  <label>
    <input type="radio" name="stars" value="4" <?php echo ($niveau==4)?"checked":""; ?>/>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="5" <?php echo ($niveau==5)?"checked":""; ?>/>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
</td></tr>
<tr><td id="test">Retour :</td><td><div id=texte3><textarea id=editor3><?php echo $retour;?></textarea></div>
				   <div id=preview3 style="border-width:1pt;border-style:solid;display:none;"></div></td></tr>
</table>
<center><input type=submit name=action value=enregistrer><input type=submit name=action value=annuler></center>
</form>




<script language=javascript>
$("#btnTest").click(function(){
		$("#test").html("Bonjour $\\frac ab$");
		MathJax.typeset();
		});
  var editor0 = CodeMirror.fromTextArea(document.getElementById("editor0"), {
        mode: 'markdown',
        lineNumbers: false,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList",'Ctrl-Enter': (cm) => {
            $.ajax({
                                        url  :'preview.php',
                                        type : "POST",
                                        data :({texte:editor0.getValue()}),
                                        dataType : "html",
                                        success : function (a,b) {$("#preview0").html(a);$("#texte0").hide();
                                                                $("#preview0").show();
                                                                MathJax.typeset();}
                                });
          }}

      });
  var editor1 = CodeMirror.fromTextArea(document.getElementById("editor1"), {
        mode: 'python',
        lineNumbers: true,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
	});
  var editor2 = CodeMirror.fromTextArea(document.getElementById("editor2"), {
	mode: 'python',
        lineNumbers: true,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
      });
  var editor3 = CodeMirror.fromTextArea(document.getElementById("editor3"), {
        mode: 'markdown',
        lineNumbers: false,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList",'Ctrl-Enter': (cm) => {
            $.ajax({
                                        url  :'preview.php',
                                        type : "POST",
                                        data :({texte:editor3.getValue()}),
                                        dataType : "html",
                                        success : function (a,b) {$("#preview3").html(a);$("#texte3").hide();
                                                                $("#preview3").show();
                                                                MathJax.typeset();}
                                });
          }}

});
$("#preview0").dblclick(function(){$("#preview0").hide();$("#texte0").show();});
$("#preview3").dblclick(function(){$("#preview3").hide();$("#texte3").show();});

</script>
<script>
//document.addEventListener("DOMContentLoaded", function() {
//          renderMathInElement(document.body, {
//              delimiters: [
//                {left: "$$", right: "$$", display: true},
//                {left: "$", right: "$", display: false}
//              ]
//         });
//      });
</script>

<?php include("piedepage.php");?>

