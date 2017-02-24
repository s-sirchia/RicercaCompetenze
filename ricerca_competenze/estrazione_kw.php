<?php

function queryKW() {
	
	require_once( "./sparqlAPI/sparqllib.php" );
 
$db = sparql_connect( "http://localhost:3030/ontologia/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$sparql = "SELECT ?x WHERE{ ?y <http://www.competenze.com/ontologia#valore> ?x}";
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 
$fields = sparql_field_array( $result );
 
$keywords=[];
$i=0;
while( $row = sparql_fetch_array( $result ) )
{
	foreach( $fields as $field )
	{
		$keywords[$i]=$row[$field];
		$i++;
		
	}
}
	
return $keywords;	
}


session_start();

include_once './sparqlAPI/apiJena.php';
include_once './connDB/DB_API.php';
include_once './connDB/dbconn.php';

$db=new DB_API();

$idpr=$_SESSION['idProj'];
$result=$db->getProjectFromID($idpr);
$descrizione=$result[0]['descrizione'];
$jena=new apiJena("http://localhost:3030/ontologia/sparql");

/*Query di tutte le parole chiavi dall'ontologia*/
$keywords=queryKW();


/*Estrazione delle parole chiavi valide dalla descrizione*/
$validKeyWords=extractValidKeyWords($descrizione,$keywords);

$software= array();


/*Risalgo al software dalle parole chiave*/
foreach($validKeyWords as $kw){
	//echo $kw;
	//echo "<br>";
	$software[]=$jena->getSoftwareFromTag($kw);
}
$hashOfCluster = array();
//echo "----------------<br>";

$cluster=array();

/*Raggruppo in una mappa i software ricavati*/
foreach($software as $sw){
	foreach($sw as $key){
			$cluster[]= $jena->getClusterFromSoftware($key);

		
	}
	//print_r($sw);
	//echo "<br>";
}
$tagCluster= $db->getProjectTag($idpr);
foreach($tagCluster as $value){
	$cluster[]=array($value['nome']);
}
/*Ordino per grandezza e risalgo ai cluster dei primi due*/
foreach($cluster as $cl){
	foreach($cl as $key){
		if(array_key_exists($key,$hashOfCluster)){
			
			
				$hashOfCluster[$key]+=1;
		}
		else{
			
			
				$hashOfCluster[$key]=1;
			
		}
	}
}

arsort($hashOfCluster);

$totalCluster = array();
		
	//questa parte prende i DUE cluster con valore più alto	
	$totalCluster[0]= key($hashOfCluster);
	next($hashOfCluster);

	$totalCluster[1]= key($hashOfCluster);
	
	
	
	

//$count=0;
//$totalCluster= array_unique($totalCluster,SORT_REGULAR);
$unique= array();



foreach ($totalCluster as $value){
		
		if(in_array($value,$unique))
			continue;
		else{
			$id =  $db->getIDClusterFromNome($value);
				
	

			if($id == null){
				//inserisco il nuovo cluster nel db
				$db->insertCluster($value);
			}
			//print_r($id[0]['idcluster']."id di ".$cl."<br>");
			$unique[]= $value;
			//$idcl= $db->getIDClusterFromNome($cl);
			$db->computeClusterDifficoulty($value,$idpr);
			//$db->insertProjectCluster($idcl,$idpr);
			//$count+=1;
		}
	}

//echo "Numero cluster trovati: ".$count;
//echo "<br>------------------------";


header("Location: ./viewProjects/projects.php");







function extractValidKeyWords($descr,$kw){
	$descr=$descr.'\f'; //append del carattere di fine descrizione
	$l=strlen($descr);
	$word="";
	$character='';
	$validKW=[];
	$nextKW=0;
	for($i=0; $i<$l; $i++){
	   $character = $descr[$i];
	   if($character=='\\') 
		   $character=$character.$descr[$i+1];
	   if($character == ' ' || $character == '\n' || $character == '.'||  $character == ';' || $character == ',' || $character == '\f'|| $character == ':'){
		  			
			$answer = isValidKeyWord($word,$kw,$validKW,$descr[$i]);
			//print ($word."---".$answer);
			if($answer==0){			//matching esatto
				$validKW[$nextKW]=$word;
				$nextKW+=1;
			}
			else if($answer==1){    //sottostringa di una keyword
			
				$word=$word." ";
				continue;
			}
						
			$word="";
	   }
	   else
			$word=$word.$character;
	  	
	}
	return $validKW;
}

function isValidKeyWord($word,$keywords,$validKW,$nextChar){
	
	$answer=-1;
	$l=strlen($word);
	if(substr($word,0,1)==' '){				//Questo è necessario nel caso in cui la parola inizia con un blank (esempio le parole dopo la punteggiatura)
		$word=substr($word,1,$l);
		$l-=1;
	}
		foreach($keywords as $kw )
	{
		if(strtolower($kw)==strtolower($word)){
			$answer=0;
		}
		else if(substr(strtolower($kw),0,$l)==strtolower($word)){
			//print(substr(strtolower($kw),0,$l));
			
			if(substr(strtolower($kw),0,$l+1)==strtolower($word.$nextChar))	
				$answer=1;
			else
				$answer=-1;
		
		}
	}
	if($answer==0) //Looking for repetitions
	{
		foreach($validKW as $vkw)
		{
			if(strtolower($vkw)==strtolower($word))
				$answer=-1;
		}
	}
	return $answer;
}

?>

