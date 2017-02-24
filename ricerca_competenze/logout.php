<?php
session_start();
if(isset($_SESSION['active'])){
	$_SESSION['nome'] = NULL;
	$_SESSION['active']   = false; 
	if(isset($_SESSION['idPM']))
	$_SESSION['idPM']= NULL;
	if(isset($_SESSION['idProgrammatore']))
	$_SESSION['idProgrammatore']= NULL;
}
session_destroy();
header("Location: index.php");	

?>