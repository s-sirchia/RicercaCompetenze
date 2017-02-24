<?php
require_once dirname(__FILE__) . "/util.php";
require_once dirname(__FILE__) . "/menu.php";
include_once dirname(__FILE__) . '/connDB/DB_API.php';
session_start();
$util = new Util();

 if($util->isProgrammatore() || $util->isPM())	{
	 header("location: index.php?message=2");
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
<script>

function checkCampi(event){
	tmp = document.getElementsByName("ruolo");
	 pm = tmp[0].checked;
 prog = tmp[1].checked;
 
 if(pm){
	 ruolo = tmp[0].value;
 }else{
	ruolo = tmp[1].value;
 }
 
	r = confirm("Stai per essere registrato come "+ruolo+"sei sicuro di voler continuare?");
	if(!r){
	event.preventDefault();
	}
	
	
}


function checkRole(){
 tmp = document.getElementsByName("ruolo");
 pm = tmp[0].checked;
 prog = tmp[1].checked;

 document.getElementById("divTabDati").style.display=" block ";
  tmp = document.getElementsByClassName("inputProgrammer");
 if(pm){
 
for(i = 0;i<tmp.length;i++){

tmp[i].style.visibility = "hidden";

}
 
 }else{
for(i = 0;i<tmp.length;i++){

tmp[i].style.visibility = "visible";

}
 }
 

 
 
 
}

</script>


<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css">
<style type="text/css">
.wsite-form-label:hover{background:#fff; color:#30D5C8;}
 #main-wrap tr{border-bottom:none 1px; }
 #main-wrap tr:hover{background:none; color:#5e5e5e }
#main-wrap td:hover{color:#5e5e5e}
#tabDati td{text-align:left}
 .wsite-form-input{width:100%}
 .wsite-form-input-disabled{width:100%}
</style>
</head>

<body class=" no-header-page  wsite-theme-light  wsite-page-visualizzazione-progetti" >
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

<?php
$mes=0;
if(isset($_GET['mes']))
$mes=$_GET['mes'];
if($mes==1)
echo "<font color=”red”>Esiste già un account associato a questa mail</font>";
else 
if($mes==2)
echo "<font color=”red”>User già esistente </font>";
?>




<div>

<?php
if(isset($_GET['message'])) {
    $message = $_GET['message'];
	if( $message == 1){
		echo "<p>nome utente e password non validi</p>";
	}else if($message == 2){
		echo "<p>utente non autorizzato</p>";
	}
}
 ?> 
 </div>
 <form  action='scraping.php' method='POST'>
 <table>
 <tr><td><h4> Project Manager</h4></td><td><h4> Programmatore </h4></td></tr>
	<tr><td><input class="wsite-form-input" id ="radioPM" type="radio" name="ruolo" value="PM" onClick="checkRole()"></td>
	<td><input id="radioProg" class="wsite-form-input" type="radio" name="ruolo" value="Programmatore" onClick="checkRole()"></td>
	</tr></tr>
	</table>

<div id="divTabDati" style="display:none">
	<table id="tabDati">
	
 <tr><td><label class = "wsite-form-label">User(*)</label></td>
	<td><input class="wsite-form-input" type='text' name='user' required></td></tr>
	
	<tr><td><label class = "wsite-form-label">Password(*)</label></td>
	<td><input class="wsite-form-input" type='password' name='psw' required></td></tr>
 
 <tr><td><label class = "wsite-form-label">Nome(*) </label></td>
	<td><input  class="wsite-form-input" type='text' name='nome' required></td></tr>

<tr><td><label class = "wsite-form-label"> Cognome(*) </label></td>
	<td><input  class="wsite-form-input"type='text' name='cognome' required></td></tr>
	
<tr><td><label class = "wsite-form-label">Data di nascita(*)</label></td>
	<td><input class="wsite-form-input" type='date' name='data' required></td></tr>
	
	<tr><td><label class = "wsite-form-label">Città(*)</label></td>
	<td><input class="wsite-form-input" type='text' name='citta' required></td></tr>
	
	<tr><td><label class = "wsite-form-label">Via(*)</label></td>
	<td><input class="wsite-form-input" type='text' name='via' required></td></tr>
	
	<tr><td><label class = "wsite-form-label">Cap(*)</label></td>
	<td><input class="wsite-form-input" type='number' name='cap' required></td></tr>
	
	<tr><td><label class = "wsite-form-label"> Telefono(*)</label></td>
	<td><input class="wsite-form-input" type='number' name='telefono' required></td></tr>
	
	<tr><td><label class = "wsite-form-label">Email(*)</label></td>
	<td><input class="wsite-form-input" type='text' name='email'  required></td></tr>
	
	<tr class="inputProgrammer"><td><label  class = "wsite-form-label inputProgrammer">Costo ora(*)</label></td>
	<td><input class="wsite-form-input inputProgrammer"  type='number' min='0' name='costo' value="0" required></td></tr>
	
	<tr class="inputProgrammer"><td><label  class = "wsite-form-label inputProgrammer">URL Linkedin(*)</label></td>
	<td><input class="wsite-form-input inputProgrammer" type='text' name='link' value="http:\\www.linkedin.com" required></td></tr>
	
<tr><td><input class="button-large" type="submit" value="Registra" onclick="checkCampi(event)"></td></tr>
	  </table>

<div>
      </form>
				</div>
			</div>
		</div>
	</div>
	</div> 	
		
<div id="footer-wrap">
	<div class="container">
		<div id="footer"></div>
    </div>
</div>
</body>
</html>