<?php
require_once dirname(__FILE__) . "/connDB/DB_API.php";
$user = $_POST['user'];
$pass = $_POST['pass'];

$db = new DB_API();

$res = $db->getProgrammatoreFromLogin($user,$pass);
$res2 = $db->getPMFromLogin($user,$pass);

if($res== null && $res2==null){
//echo "autenticazione fallita";
header("Location: login.php?message=1");
}else{
	if($res!=null){
//echo "autenticazione riuscita";	
//apro la sessione e ridirigo sulla bacheca che visualizza i progetti
session_start();
//print_r($res);
$dati = $db->selectDatiAnagraficiWithID($res[0]['datiAnagrafici']);
//print_r($dati);

$name=$dati[0]['nome'];
$id=$res[0]['idProgrammatore'];

$_SESSION['nome'] = $name;
$_SESSION['idProgrammatore'] = $id;
$_SESSION['active']   = true; 

header("Location: homeProgrammatore.php");		
	}
	else{
		session_start();
		
		$dati = $db->selectDatiAnagraficiWithID($res2[0]['datiAnagrafici']);
		$name=$dati[0]['nome'];
		$id=$res2[0]['idProject_Manager'];
		$_SESSION['nome'] = $name;
		$_SESSION['idPM'] = $id;
		$_SESSION['active']   = true; 
		
		header("Location: ./viewProjects/projects.php");
	}
}



?>