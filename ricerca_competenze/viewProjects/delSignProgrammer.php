<?php
include_once '../connDB/DB_API.php';
if(isset($_POST['delSign'])){
	
	$db = new DB_API();
	$idProgrammatori = $_POST['programmer'];
	$idProj = $_POST['idProj'];
	//echo $idProj;
	/*for($i = 0;$i<count($idProgrammatori);$i++){
		//echo $idProgrammatori[$i];
		$idProg = $idProgrammatori[$i];
		//echo $idProg . " - " . $idProj;
		$db->deleteProgrammerSign($idProg,$idProj);
	}*/
	$idRange = "";
	$i = 0;
	for(;$i<count($idProgrammatori) - 1;$i++){
		$idRange .=$idProgrammatori[$i] . ",";
		
	}
	$idRange .=$idProgrammatori[$i];
	$db->deleteProgrammerSignRange($idRange,$idProj);
		
header("location: manageSign.php");
	
	
	
	
}

?>

