<?php

include_once 'connDB/DB_API.php';
include_once 'connDB/dbconn.php';

$idProgrammatore=$_GET['programmatore'];
$idProgetto=$_GET['programma'];

$db=new DB_API();

$db->removeInvito($idProgrammatore,$idProgetto);

$db->setOnWorking($idProgrammatore,$idProgetto);

header("location:inviti.php");
?>