<?php
$val = $_POST['val'];
$idProg = $_POST['idProg'];
$idProj = $_POST['idProj'];

include_once '../connDB/DB_API.php';
$db  = new DB_API();

$oldExp = $db->getEsperienza($idProg);

$newExp = $oldExp[0]['esperienza']+$val;

$db->updateEsperienza($idProg,$newExp);

$db->updateReceivedFeedback($idProg,$idProj);

//header("Location: visualizza_partecipanti.php");
?>