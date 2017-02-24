<?php
require_once dirname(__FILE__) . "/util.php";
require_once dirname(__FILE__) . "/menu.php";
include_once dirname(__FILE__) . '/connDB/DB_API.php';
session_start();
$util = new Util();
$util->checkActiveProgrammatore("");
/*if($_SESSION['active']==false){
header("Location: login.php?message=2");	
}*/
$name=$_SESSION['nome'];
$id=$_SESSION['idProgrammatore'];
?>

<html>
<head>

<title>Visualizzazione Progett</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css">
<style type="text/css">
#main-wrap tr:hover{
	background-color: #FFF;
	color: #333333;
}
 

 


.message {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #F00;
	width: 100%;
	text-align: center;
	height: 5px;
	padding-top: 5px;
	padding-bottom: 5px;
}
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
.button { 
	color:#fff;
	font-family: Helvetica, Arial, sans-serif;
	height: 31px; display: inline-block;
	font-weight:normal;
	font-size:15px; 
	text-decoration: none;
	border:none;
	padding-left:10px;
	padding-right:10px;   
	background-color: #5e5e5e;
   }
.nomeProg {
	text-align: left;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	width: 500px;
}
</style>
</head>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="lib/popup.js"></script>
<script>

$(document).ready(function(e) {
    $('#popup').hide();
});



function conferma(event,str){
	 var r = confirm(str);
	 if (r != true) {
		return false;
	 }
	 return true;
}

function cerca(){
	chiave="";
	modo="";
	chiavi = document.getElementsByName('chiave[]');
	modi = document.getElementsByName('modo[]');
	for(i=0;i<chiavi.length;i++){
		if(chiavi[i].checked){
			
			chiave=chiavi[i].value;
		}
	}
	for(i=0;i<modi.length;i++){
		if(modi[i].checked){
			
			modo=modi[i].value;
		}
	}
	//alert(modo);
	nome = document.getElementsByName('cerca')[0].value;
	//alert(nome);
	
	$.post("cerca.php",
			{
			  nome:nome,
			  chiave:chiave,
			  modo:modo
			},
			function(data,status){
				tab = document.getElementById('tabProgetti');
				tab.innerHTML= data;
					
				
			});
	
}

function clickBtn(num,idprog){
	if(num == 1){
	if(conferma(event,'vuoi davvero LASCIARE il progetto?'))
	sign("sign out",idprog);
	}else{
	if(conferma(event,'vuoi davvero ISCRIVERTI al progetto?'))
	sign("sign in",idprog);
	}
	
}


function sign(bottone,idprog){
	$.post("iscrivi_progetto.php",
			{
			  button:bottone,
			  progetto:idprog
			 
			},
			function(data,status){
				tab = document.getElementById('button' + idprog);
				tab.innerHTML= data;
					
				
			});	
	
}

function showInfo(nome){
	res = document.getElementById(nome);
	//alert(res.value);
	addToDiv(res.value);
}


</script>


<body class=" no-header-page  wsite-theme-light  wsite-page-visualizzazione-progetti">
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
  
		
   <table>     			
   <tr>
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Tutti i progetti</h1>

</tr>

<tr>
<div><table><tr><td><input class="wsite-form-input" type="text" name="cerca" id="cerca" /><button class="button" name="btnCerca"  onClick="cerca()" value="cerca"/>cerca</button></td>
	<td><h3>cerca per:</h3></td><td><div class="radioSearch"><input  name="modo[]" type="radio" value="1" checked>nome</div>
    			<div class="radioSearch"><input name="modo[]" type="radio" value="2">competenze</div></td>
    <td><h3>ordina per:</h3></td><td><div class="radioSearch"><input name="chiave[]" type="radio" value="data_inizio">data inizio</div>
    			<div class="radioSearch"><input name="chiave[]" type="radio" value="nome" checked>nome</div></td>
                
                
                </tr>
     </table>
</div>
</tr>	
	</table>
<div data-role="popup" id="positionWindow" class="ui-content" data-theme="a">

</div>

<div id="tabProgetti">
	   
         
<?php
$db = new DB_API();

$res = $db->getProjectFromStateId(1); // 1 = stato registrazioni aperte
if($res != NULL){
$strInfo ="";

//print_r($res);

foreach($res as $value){
	//print_r($value); 
	echo "<form action=\"javascript:void(0)\"><table>";
$clusters = $db->getProjectCluster($value['idProgetto']);
$tags = $db->getProjectTag($value['idProgetto']);
$nclusters = count($clusters);
$ntag = count($tags);
echo "
	<tr>
	<td><div class=\"info\"  onClick=\"showInfo('hide" . $value['idProgetto']. "')\" ></div> </td>
	<td><div class=\"nomeProg\">".$value['nome']."</div>";
	echo "<input type=\"hidden\" name=\"progetto\" value=\"".$value['idProgetto']."\"/></td> ";
	
	$strInfo .="<p><H2>" . $value['nome'] . "</H2><br>";
  	$strInfo .="<p>DATA INIZIO: " . $value['data_inizio'] . "<br>";
  	$strInfo .="<p>DATA FINE: " . $value['data_fine']. "<br>";
  	$strInfo .="<p>DESCRIZIONE: " .  $value['descrizione'] . "<br>";
	$strInfo .="<p>COSTO: " .  $value['costo'] . "<br>";
	
	$strInfo .= "<p>COMPETENZE:<br>";
	
	if($nclusters>0){
	foreach($clusters as $c){
		$strInfo .= "<p>" . $c['nome'] . " - difficoltà: ".$c['valore']."<br>";
		
	}
	}

	
	$a=$db->getProgrammerSignToProject($id,$value['idProgetto']);
	echo '<textarea id="hide' . $value['idProgetto'] . '" style="display:none;">'. $strInfo .'</textarea>';
	if($a == null){
		echo "<td id=\"button".$value['idProgetto']."\"><input class=\"button\" name=\"button\"  type=\"submit\" value=\"sign in\" onClick=\"clickBtn(2,".$value['idProgetto'].");\"/></td>";
	}else{
		echo "<td id=\"button".$value['idProgetto']."\"><input class=\"button\" name=\"button\"  type=\"submit\" value=\"sign out\" onClick=\"clickBtn(1,".$value['idProgetto'].");\" /></td>";
	
	}
	
	
	

$strInfo = "";
echo "</tr></table></form>";

	echo '<div class="message">';
			if(isset($_GET['message'])){
				if($_GET['id'] == $value['idProgetto']){
					$message= $_GET['message'];
					if($message==1){
						echo "iscrizione avvenuta";
					}elseif($message == 2){
						echo "non sei più iscritto al progetto";
					}
				}
			}
  
		 echo ' </div>';
}
}else{
	
	echo '<div>Attualmente non ci sono progetti sulla piattaforma</div>';	
}

?>      



</div>


	
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