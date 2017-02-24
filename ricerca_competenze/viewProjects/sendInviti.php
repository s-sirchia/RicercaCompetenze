<?php
session_start();
if(isset($_SESSION['idPM'])) 
	$idPM = $_SESSION['idPM'];
if(isset($_SESSION['idProj']))	
	$idProj = $_SESSION['idProj'];
if(isset($_SESSION['idProg']))	
	$idProg = $_SESSION['idProg'];
	
include_once '../connDB/DB_API.php';
$db = new DB_API();
//DA CONTROLLARE
$idChiusura = 2;
for($i=0;$i<count($idProg);$i++){
	if($db->getInvito($idProg[$i])!=null)
		continue;
	$db->setInvito($idProg[$i],$idProj);
}
$db->updateProjectStatus($idProj,$idChiusura);
//DA CONTROLLARE
header( 'Location: projects.php' ) ;
?>