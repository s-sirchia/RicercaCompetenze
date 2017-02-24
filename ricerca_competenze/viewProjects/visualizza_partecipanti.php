<?php 
require_once dirname(__FILE__) . "/../util.php";
require_once dirname(__FILE__) . "/../menu.php";
session_start();
$util = new Util();
$util-> checkActive("../");
$progress;
if(isset($_SESSION['progress'])){
	$progress = $_SESSION['progress'];
		
}else{
echo "error";
die;
}
$idProj=$_SESSION['idProj'];
//$_SESSION['idPM'] = $idPM;

?>

<html>
<head>
<script src="starFunct.js"></script>

<script src="scriptProjects.js"></script>
<title>Visualizzazione Partecipanti</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="main_style.css" title="wsite-theme-css" />
<link rel="stylesheet" type="text/css" href="star_stile.css" title="wsite-theme-css" />

<style type="text/css">

 
#main-wrap td{text-align:center}

.message {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #F00;
	text-align: center;
	width: 100%;
}
#main-wrap tr:hover{
	color: #333;
	background-color: #FFFFFF;
}
 
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
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Partecipanti</h1>
</tr>
<tr>

	
		

	
	

</tr>
	
	</table>



		<table id='tabProgetti' value='<?php echo $idProj ?>'>
			<tr style="background:#fff; color:#5e5e5e">
				
				
				<td><h3>#</h3></td>
				
				<td><h3>nome</h3></td>

				<td><h3>cognome</h3></td>

				<td><h3>data di nascita</h3></td>

				<td><h3>città</h3></td>

				<td><h3>email</h3></td>
				<?php
				if(!$progress){
				echo '<td><h3>valutazione</h3></td>';
				}
				?>
			</tr>


<?php
include_once '../connDB/DB_API.php';
$db  = new DB_API();
$programmers = $db->getProgrammerSign($idProj);
$nProgs=count($programmers);
$remain=$nProgs;
if($nProgs==0)
	echo "<div class=\"message\">Nessun partecipante</div>";
else{
for($i = 0;$i<$nProgs;$i++){
	$hasWork = $programmers[$i]['onWorking'];
	if($hasWork!=1){
		$remain--;
		continue;
	}
	$rcv_feedback = $programmers[$i]['recv_feedback'];
	$idProg=$programmers[$i]['Programmatore_idProgrammatore'];
	$currProg =  $db->getProgrammatore($idProg);
	$idDati = $currProg[0]['datiAnagrafici'];
	$datiAnagrafici=$db->getDatiProgrammatore($idDati);
	
	echo "<tr id='".$idProg."'>
			
			<td>".$i."</td>
			<td>".$datiAnagrafici[0]['nome']."</td>
			<td>".$datiAnagrafici[0]['cognome']."</td>
			<td>".$datiAnagrafici[0]['data_nascita']."</td>
			<td>".$datiAnagrafici[0]['citta']."</td>
			<td>".$datiAnagrafici[0]['email']."</td>
			";	
			
		if(!$progress){	
		
			/*Al programmatore i-esimo non è stato ancora assegnato un feedback*/
			if($rcv_feedback==0){
				//$_SESSION['idProg']=$idProg;
				echo	"<td><script type='text/javascript'>star(3,".$idProg.");</script></td>";
				
				
			}
			/*è già stato assegnato un feedback*/
			else{
			echo	"<td>Feedback assegnato</td>";
			}
		}else{
			echo	"<td></td>";
		}
}
}
if($remain==0)
	echo "<div class=\"message\">Nessun partecipante</div>";
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