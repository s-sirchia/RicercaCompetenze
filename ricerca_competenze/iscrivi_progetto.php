<?php 
require_once dirname(__FILE__) . '/connDB/DB_API.php';
session_start();
$name;
$id;
if($_SESSION['active']){
$name=$_SESSION['nome'];
$id=$_SESSION['idProgrammatore'];
}else{
header("Location: login.php?message=2");	
}


$progetto= $_POST['progetto'];
$button= $_POST['button'];
$db = new DB_API();
//echo $progetto . " - " . $button . " - "  . $name . " - " . $id; 
if($button=="sign in"){
	$date = date_create()->format('Y-m-d');
	//echo $id ." ".$progetto ." ".$date;
	$db->signProgrammerToProject($id,$progetto,$date,0);
	echo "<input class=\"button\" name=\"button\"  type=\"submit\" value=\"sign out\" onClick=\"clickBtn(1,".$progetto.");\" />";
	//header("Location: homeProgrammatore.php?message=1&id=".$progetto."");
}else if($button=="sign out"){
	$db->removeProgrammerToProject($id,$progetto);
	if(isset($_POST['pag'])){
	header("Location: progetti_programmatore.php");
	}else{
		echo "<input class=\"button\" name=\"button\"  type=\"submit\" value=\"sign in\" onClick=\"clickBtn(2,".$progetto.");\"/>";

	}
}

?>