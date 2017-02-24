<?php

require_once dirname(__FILE__) . "/apiJena.php";

$apij = new ApiJena("http://localhost:3030/antologiaGPS/sparql");

//$res = $apij->getAllKey();
$res = $apij->getClusterFromLanguage("c++");
print_r($res);
foreach ($res as $value){
	echo $value . "\n";
}


//print_r($res);

?>