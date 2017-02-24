<?php
include_once dirname(__FILE__) . '/../connDB/DB_API.php';
include_once dirname(__FILE__) . '/../connDB/dbconn.php';
include_once dirname(__FILE__) . '/../menu.php';
include_once dirname(__FILE__) ."/../util.php";
session_start();

?>


<html>
<head>
<title>Area utente</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="main_style.css" title="wsite-theme-css" />
<style type="text/css">
#main-wrap tr{
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
 
#main-wrap tr:hover
{
	text-align: center;
	color: #000;
	background-color: #FFF;
}
.language{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: lighter;
	color: #09F;
	padding-top: 2px;
	padding-right: 4px;
	padding-bottom: 2px;
	padding-left: 2px;
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
		 if($util->isProgrammatore()){
			 menuProgrammatore("../");
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
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Area Utente</h1>


</tr>

	
	</table>




<?php



$db=new DB_API();

importLib("../");

$util->checkActive("../");
if($util->isPM()){
			
	$idReg = $_SESSION['idPM'];		
	$risp=$db-> getPmById($idReg);
	echo" <table id='tabProgetti'>
			";
			
				
$dati=$db->selectDatiAnagraficiWithID($risp[0]['datiAnagrafici']);			

	echo "<tr>
			<tr><td ><h3>Nome</h3></td><td>".$dati[0]['nome']."</td></tr>
			<tr><td><h3>Cognome</h3></td><td>".$dati[0]['cognome']."</td></tr>
			<tr><td><h3>Data di nascita</h3></td><td>".$dati[0]['data_nascita']."</td></tr>
			<tr>	<td><h3>Città</h3></td><td>".$dati[0]['citta']."</td></tr>
			<tr><td><h3>Email</h3></td><td>".$dati[0]['email']."</td></tr>
			
			</tr>
			
					";		


	echo "</table>			
					";	

			
	$_SESSION['nome']= $dati[0]['nome'];
			
			
}else if($util->isProgrammatore()){
	$idReg = $_SESSION['idProgrammatore'];
	
	$risp=$db->getProgrammatoreSenzaMerge($idReg);
echo" <table id='tabProgetti'>
			";
			
$dati=$db->selectDatiAnagraficiWithID($risp[0]['datiAnagrafici']);			

	echo "
			<tr><td ><h3>Nome</h3></td><td>".$dati[0]['nome']."</td></tr>
			<tr><td><h3>Cognome</h3></td><td>".$dati[0]['cognome']."</td></tr>
			
			
			
					";	
	
	echo "
			<tr><td><h3>Data di nascita</h3></td><td>".$dati[0]['data_nascita']."</td></tr>
			<tr>	<td><h3>Città</h3></td><td>".$dati[0]['citta']."</td></tr>
			<tr><td><h3>Email</h3></td><td>".$dati[0]['email']."</td></tr>
			
			
			
					";	

	$_SESSION['nome']= $dati[0]['nome'];

	
}


?>

<?php
if($util->isProgrammatore()){

echo '<tr>
		<td>
				<h3 >Esperienza</h3> 
			</td>
			
			';
echo '<td style="padding-left:10%; padding-right:10%">		
			';
				echo ''.getEsperienza($risp[0]['esperienza']).'';
echo '</td>
		
		
		</tr>';

 


$lang = $db->getProgrammatoreLanguages($idReg);

echo '<tr>
		<td>
				<h3 >Linguaggi conosciuti</h3> 
			</td >';
			$str = "";
			foreach($lang as $value){
			$str .= '<div class="language">#' . $value['nome'] .'</div>';	
			}
			
			
	echo '<td>'.$str.'</td>
		
		
		</tr>';		

//print_r($lang);
$clusters = $db->getProgrammatoreClustersNameAndValore($idReg);
//print_r($clusters);



echo '<tr>
		<td>
				<h3 >Clusters (Area conosciuta - livello competenza)</h3> 
			</td >';
			$str = "";
			foreach($clusters as $value){
				
			$str .= '<div class="language">#' . $value['nome'] .' - '. $value['valore'] .'</div>';	
			}
			
			
	echo '<td>'.$str.'</td>
		
		
		</tr>';	


}



echo '</table>';
?>
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