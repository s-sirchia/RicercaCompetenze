<?php
include_once './AlgoritmoGreedy/AlgoritmoV2.php';
include_once './connDB/DB_API.php';
include_once './connDB/dbconn.php';
$db=new DB_API();
$idProgetto=$_GET['programma'];
$idProgrammatore = $_GET['programmatore'];
$algoritmo=new Algoritmo($idProgetto);
$db->removeInvito($idProgrammatore,$idProgetto);
$db->deleteProgrammerSign($idProgrammatore,$idProgetto);
$db->updateProjectStatus($idProgetto,1);
$algoritmo->compute();
header("Location: inviti.php");
?>