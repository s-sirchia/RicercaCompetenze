<?php

	session_start();
include_once '../connDB/DB_API.php';

if(isset($_SESSION['idProj']))	
	$idProj = $_SESSION['idProj'];
//print($idProj);
$db = new DB_API();

$db->deleteProject($idProj);


header("Location: projects.php");

?>