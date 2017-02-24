<?php
include_once 'DB_API.php';

$db = new DB_API();
/*
$res = $db->getProgrammatoreLanguages(52);
print_r($res);*/
//$db->computeCompetenze(52);
$db->deleteProgrammerSign(61,3);
?>