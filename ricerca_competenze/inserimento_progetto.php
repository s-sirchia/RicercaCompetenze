<?php 
require_once dirname(__FILE__) . "/util.php";
require_once dirname(__FILE__) . "/menu.php";
require_once("./sparqlAPI/apiJena.php"); 
$jena = new ApiJena("http://localhost:3030/ontologia/query");
$categorie = $jena->getAllCluster();
session_start();
$util = new Util();
$util->checkActivePM("");
?>
<html> 
<head>

<title>Progetto</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css" title="wsite-theme-css" />
<style type="text/css">

 

#main-wrap tr:hover{background:#fff; color:#30D5C8;}
#main-wrap tr{border-bottom:none;}
 .wsite-form-input{width:100%}
 .wsite-form-label:hover{background:#fff; color:#30D5C8;}
 .containerCheckbox {overflow-y: scroll; text-align:left; height: 200px; width:400px;}
</style>
<script type="text/javascript">

function comeBack(){
	 var r = confirm("L'Operazione ti sta riportando alla pagina precedente");
	 if (r == true) {
		 window.location.assign("viewProjects/projects.php");
		}
}
</script>
</head>

<body>

	<div id="header-wrap">
    	<div class="container">
        	<table id="header">
        	<tr>
           		<td id="logo"><span class="wsite-logo">
					<a href="#">
					<span id="wsite-title">Ricerca Competenze</span>
					</a></span>
				</td>
           <td id="header-right">
               <?php 
			   	menu("");
			   ?>
       		</tr>
       </table>   
    </div>
</div>


<div id="topnav-wrap">
	<?php
	 	$util = new Util();
		 if($util->isProgrammatore()){
			 menuProgrammatore("");
		 }else if($util->isPM()){
			 menuPM("viewProjects/");
		 }else{
			session_destroy(); 
		 }
	
	?>
</div>
<div id="main-wrap">
    <div class="container">
        <div id="main">
        	<div id="content">
        	<div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div style="text-align:left;">
 <form name='Inserisci' action='Inserisci_progetto.php' method='POST'>
 <h1>Aggiungi Progetto</h1>
 <input class="button-large" type='submit' value='Aggiungi' action='prova_jena.php' method='post' onclick='Post.Send(this)'>
 <input class="button-large" type = 'button' name='back' value='Indietro' onClick="comeBack()">
 <table>
 <tr><td><label class="wsite-form-label">Nome progetto</label></td><td><input class="wsite-form-input" type=text name='nome'></td></tr>
 <tr><td><label class="wsite-form-label">Descrizione</label></td> <td><textarea class="wsite-form-input" name='descrizione' rows='6' cols='90'> </textarea></td></tr>
 <!--<tr><td><label class="wsite-form-label">Categorie</label></td><td><select class="wsite-form-input" multiple name='categoria[]' > <OPTION value='web app'> Web app </option> <OPTION value='app mobile'> App Mobile </option><OPTION value='software java'>software java  </option> <\select></td></tr> -->
 <tr><td><label class="wsite-form-label">Categorie</label></td>
 <td>
 <div class="containerCheckbox">
    <?php 
	for($i=0;$i<count($categorie);$i++){
	$element=str_replace("http://www.competenze.com/ontologia#","",$categorie[$i]);
     echo"<input type='checkbox' name='categoria[]' value='".$element."'/>#".$element."<br/>"; 
	 }
	?>
</div>
 </td></tr>
 
 <tr><td><label class="wsite-form-label">Data d'inizio</label></td><td><input class="wsite-form-input" type='date' name='dataInizio'></td></tr>
 <tr><td><label class="wsite-form-label">Data di fine</label></td><td><input class="wsite-form-input" type='date' name='dataFine'></td></tr>
 <tr><td><input class="wsite-form-input" type=hidden name='fondi' value='0'></td></tr>
 <tr><td><input class="wsite-form-input" type=hidden name='numeroTeam' value='0'></td></tr>
 </table>
 </form>
 
 		</div>
			</div>
		</div>
	</div>
	</div>

	<div style="padding-top:200px; background:#fff;"></div>	
	<div id="footer-wrap">
	<div class="container">
		<div id="footer"></div>
    </div>
	</div>
</div>
</body>
</html>