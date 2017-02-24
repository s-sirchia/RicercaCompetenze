<?php
include_once dirname(__FILE__) . '/connDB/DB_API.php';
include_once dirname(__FILE__) . '/connDB/dbconn.php';
require_once("./util.php");

session_start();

$db=new DB_API();

$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$data=$_POST['data'];
$citta=$_POST['citta'];
$via=$_POST['via'];
$cap=$_POST['cap'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$user=$_POST['user'];
$password=$_POST['psw'];
$linkedin=$_POST['link'];
$costo=$_POST['costo'];

$ruolo=$_POST['ruolo'];




$ris=$db->selectMail($email); // per vedere se la mail è già in uso
if(count($ris)!=0){
	header("Location: registrazione_programmatore.php?mes=1");
}
else{
	$ris2=$db->selectUser($user); // per vedere se user è già in uso
if(count($ris2)!=0){
	header("Location: registrazione_programmatore.php?mes=2");
}
else{
	$db->insertDatiAnagrafici($nome, $cognome, $data, $citta ,$via, $cap, $telefono, $email);
	$idDatiAnagrafici=$db->selectDatiAnagrafici($nome,$cognome,$email);

$db->insertLogin($user,$password);
$idLogin=$db->selectLogin($user,$password);


		if($ruolo=='Programmatore'){ //inserisco nella tabella programmatori
			$db->insertProgrammatore($idDatiAnagrafici[0]['idDati_Anagrafici'], $idLogin[0]['idLogin'], $costo, 0, $linkedin);
			$idReg=$db->getIdProgrammatore($idDatiAnagrafici[0]['idDati_Anagrafici']);
			$idReg=$idReg[0]['idProgrammatore'];
			$_SESSION['idProgrammatore']=$idReg;
			
		}
		else{ //inserisco nella tabella PM
			$db->insertPM($idDatiAnagrafici[0]['idDati_Anagrafici'], $idLogin[0]['idLogin']);
			$idReg=$db->getPMFromIDLogin($idLogin[0]['idLogin']);
			$idReg=$idReg[0]['idProject_Manager'];
			$_SESSION['idPM']=$idReg;
		}		



$tidy = tidy_parse_file($linkedin, array('output-xhtml' => true, 'clean' => true, 'wrap-php' => true));

// Load XSLT stylesheet
$xsl = new DOMDocument;
$xsl->load('competenze.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); 


// determining if output is html document
$toReturn = new DOMDocument;
@$toReturn->loadHTML($tidy);
$toReturn->saveHTML();

$str =  $proc->transformToXML($toReturn); 
$dom=new DOMDocument;
$dom->loadXML($str);
$competenze= $dom->getElementsByTagName('tr');

foreach($competenze as $nodoCompetenza){
	$competenza=$nodoCompetenza->nodeValue;
	$linguaggi=$db->getIdLenguagesByName($competenza);
	if(count($linguaggi)!=0)
		foreach($linguaggi as $linguaggio)
			$db->insertProgrammatoreLanguages($linguaggio['idLinguaggio'],$idReg);
	
}

$db->computeCompetenze($idReg);


$_SESSION['nome']=$nome;
$_SESSION['active']=true;
header("Location: index.php?message=3");

}
}


?>