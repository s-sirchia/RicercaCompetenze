<?php

class Util{

public function __construct(){
	 $this->GenericError= 1;
	 $this->AutenticationError = 2;
	 
}

function checkActive($dir){
if($_SESSION['active']==false){
header("Location: ".$dir."login.php?message=".$this->AutenticationError."");	
}	
}

function checkActiveProgrammatore($dir){
	$this->checkActive($dir);
	if(!isset($_SESSION['idProgrammatore'])){
		header("Location: ".$dir."index.php?message=".$this->AutenticationError."");	
	
	}
	
}

function checkActivePM($dir){
	$this->checkActive($dir);
	if(!isset($_SESSION['idPM'])){
		header("Location: ".$dir."index.php?message=".$this->AutenticationError."");	
	
	}
	
}


function isPM(){
	if(!isset($_SESSION['idPM']))
		return false;
	return true;
	
	
}

function isProgrammatore(){

	if(!isset($_SESSION['idProgrammatore']))
		return false;
	return true;
	
}


}

?>