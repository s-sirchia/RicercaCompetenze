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
$descrizione = strtolower($descrizione);
$validKeyWords=extractValidKeyWords($descrizione,$keywords);

$software= array();


/*Risalgo al software dalle parole chiave*/
foreach($validKeyWords as $kw){
	//echo $kw;
	//echo "<br>";
	$software[]=$jena->getSoftwareFromTag($kw);
}

//echo "----------------<br>";

$cluster=array();

/*Raggruppo risalgo ai cluster*/
foreach($software as $sw){
	foreach($sw as $key){
			$arr = $jena->getClusterFromSoftware($key);
			foreach($arr as $val)	
					$cluster[] = $val;
		
		
	}
	//print_r($sw);
	//echo "<br>";
}



$tagCluster= $db->getProjectTag($idpr);
$clusterTag = array();


foreach($tagCluster as $value){
	
		$clusterTag[]=$value['nome'];
	
	
}


//ora ho due array con cluster
// $clusterTag che ha i cluster presi dai tag
// $cluster che ha i cluster a cui si è risaliti dalle parole chiavi  (parole chiavi-> software -> cluster)

//ora si calcolerà il valore in base a quante volte compare un cluster nell'array $cluster vi si aggiungeranno i cluster
//di $tagCluster
//i cluster di $tagCluster verranno aggiunti all'array $cluster e varranno 2 punti
//i cluster con valore >= 2 verranno inseriti nel progetto
$clusterFinale = array();

//cominciamo assegnando i valori dei cluster dell'array $cluster
foreach($cluster as $key){
	if(array_key_exists($key,$clusterFinale)){
		//la chiave con questo nome del cluster già esiste quindi lo incremento di 1
		$clusterFinale[$key] +=1;
	}else{
		//la chiave non esiste e la aggiungo dandovi valore 1
		$clusterFinale[$key] =1;
	}
		
}

$valoreTag = 2;

//ora assegnamo i valori ai cluster leggendo i cluster nell'array $tagCLuster
foreach($clusterTag as $key){
	if(array_key_exists($key,$clusterFinale)){
		//la chiave con questo nome del cluster già esiste quindi lo incremento di 1
		$clusterFinale[$key] +=$valoreTag;
	}else{
		//la chiave non esiste e la aggiungo dandovi valore 1
		$clusterFinale[$key] =$valoreTag;
	}
		
	
}
//print_r($clusterTag);
//print_r($cluster);

//print_r($clusterFinale);

//sort dell'array con i cluster per valore crescente
asort($clusterFinale);

//print_r($clusterFinale);
$totalCluster = array();
//se il cluster ha valore >= 2 viene preso
foreach($clusterFinale as $key =>$value){
	if($value >=$valoreTag){
		$totalCluster[] = $key;
	}
}
//print_r($clusterFinale);
//print_r($totalCluster);


foreach ($totalCluster as $value){
		
		
			$id =  $db->getIDClusterFromNome($value);
				
	

			if($id == null){
				//inserisco il nuovo cluster nel db
				$db->insertCluster($value);
			}
			
			
			$db->computeClusterDifficoulty($value,$idpr);
			
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

