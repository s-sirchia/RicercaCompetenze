<?php 
include_once dirname(__FILE__) . "/../menu.php";
include_once dirname(__FILE__) . '/../connDB/DB_API.php';
session_start();
//$idPM=$_SESSION['idPM'];
if(isset($_SESSION['idPM'])) 
	$idPM = $_SESSION['idPM'];
if(isset($_SESSION['idProj']))	
	$idProj = $_SESSION['idProj'];
if(isset($_SESSION['modalita']))
	$mod = $_SESSION['modalita'];

include_once '../connDB/DB_API.php';
$db = new DB_API();


$result = $db->getProjectFromId($idProj);  //tutti i progetti del PM
$statiProgetto = $db->getAllState();	//tutti gli stati possibili di un progetto
$projectManager = $db->getPmById($idPM); // dati projectManager
$datiAnagraficiPm = $db->selectDatiAnagraficiWithID($projectManager[0]['datiAnagrafici']); //dati anagrafici del pm
$nomeProjectManager = $datiAnagraficiPm[0]['cognome']." ".$datiAnagraficiPm[0]['nome'];

$tagProgetto = $db->getProjectTag($idProj);
//$allTag = $db->getAllTag();
/*
for($i = 0;$i<count($tagProgetto);$i++){
	$tagProgetto[$i]['idcluster'] = $allTag[$i]['idcluster'];
	$tagProgetto[$i]['nome'] = $allTag[$i]['nome'];
}
*/





$nome=$result[0]['nome'];
$descrizione = $result[0]['descrizione'];
$idProj = $result[0]['idProgetto'];
$projectManager= $result[0]['projectManager'];
$stato  = $result[0]['stato'];

$data_start = $result[0]['data_inizio'];
$data_end= $result[0]['data_fine'];

?>

<html>
<head>
<script type="text/javascript">

function saveForm(event){
	var  xmlhttp=new XMLHttpRequest();
	xmlhttp.open("POST","confModifica.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	event.preventDefault();
	form = document.moduloUpdate;
	
	dataStart = form.ds.value;
	dataEnd = form.de.value;

	if(dataEnd <= dataStart){
	window.alert("La data finale prevista deve essere maggiore della data inizio prevista del progetto\nData Inizio "+dataStart+"\nData Fine "+dataEnd);
	form.ds.style.backgroundColor="red";
	form.de.style.backgroundColor="red";
	}
	else{

	
	nomeProgetto = form.nome.value;
	idProgetto = form.idP.value;
	idProjManager = form.idPM.value;
		stato = form.stato.value;
	descrizione = form.des.value;
	
	r = confirm("Il Modulo e' compilato correttamente\nLe Modifiche verrano salvate\nProcedere?");
	if(r == true){
	xmlhttp.send("nome="+nomeProgetto+
			"&idP="+idProgetto+
			"&idPM="+idProjManager+
			"&stato="+stato+
			"&des="+descrizione+
			"&ds="+dataStart+
			"&de="+dataEnd+
			"&save= ok");
			
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			window.location.assign("../estrazione_kw.php");

			}
		}
	

	}




	
}
}


function abort(){
	 var r = confirm("Annullare l'operazione?");
	 if (r == true) {
		 window.location.assign("modificaProj.php");
		}
}

function comeBack(){
	 var r = confirm("L'Operazione ti sta riportando alla pagina precedente");
	 if (r == true) {
		 window.location.assign("projects.php");
		}
}

</script>

<title>Progetto</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="main_style.css" title="wsite-theme-css" />
<style type="text/css">
.wsite-form-label:hover{background:#fff; color:#30D5C8;}
 #main-wrap tr{border-bottom:none 1px; }
 #main-wrap tr:hover{background:none; }
 .wsite-form-input{width:100%}
  .wsite-form-input-disabled{width:100%}
</style>

</head>

<body class=" no-header-page  wsite-theme-light  wsite-page-visualizzazione-progetti">
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
              <?php  menu("../"); ?>
        		</tr>
       </table>   
    </div>
</div>

<div id="topnav-wrap">
	<?php 
	 menuPM("");
?>
</div>

    

<div id="main-wrap">
    <div class="container">
        <div id="main">
        	<div id="content">


<form name = "moduloUpdate" id="moduloUpdate" action="modificaProj.php" method="POST">
<input  <?php if($mod == "view") echo "style='display:none'"?> class="button-large" type = "button"  value="Salva" onClick="saveForm(event)">
<input <?php if($mod == "view") echo "style='display:none'"?> class="button-large" type = "button" name="canc" value="Annulla" onClick="abort()">
<input class="button-large" type = 'button' name='back' value='Indietro' onClick="comeBack()">
	<table>
		<tr>
			<td><label class = "wsite-form-label" >Nome Progetto</label></td><td><input  <?php if($mod == "view") echo " class = 'wsite-form-input-disabled' disabled='disabled'";else echo"class='wsite-form-input'";?> name="nome" type ="text" value="<?php echo $nome;  ?>"> </td>
			
		
		</tr>
		<tr>
			<td><label class = "wsite-form-label">Id Progetto</label></td><td><input class="wsite-form-input-disabled" name="idP"  <?php if($mod == "mod" ) echo "readonly='readonly' "; 
																			else 
																				echo "disabled ='disabled'";  ?> type ="text" value="<?php echo $idProj;  ?>"> </td>
		</tr>
		<tr>
			<td><label class = "wsite-form-label">Project Manager</label></td><td><input class="wsite-form-input" name="idPM" type ="hidden" value="<?php echo $projectManager;  ?>">
			<input  class="wsite-form-input-disabled"  disabled="disable" type ="text" value="<?php echo $nomeProjectManager;  ?>"> </td>
		</tr>

			

		<tr>
			<td><label class = "wsite-form-label">Stato</label></td>
			<td><select   <?php if($mod == "view") echo " class= 'wsite-form-input-disabled' disabled='disabled'";
								 else echo "class='wsite-form-input'";?> name="stato" >
				<?php 
				for($i = 0;$i < count($statiProgetto);$i++){
					$idStato = $statiProgetto[$i]['idstato_progetto'];
					$nomeStato = $statiProgetto[$i]['stato'];
					if($idStato == $stato){
						echo "<option value='".$idStato."' selected='selected'>".$nomeStato."</option>";
					}else{
						echo "<option value='".$idStato."'>".$nomeStato."</option>";
					}
										
				}
				
				?>
  			 
			</select> </td>
		</tr>
			<tr>
			<td><label class = "wsite-form-label" >Tags Progetto</label></td><td><textarea  class="wsite-form-input-disabled"  name="tag" rows="5" cols="20" <?php if($mod == "mod" ) echo "readonly='readonly' "; 
																			else 
																				echo "disabled ='disabled'";  ?> ><?php  for($i = 0;$i<count($tagProgetto);$i++){
						echo"#";
						echo $tagProgetto[$i]['nome'];
						echo"\n";
					}?>
			
				</textarea></td>
		</tr>
		<tr>
			<td><label class = "wsite-form-label">Descrizione</label></td><td><textarea name="des" rows="8" cols="45" <?php if($mod == "view") echo " class = 'wsite-form-input-disabled' disabled='disabled'";
			else echo "class='wsite-form-input'"?> ><?php  echo $descrizione;?>
			
				</textarea></td>
		</tr>
		<tr>
			<td><label class = "wsite-form-label">Data inizio prevista</label></td><td><input  name="ds" <?php if($mod == "view") echo "class = 'wsite-form-input-disabled' disabled='disabled'"; else echo "class='wsite-form-input'";?> type ="date" value="<?php echo $data_start;  ?>"> </td>
		</tr>
		<tr>
			<td><label class = "wsite-form-label">Data finale prevista</label></td><td><input  name="de" <?php if($mod == "view") echo " class = 'wsite-form-input-disabled' disabled='disabled'"; else echo "class='wsite-form-input'";?>  type ="date" value="<?php echo $data_end;  ?>"> </td>
		</tr>
			
	
	</table>




</form>

</div>
		</div>
	</div>
</div>
<div style="padding-top:80px; background:#fff;"></div>
<div id="footer-wrap">
	<div class="container">
		<div id="footer"></div>
    </div>
</div>
</body>
</html>

