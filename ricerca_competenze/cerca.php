<?php
include_once dirname(__FILE__) . '/connDB/DB_API.php';

$nome = trim($_POST['nome']);
$mod = trim($_POST['modo']);
$chiave = trim($_POST['chiave']);
//$ordine = $_POST['ordine'];
/*
$nome = "calcolo";
$chiave = "data_inizio";
*/
$ordine = "ASC";

session_start();
$name=$_SESSION['nome'];
$id=$_SESSION['idProgrammatore'];

//echo $nome . "- " . $mod . " - " . $chiave;


$db = new DB_API();

$res;
if($mod == 1){
$res=$db->serchProjectByName($nome,$chiave,$ordine);
//print_r($res);
}else{
//echo "----------";

$res=$db->serchProjectByCompetenze($nome,$chiave,$ordine);
//print_r($res);
}

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
	echo '<textarea id="hide' . $value['idProgetto'] . '" style="display:none;">'. $strInfo .'</textarea>';
			
			
	$a=$db->getProgrammerSignToProject($id,$value['idProgetto']);
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
	
	echo "<div>Nessun risultato trovato per questa ricerca</div>";	
}


?>     