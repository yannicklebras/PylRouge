<?php 
include("entete.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/idea.min.css" integrity="sha512-Rfc5zQIp95eozfMCdS3B4MItUxU8orNje/t1OEhf7XwIk0DTCuMH2LG0NIgP8UGYK9L39WfUNI1c4IsM5yY/PA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.2.0/markdown-it.min.js" integrity="sha512-cTQeM/op796Fp1ZUxfech8gSMLT/HvrXMkRGdGZGQnbwuq/obG0UtcL04eByVa99qJik7WlnlQOr5/Fw5B36aw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/pyodide/v0.18.1/full/pyodide.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<link rel=stylesheet href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.3/codemirror.min.css">
<link rel=stylesheet href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.3/theme/idea.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.3/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.3/mode/markdown/markdown.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.63.3/mode/python/python.min.js"></script>

<script language=javascript>
window.MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']]
  }
};

</script>

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
if (isset($_SESSION["editQuestion"])) {
	if ($_SESSION["editQuestion"]>0) {
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
	} else {
		$titre = "";
		$enonce = "";
		$prerempli = "";
		$correction = "";
		$niveau = 1;
		$retour = "";
		$enseignant = $id;
		$idQuestion = -1;
	}
}
?>


<form  method=post action=actionQuestion.php>
<table width=100%>
<tr><td width=200px>Titre : </td><td><input type=text name=titre value="<?php echo $titre;?>"><input type=hidden value=<?php echo $idQuestion;?> name=idQuestion></td></tr>
<tr><td>Énoncé : <br/> (Ctrl+Entrée pour visualiser, double click pour revenir)  </td><td><div id=texte0><TEXTAREA name=enonce id=editor0 ><?php echo $enonce;?></TEXTAREA></div>
			  <div id="preview0" style="border-width:1pt;border-style:solid;display:none;"></div></td></tr>
<tr><td>Code prérempli :</td><td><textarea id="editor1" name=prerempli><?php echo $prerempli;?></textarea></td></tr>
<tr><td>Corrigé :</td><td><textarea id="editor2" name=corrige><?php echo $correction;?></textarea></td></tr>
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
<tr><td>Retour :<br/> (Ctrl+Entrée pour visualiser, double click pour revenir) </td><td><div id=texte3><textarea name=retour id=editor3><?php echo $retour;?></textarea></div>
				   <div id=preview3 style="border-width:1pt;border-style:solid;display:none;"></div></td></tr>
</table>
<div id="casDeTest">
<?php 
$requete = "SELECT * FROM CASTEST WHERE question = $idQuestion ORDER BY type";
$castest = $mysqli->query($requete);
$i=0;
if($idQuestion==-1) {
	echo("<div class='castest'><div style='display:inline-block;width:400px'><SELECT name=\"casType[]\">
                                        <OPTION value=1>Entrainement</OPTION>
                                        <OPTION value=2>Validation Visible</OPTION>
                                        <OPTION value=3>Validation cachée</OPTION>
                                 </SELECT>
                                 <textarea name='casEntree[]' class='inputPython></textarea>
                                <button type=button class=executer>Exec.</button>
                                &gt;&gt;&gt;
                                 <textarea name='casSortie[]' style='display:none'></textarea></div>
                                <div class='stdout' id='stdout[]'></div>
                                <div style='display:inline-block;width:33px'><button type=button class='bouton suppr'><span class='material-icons'>delete</span></button></div> 
                                </div>");
}
while ($cas = $castest->fetch_assoc())  {
	$type = $cas["type"];
	echo("<div class='castest'><div style='display:inline-block;width:400px'><SELECT name=\"casType[]\">
					<OPTION value=1".(($type==1)?" SELECTED":"").">Entrainement</OPTION>
					<OPTION value=2".(($type==2)?" SELECTED":"").">Validation Visible</OPTION>
					<OPTION value=3".(($type==3)?" SELECTED":"").">Validation cachée</OPTION>
				 </SELECT>
				 <textarea name='casEntree[]' class='inputPython'>".($cas['entree'])."</textarea>
				<button type=button class=executer>Exec.</button>
				&gt;&gt;&gt;
				 <textarea name='casSortie[]' style='display:none'>".($cas['sortie'])."</textarea></div>
				<div class='stdout' id='stdout[]'>".($cas['sortie'])."</div>
				<div style='display:inline-block;width:33px'><button type=button class='bouton suppr'><span class='material-icons'>delete</span></button></div> 
				</div>");
	$i = $i+1;
}
?>
</div>
<div class='ajouter'><button type=button class=bouton id=ajouterCas>
        <span class=ajouter>Ajouter un cas de test <span class='material-icons'>add_circle_outline</span></button>
</div>

<center><input type=submit name=action value=enregistrer><input type=submit name=action value=annuler></center>

</form>




<script language=javascript>
  var editor0 = CodeMirror.fromTextArea(document.getElementById("editor0"), {
        mode: 'markdown',
        lineNumbers: false,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList",'Ctrl-Enter': (cm) => {
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
		$("#preview0").html(md.render(editor0.getValue()));
		$("#texte0").hide();
		$("#preview0").show();
		MathJax.typeset();
	}}

      });
  var editor1 = CodeMirror.fromTextArea(document.getElementById("editor1"), {
        mode: 'python',
        lineNumbers: true,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "idea",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
	});
  var editor2 = CodeMirror.fromTextArea(document.getElementById("editor2"), {
	mode: 'python',
        lineNumbers: true,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "idea",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
      });
  var editor3 = CodeMirror.fromTextArea(document.getElementById("editor3"), {
        mode: 'markdown',
        lineNumbers: false,
	lineWrapping: true,
	viewPortMargin:10,
        theme: "default",
        extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList",'Ctrl-Enter': (cm) => {
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
		$("#preview3").html(md.render(editor3.getValue()));
		$("#texte3").hide();
		$("#preview3").show();
		MathJax.typeset();
	}}
});
$("#preview0").dblclick(function(){$("#preview0").hide();$("#texte0").show();});
$("#preview3").dblclick(function(){$("#preview3").hide();$("#texte3").show();});

</script>
<script>
async function main() {
        let pyodide = await loadPyodide({
          indexURL: "https://cdn.jsdelivr.net/pyodide/v0.18.1/full/",
        });
        return pyodide;
      }
      let pyodideReadyPromise = main();

  // Pyodide is now ready to use...

async function evaluatePython(code,input,div) {
        let pyodide = await pyodideReadyPromise;
        try {
          var sortie = pyodide.runPython(code);
	  //input.val(output);
	  input.val(sortie);
	  //alert(sortie);
	  div.html(String(sortie));
        } catch (err) {
          input.val(err);
	  div.html("<pre class='messageErreur'>"+(err)+"</pre>");
        }
      }

$("body").on('click','.executer',function(){
	input = $(this).parent().find("textarea").eq(1);
	div = $(this).parent().parent().find("div[id^='stdout']");
	var code = editor2.getValue();
	code = code + "\n";
	code = code + $(this).parent().find("textarea").eq(0).val();
	evaluatePython(code,input,div);
	return false	
});

$("body").on('click',"#ajouterCas",function(){
	div = $(document).find(".castest").eq(0).clone();
	div.find("input").val("");
	div.find(".stdout").html("");
	$("#casDeTest").append(div);
});

$("body").on("click",".suppr",function(){
	$(this).closest(".castest").remove();
});
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


