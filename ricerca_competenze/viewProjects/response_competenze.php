<?php
include_once dirname(__FILE__) . "/../connDB/DB_API.php";
$id=0;
if(isset($_POST['id'])){
	$id=$_POST['id'];
}
$id = trim($id);
$db = new DB_API();
$clusters = $db->getProgrammatoreClustersName($id);

if($clusters == NULL){
echo "-1";	
}else{
$arr = array();
foreach($clusters as $cluster){
	foreach($cluster as $value){
		$arr[] = $value;
	}
}

echo json_encode($arr);
}
?>