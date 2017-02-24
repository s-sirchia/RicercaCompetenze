<?php 
require_once dirname(__FILE__) . "/../util.php";
require_once dirname(__FILE__) . "/../menu.php";
session_start();
$idPM=$_SESSION['idPM'];
//$_SESSION['idPM'] = $idPM;


?>

<html>
<head>
<script src="scriptProjects.js"></script>
<title>Visualizzazione Progetti in progress</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="main_style.css" title="wsite-theme-css" />
<style type="text/css">

 
#main-wrap td{text-align:center}
#main-wrap tr:hover{background:#30D5C8; color:#fff;}
 
</style>

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
			   	menu("../");
			   ?>
       		</tr>
       </table>   
    </div>
</div>

<div id="topnav-wrap">
	<?php
	 	$util = new Util();
		
			 menuPM("");
		
	
	?>
</div>
<div id="main-wrap">
    <div class="container">
        <div id="main">
        	<div id="content">
        	<div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div style="text-align:left;">
<form name="moduloProgetti" action="controlProj.php" id="modProj" method="POST">
        		
   <table>     			
   <tr>
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Progetti in progress</h1>
</tr>
<tr>

		<input class="button" type="submit" name="mod" value ="Modifica" onClick="checkProject(event)">

		<input class="button" type="submit" name="view" value ="Visualizza dettagli" onClick="checkProject(event)">

	
	
		<input class="button"   type="submit" name="part" value ="Partecipanti" onClick="checkProject(event)">
	
		<input type="hidden" value="progress" name="tipo" >
    
	
</tr>
	
	</table>



		<table id='tabProgetti'>
			<tr style="background:#fff; color:#5e5e5e">
				<td ><h3>*</h3></td>
				
				<td><h3>#</h3></td>
				
				<td><h3>Project</h3></td>
				
			<!--	<td><h3>Status</h3></td>
				
				<td><h3>Start Date</h3></td>
				
				<td><h3>Due Date</h3></td>        -->
				

			</tr>


<?php
include_once '../connDB/DB_API.php';
$db  = new DB_API();
$result = $db->getAllPmProject($idPM);
$flag = true;
for($i = 0;$i<count($result);$i++){
	$concluso = $result[$i]['stato'];
	if($concluso==2){
		$flag = false;
	echo "<tr>
			<td> <input type='radio' name='proj' value='".$result[$i]['idProgetto']."'/>
			<td>".$result[$i]['idProgetto']."</td>
			<td>".$result[$i]['nome']."</td>
			";	
	}
}
if($flag){
echo "<div>Nessuno sviluppatore ha ancora accettato l'invito a partecipare al progetto</div>";	
}

?>
</form>

</table>
			
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