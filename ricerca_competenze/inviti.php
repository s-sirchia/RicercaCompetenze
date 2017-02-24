<?php

include_once 'connDB/DB_API.php';
include_once 'connDB/dbconn.php';
include_once './util.php';

include_once dirname(__FILE__) . './menu.php';


session_start();

$db=new DB_API();
$util = new Util();


?>

<html>
<head>
<title>Inviti utente</title>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="lib/popup.js"></script>

<script>

$(document).ready(function(e) {
    $('#popup').hide();
});



function conferma(event,str){
	 var r = confirm(str);
	 if (r != true) {
		 event.preventDefault();
	}
}


function showInfo(nome){
	res = document.getElementById(nome);
	
	//alert(res.value);
	addToDiv(res.value);
}

</script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css" title="wsite-theme-css" />
<style type="text/css">
.info {
	height: 40px;
	width: 40px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFF;
	background-color: #666;
	background-image: url(img/info-icon0.png);
}
.info:hover {
	background-image: url(img/info-icon1.png);
}

#main-wrap tr:hover{
	text-align: center;
	background-color: #FFF;
	color: #333;
}

.btn {
	width: 100px;
}
</style>
</head>

<body>
<div id="popup">Lorem Ipsum Dolor sit</div>
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
			 menuPM("");
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


<table>     			
   <tr>
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">I tuoi inviti</h1>
</tr>

	
	</table>
	
	<table id='tabProgetti'>
			<tr style='background:#fff; color:#5e5e5e'>
				
								
			</tr>
<?php
$idProg = $_SESSION['idProgrammatore'];

$strInfo ="";
$ris=$db->getInvito($idProg);
if(count($ris)==0)
	echo "non ci sono nuovi inviti";
else{
	
foreach($ris as $value){
   $res=$db->getProjectFromID($value['idProgetto']);
  	 foreach($res as $value){
	//print_r($value);	
		echo "<table>";
		$clusters = $db->getProjectCluster($value['idProgetto']);
		$tags = $db->getProjectTag($value['idProgetto']);
		$nclusters = count($clusters);
		$ntag = count($tags);
	echo "
	<tr>
	<td><div class=\"info\"  onClick=\"showInfo('hide" . $value['idProgetto']. "')\" ></div> </td>
	<td><div class=\"nomeProg\">".$value['nome']."</div>";
	echo "<input type=\"hidden\" name=\"progetto\" value=\"".$value['idProgetto']."\"/></td> ";
	echo "<td>".$value['data_inizio']."</div>";
	$strInfo .="<H2>" . $value['nome'] . "</H2><br>";
  	$strInfo .="DATA INIZIO: " . $value['data_inizio'] . "<br>";
  	$strInfo .="DATA FINE: " . $value['data_fine']. "<br>";
  	$strInfo .="DESCRIZIONE: " .  $value['descrizione'] . "<br>";
	$strInfo .="COSTO: " .  $value['costo'] . "<br>";
	
	$strInfo .= "<p>COMPETENZE:<br>";
	
	if($nclusters>0){
	foreach($clusters as $c){
		$strInfo .= $c['nome'] . " - difficoltà: ".$c['valore']."<br>";
		
	}
	}
	echo '<textarea id="hide' . $value['idProgetto'] . '" style="display:none;">'. $strInfo .'</textarea>';
	
	
	

$strInfo = "";
echo "</form>";


   
	   echo "	<td><form method='POST' action='accetta.php?programma=".$value['idProgetto']."&programmatore=".$idProg."'>
					<input class=\"button btn\" type='submit' value='Accetto'></form>
					<form method='POST' action='rifiuta.php?programma=".$value['idProgetto']."&programmatore=".$idProg."'><input class=\"button btn\" type='submit' value='Rifiuto'> </form></td>
			</tr>";
					
	}
	echo"</table>";	


}
}

?>
