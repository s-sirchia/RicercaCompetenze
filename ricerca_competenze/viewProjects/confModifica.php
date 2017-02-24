<?php 
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


//aggiunta modifica nel database
if (isset($_POST['save'])){
	
	$flag=false;
	
	$nome = $_POST['nome'];
	$idP = $_POST['idP'];
	$idPM = $_POST['idPM'];
	$state = $_POST['stato'];


	$des = $_POST['des'];
	$dateS = $_POST['ds'];
	$dateE = $_POST['de'];

	$oldProj = $db->getProjectFromID($idProj);
	$oldDescr= $oldProj[0]['descrizione'];

	if(strcmp($oldDescr,$des)!=0){
		print("ok");
		$flag=true;
	}
	
	$db->updateProject($idP,$idPM, $state,$nome, 
			$des,$dateS,$dateE, null, null);
		
	
	if($flag==true){
		
		$db->deleteProjectCluster($idProj);
		//header("Location: ../estrazione_kw.php");
	}

	
}


	


?>