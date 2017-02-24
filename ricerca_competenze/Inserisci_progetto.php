<?php
if(!isset($_POST['categoria'])){
	header("Location: inserimento_progetto.php?message=5");
}else{
require_once dirname(__FILE__) . ( "/connDB/DB_API.php" );
$categorie=$_POST['categoria'];
$nomeProgetto=$_POST['nome'];
$descrizione=$_POST['descrizione'];
$dataInizio=$_POST['dataInizio'];
$dataFine=$_POST['dataFine'];
$numeroTeam=$_POST['numeroTeam'];
$fondi=$_POST['fondi'];
//$sizelinguaggi=count($linguaggi);
$sizecategorie=count($categorie);

session_start();

$idpm=$_SESSION['idPM'];

$idstato=1;
$db=new DB_API();


$descrizione = str_replace("'"," ",$descrizione);

$idpr = $db->getProjectFromNamePM($nomeProgetto,$idpm);
if ($idpr!=null){

	header("Location:./viewProjects/projects.php");
}else{
$db->insertProject($idpm,$idstato,$nomeProgetto,$descrizione,$dataInizio,$dataFine,$numeroTeam,$fondi);
$idpr = $db->getProjectFromNamePM($nomeProgetto,$idpm);
$_SESSION['idProj']=$idpr[0]['idProgetto'];



$str = "";
$i=0;
for(  ;$i < count($categorie)-1; $i++){
	$str .= "'" . $categorie[$i] . "',";
}
$str .= "'" . $categorie[$i]. "'";
//echo $str;
$resId = $db->getIDClusterByName($str);

//riuso str
$str = "";
foreach($resId as $value){
	$str .= "(" . $idpr[0]['idProgetto'] . "," . $value['idcluster'] . "),";
}
$str = substr($str,0,strlen($str)-1);


$db->insertProjectTagMultiple($str);	


header("Location: estrazione_kw_2.php");
}
}

?>