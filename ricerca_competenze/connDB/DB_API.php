<?php
require_once dirname(__FILE__) . '/dbconn.php';
require_once dirname(__FILE__) . '/../sparqlAPI/apijena.php';
const Deltagiorni=10;
class DB_API extends Connection{


    private $endPoint="http://localhost:3030/ontologia/sparql";

	
	
////////////////////////////////LOGIN	
	
function insertLogin($username,$password){
		
		$query = "INSERT INTO login (idLogin, username, password) 
				VALUES (NULL, '$username', '$password')";
		
		$this->query($query,0);
		
		
	}
	
	
	function selectAllLogin(){
		
		$query = "
				SELECT * FROM  login";
		
		return $this->query($query,1);
	
	
	
	}
	
	function selectLogin($username,$password){
		
		
		$query = "SELECT * FROM login WHERE username='$username' and password='$password'";
		
		
		return $this->query($query,1);
		
	
	}
	
	//INSERITO 
	function selectUser($username){
		
		
		$query = "SELECT * FROM login WHERE username='$username'";
		
		
		return $this->query($query,1);
	}
	
	function updateLogin($idLogin,$username,$password){
		
		
		$query = "UPDATE login
					SET
					username= '$username',
					password = '$password'
					WHERE idLogin = '$idLogin'";

		$this->query($query,0);
	}
	
	
	function deleteLogin($idLogin){
		
		
		$query="DELETE FROM login
		WHERE idLogin = '$idLogin'";
		
		$this->query($query,0);
	}
	
	

	
////////////////////////////DATI ANAGRAFICI

	function insertDatiAnagrafici($nome, $cognome, $dataNascita, $city,$via, $cap, $phone, $email){
		
		
		
		$query = "INSERT INTO dati_anagrafici (idDati_Anagrafici, nome, cognome, data_nascita, citta,via, cap, telefono, email) 
				VALUES (NULL,'$nome', '$cognome', '$dataNascita', '$city','$via', '$cap', '$phone', '$email')
				";
		$this->query($query,0);
	}
	
	
	
	function selectDatiAnagrafici($nome,$cognome,$mail){
	
	
		$query = "SELECT * FROM dati_anagrafici WHERE nome='$nome' and cognome='$cognome' and email='$mail'";
	
	
		return $this->query($query,1);
	
	
	}
	
	//INSERITO
	function selectMail($mail){
	
	
		$query = "SELECT * FROM dati_anagrafici WHERE email='$mail'";
	
	
		return $this->query($query,1);
	
	
	}
	
	
	function selectDatiAnagraficiWithID($id){
	
	
		$query = "SELECT * FROM dati_anagrafici WHERE idDati_Anagrafici='$id'";
	
	
		return $this->query($query,1);
	
	
	}
	
	
	
	
/////////////////////////PROGRAMMATORE	


	function getEsperienza($idProgrammatore){
		$query = "SELECT esperienza FROM programmatore WHERE idProgrammatore = '".$idProgrammatore."'";
		return $this->query($query,1);
	}
	
	function updateEsperienza($idProgrammatore, $esperienza){
		$query = "UPDATE programmatore SET esperienza='$esperienza' WHERE idProgrammatore = '".$idProgrammatore."'";
		return $this->query($query,0);
	}
	

	
	function getIdProgrammatore($idDati){
		$query = "SELECT * FROM programmatore WHERE datiAnagrafici = '".$idDati."'";
		return $this->query($query,1);
	
	}
	
	
	
	function insertProgrammatore(  $datiAnagrafici, $login, $costo_ora, $esperienza, $linkedin){
		$query="
		INSERT INTO programmatore 
				(idProgrammatore, datiAnagrafici, login, costo_ora, esperienza, linkedin) 
				VALUES (NULL, '$datiAnagrafici', '$login', '$costo_ora', '$esperienza', '$linkedin');		
				
				";
		$this->query($query,0);
	
	}
	
	function getProgrammatore($idProgrammatore){
		$query="SELECT * FROM programmatore WHERE idProgrammatore = '".$idProgrammatore."'";
		$programmatore = $this->query($query,1);

		$datiProgrammatore = $this->getDatiProgrammatore($programmatore[0]['datiAnagrafici']);
		return array_merge($programmatore,$datiProgrammatore);
		
	
	}
	function getProgrammatoreSenzaMerge($idProgrammatore){
		$query="SELECT * FROM programmatore WHERE idProgrammatore = '".$idProgrammatore."'";
		return $this->query($query,1);

		
		
	
	}
	function getDatiProgrammatore($idDati){
		$query = "SELECT * FROM dati_anagrafici WHERE idDati_Anagrafici = '".$idDati."'";
		return $this->query($query,1);
	
	}
	
	
	//prendo tutti i progetti a cui è iscritto il programmatore
	function getProgrammerSignToAllProjects($idProgrammer){
		$query = "SELECT progetto.* FROM progetto,programmatore_iscritto_progetto where Programmatore_idProgrammatore = ".$idProgrammer." and progetto.idProgetto = Progetto_idProgetto";
		return $this->query($query,1);
	
				
	}
	
	
/////////////////////////////PROJECT MANAGER

	function insertPM($Dati_Anagrafici_idDati_Anagrafici,$Login_idLogin){
		
		
		$query="
		INSERT INTO project_manager (idProject_Manager, datiAnagrafici, login) VALUES (NULL,'$Dati_Anagrafici_idDati_Anagrafici','$Login_idLogin')
		";
		$this->query($query,0);
		
	}
	
	
	function selectAllPM(){
		
		$query = "SELECT * FROM project_manager";
		
		return $this->query($query,1);
		
	}
	
	function getPMFromIDLogin($idlogin){
		$query="SELECT * FROM `project_manager` WHERE login='$idlogin'
				";
		return $this->query($query,1);
	}
	
	function getPMFromLogin($user,$pass){
		
		$query="SELECT project_manager.* FROM project_manager,login WHERE username='$user' AND password='$pass' AND project_manager.login=login.idLogin";
		return $this->query($query,1);
		
	}
	
	
	
	function getPmById($id){
		$query = "SELECT * FROM project_manager WHERE idProject_Manager = '".$id."'";
		$result = $this->query($query,1);
		
		return $result;
		
	}
	
		
	
	
	
///////////////////////////////PROGETTO

  function getAllRecentlyProjects($limit){
	  
	  $query = "SELECT * FROM progetto WHERE stato=1 ORDER BY data_inizio DESC LIMIT ".$limit." ";
		
		return $this->query($query,1);
	  
  }
	
	
	function insertProject($Project_Manager_idProject_Manager, $stato,$nome, $descrizione,$data_inizio,$data_fine, $num_membri, $costo){
	
	
		$query="INSERT INTO progetto
		 (idProgetto, projectManager,stato, nome, descrizione,data_inizio,data_fine, num_membri, costo) 
		 VALUES (NULL,'$Project_Manager_idProject_Manager', '$stato', '$nome', '$descrizione','$data_inizio','$data_fine', '$num_membri', '$costo')";
		$this->query($query,0);
	}
	
	
	function getAllProject(){
	
		$query = "	SELECT * FROM progetto ";
		
		return $this->query($query,1);
		
	}
	
	function getAllPmProject($idPm){
		
		$query = "SELECT * FROM progetto WHERE projectManager = '$idPm' ";
		
		return $this->query($query,1);
		
	}
	
	function getProjectFromID($id){
		$query = "	SELECT * FROM progetto
				WHERE idProgetto= '$id' ";
		
		return $this->query($query,1);
		
		
	}
	
	function getProjectFromNamePM($nome,$idpm){
		$query = "	SELECT * FROM progetto
				WHERE projectManager= '$idpm' AND nome='$nome'";
		
		return $this->query($query,1);
	}
	
	
	
	function updateProject($idProgetto,$Project_Manager_idProject_Manager, $stato,$nome, $descrizione,$data_inizio,$data_fine, $num_membri, $costo){
	
	
		$query = "UPDATE progetto
		SET
		idProgetto='$idProgetto',
		projectManager='$Project_Manager_idProject_Manager',
		stato='$stato',
		nome='$nome', 
		descrizione='$descrizione',
		data_inizio='$data_inizio',
		data_fine='$data_fine',
		num_membri='$num_membri',
		costo='$costo'
		WHERE idProgetto = '$idProgetto'";
	
		$this->query($query,0);
	}
	
	
	function deleteProject($id){
	
	
		$query="DELETE FROM progetto
		WHERE idProgetto= '$id' ";
	
		$this->query($query,0);
	}
	
	function getProjectFromStateId($idStato){
		$query = "	SELECT * 
					FROM progetto
					WHERE stato= '$idStato' ";
		
		return $this->query($query,1);
		
	}
	
	function getProjectPMFromStateId($idStato,$idPM){
		$query = "	SELECT * 
					FROM progetto
					WHERE stato= '$idStato' AND projectManager = ".$idPM." ";
		
		return $this->query($query,1);
		
	}

/////////////////////////PROGETTO HAS CLUSTER
	
	function getProjectCluster($idProject){
		$query = "
				SELECT cluster.nome,progetto_has_cluster.valore FROM cluster,progetto_has_cluster WHERE progetto_idProgetto='$idProject' AND idcluster = progetto_has_cluster.cluster_idcluster
				";
	
		return $this->query($query,1);
	}

	
	
	
	function insertProjectCluster($idcluster,$idProject,$valore){
		$query="
		INSERT INTO progetto_has_cluster
		(cluster_idcluster,progetto_idProgetto,valore)
		 VALUES ('$idcluster','$idProject','$valore')";	
		$this->query($query,0);
	}
	
	function deleteProjectCluster($idProject){
		$query="
		DELETE FROM progetto_has_cluster
		WHERE progetto_idProgetto='$idProject'
		";	
		$this->query($query,0);
	}
	
//////////////////////////////PROGRAMMATORE HAS LINGUAGGIO


    function getProgrammatoreLanguages($idProg){
    
    	$query="SELECT linguaggio.nome
    	FROM programmatore_has_linguaggio, linguaggio
    	WHERE programmatore_has_linguaggio.Programmatore_idProgrammatore='$idProg' AND programmatore_has_linguaggio.Linguaggio_idLinguaggio=linguaggio.idLinguaggio";
    
    	return $this->query($query,1);
    }
	
	function insertProgrammatoreLanguages($idLinguaggio,$idProgrammatore){
		$query="
				INSERT INTO programmatore_has_linguaggio
				 (Linguaggio_idLinguaggio, Programmatore_idProgrammatore)
				  VALUES ('$idLinguaggio','$idProgrammatore');
				
				";
		
		$this->query($query,0);
	}
	
	
	function getProgrammatoreFromLogin($user,$pass){
		
			$query="SELECT programmatore.* FROM programmatore,login WHERE login.username='$user' AND login.password='$pass' AND programmatore.login=idLogin";
			return $this->query($query,1);
		
		
		
	}
	
///////////////////////////////////////////////////LINGUAGGIO

	function insertLinguaggio($nome){
		$query="
		INSERT INTO linguaggio (idLinguaggio, nome) VALUES (NULL, '$nome');
		";
		
		$this->query($query,0);
		
	}
	
	function getIdLenguagesByName($nomeLinguaggio){
		$query=" SELECT * FROM linguaggio WHERE nome='$nomeLinguaggio'";
		return $this->query($query,1);
		
	}
	
	
//////////////////////////////////////////////////CLUSTER
	
	function insertCluster($nome){
		$query="
		INSERT INTO cluster (idcluster, nome) VALUES (NULL, '$nome');
		";
	
		$this->query($query,0);
	
	}
	
	function getCluster($id){
		$query="
		 SELECT *
		 FROM cluster
		 WHERE idcluster='$id'
		";
		
		
		return $this->query($query,1);
	}


	function getIDClusterByName($nome){
		$query="
		 SELECT idcluster FROM `cluster` WHERE nome in (".$nome.")
		";
		
		
		return $this->query($query,1);
	}
///////////////////////////////////////STATO PROGETTO
	
		function updateProjectStatus($idProgetto,$stato){
			$query = "UPDATE progetto
						SET
						stato='$stato'
						WHERE idProgetto = '$idProgetto'";
							
						$this->query($query,0);
		}
   
	
	
	function insertStatoProgetto($stato){
		$query="
		INSERT INTO stato_progetto (idstato_progetto, stato) VALUES (NULL, '$stato');
		";
	
		$this->query($query,0);
	
	}
	
	
	function getAllstate(){
		$query="
		SELECT *
		FROM stato_progetto
		";
		
		
		return $this->query($query,1);
	}
	

	function getStato($id){
		$query="
		SELECT *
		FROM stato_progetto
		WHERE idstato_progetto='$id' 
		";
		
		
		return $this->query($query,1);
	}
	
	////////////////////// TAG


	function getAllTag(){
		$query = "SELECT * FROM cluster";
		return $this->query($query,1);
		
	}
	
	
	////////////////////PROGETTO HAS TAG
	
	
	
	
	
	function getProjectTag($idProject){
		$query = "SELECT cluster.nome 
				  FROM progetto_has_tag,cluster
				  WHERE id_progetto = '".$idProject."' AND progetto_has_tag.id_tag=cluster.idcluster";
				  
		return $this->query($query,1);
		
	}
	
	
	
	function insertProjectTag($idProject,$idTag){
		$query = "
			INSERT INTO progetto_has_tag(id_progetto, id_tag) VALUES ('$idProject','$idTag');
		";
		return $this->query($query,1);
		
	}
	
	function insertProjectTagMultiple($str){
		$query = "
			INSERT INTO progetto_has_tag(id_progetto, id_tag) VALUES ". $str . ";
		";
		
		return $this->query($query,1);
		
	}

///////////////PROGRAMMATORE ISCRITTO PROGETTO
	
	
	function updateReceivedFeedback($idProgrammer,$idProj){
		$query = "UPDATE programmatore_iscritto_progetto
		SET recv_feedback='1'
		WHERE Programmatore_idProgrammatore = '".$idProgrammer."' AND Progetto_idProgetto = '".$idProj."'
		";
		$this->query($query,0);
	
	}
	
	
	function getReceivedFeedback($idProgrammer,$idProj){
		$query = "SELECT recv_feedback FROM programmatore_iscritto_progetto
		WHERE Programmatore_idProgrammatore = '".$idProgrammer."' AND Progetto_idProgetto = '".$idProj."'
		";
		//echo $query;
		return $this->query($query,1);
	
	}
	
	function getWorkingFromProgrammatoreIscritto($idProgrammer,$idProj){
		$query = "SELECT onWorking FROM programmatore_iscritto_progetto
		WHERE Programmatore_idProgrammatore = '".$idProgrammer."' AND Progetto_idProgetto = '".$idProj."'
		";
		//echo $query;
		return $this->query($query,1);
	
	}
	
	function deleteProgrammerSign($idProgrammer,$idProj){
			$query = "DELETE FROM programmatore_iscritto_progetto
			WHERE Programmatore_idProgrammatore = '".$idProgrammer."' AND Progetto_idProgetto = '".$idProj."'";
		//echo $query;
		$this->query($query,0);
	
	}
	
	function deleteProgrammerSignRange($idRange,$idProj){
			$query = "DELETE FROM programmatore_iscritto_progetto
			WHERE  Progetto_idProgetto = '".$idProj."'  AND Programmatore_idProgrammatore IN (" .$idRange. ")";
		//echo $query;
		$this->query($query,0);
	
	}


	function signProgrammerToProject($idProgrammer,$idProject,$date,$onWorking){
		$query = "INSERT INTO programmatore_iscritto_progetto (Programmatore_idProgrammatore, Progetto_idProgetto, data, onWorking) VALUES ('$idProgrammer','$idProject','$date','$onWorking')";
		$this->query($query,0);
		
		
			
	}
	
	function removeProgrammerToProject($idProgrammer,$idProject){
		
			$query = "DELETE FROM programmatore_iscritto_progetto WHERE Programmatore_idProgrammatore='$idProgrammer' AND Progetto_idProgetto='$idProject'";
	
			$this->query($query,0);
		
	}
	/*
	function getProgrammerSign($idProgetto){
		
		$query = "SELECT programmatore.*
				  FROM programmatore_iscritto_progetto,programmatore
				  WHERE Programmatore_idProgrammatore=idProgrammatore AND Progetto_idProgetto='.$idProgetto.'";
		return $this->query($query,1);
		
	}
	*/
	

    function getProgrammerSign($idProgetto){

        $query = "SELECT *,programmatore.costo_ora
				  FROM programmatore_iscritto_progetto,programmatore
				  WHERE programmatore_iscritto_progetto.Progetto_idProgetto = '".$idProgetto. "'AND Programmatore.idProgrammatore = programmatore_iscritto_progetto.Programmatore_idProgrammatore";
        return $this->query($query,1);

    }
	
	//controllo se il programmtore con quell' ID è iscritto al progetto
	function getProgrammerSignToProject($idProgrammer,$idProgetto){
		$query = "SELECT progetto.* FROM progetto,programmatore_iscritto_progetto where Programmatore_idProgrammatore = ".$idProgrammer." and Progetto_idProgetto=".$idProgetto."";
		return $this->query($query,1);
	
				
	}

    function getDataFineProj($id){
        $query="
        SELECT data_fine
        FROM progetto
        WHERE idProgetto='$id'
        ";

        return $this->query($query,1);
    }
	
	
	function getDataInizioProj($id){
        $query="
        SELECT data_inizio
        FROM progetto
        WHERE idProgetto='$id'
        ";

        return $this->query($query,1);
    }

    function computeCompetenze($idPersona){

        $apiSqarql = new ApiJena($this->endPoint);

        $res=$this->getProgrammatoreLanguages($idPersona);
        
        $clusters = array();
		
        foreach ($res as $language) {
			$str = strtolower($language['nome']);//perchè nell'ontologia i nomi sono lower case
            $toreturn = $apiSqarql->getClusterFromLanguage($str);

            foreach ($toreturn as $value) {
            	
				if(array_key_exists($value,$clusters)){
					$clusters[$value] +=1;
				}else{
					$clusters[$value] =1;
				}
            	
				
            }
            
            
        }

        
        foreach($clusters  as $key=>$value){
			
			$id =  $this->getIDClusterFromNome($key);
			
			if($id[0]['idcluster'] == null){
				//inserisco il nuovo cluster nel db
				$this->insertCluster($key);
				$id =  $this->getIDClusterFromNome($key);
					
			}
			//echo $id[0]['idcluster'] . " nome: " . $key; 
			
           	 $this->insertProgrammatoreClusters($idPersona,$id[0]['idcluster'],$value);
        }


    }
	
	
	function insertProgrammatoreClusters($idPersona,$idcluster,$value){
		$query="INSERT INTO programmatore_has_cluster(programmatore_idProgrammatore, cluster_idcluster, valore) VALUES ('$idPersona','$idcluster','$value')";
		$this->query($query,0);
		
	}
    
    function getIDClusterFromNome($nome){
    	
    	$query="SELECT idcluster
    			FROM cluster
    				WHERE nome='$nome'";
    	
    	return $this->query($query,1);
    	
    }
    
 
 
 
    function computeClusterDifficoulty($clusterName,$ProjectId){

        $apiSqarql = new ApiJena($this->endPoint);
		$clusterNameOnto= strtolower(str_replace('_',' ',$clusterName));
		
        $diff= $apiSqarql->getDiffFromClusterName($clusterNameOnto);
		$diff=$diff[0];
       // print_r($diff);
		
		$in=$this->getDataInizioProj($ProjectId);
		$fin=$this->getDataFineProj($ProjectId);
		
		
        $inizio=new DateTime($in[0]['data_inizio']);
        $fine=new DateTime($fin[0]['data_fine']);
		
		
		
		$dur = $apiSqarql->getDurFromClusterName($clusterNameOnto);
		//print_r($dur);
        $interval = $inizio->diff($fine);

        $giornidiff= abs($dur[0]-$interval->d);
		//print($giornidiff);
        if ($giornidiff >= Deltagiorni){


            while($giornidiff>Deltagiorni) {

                $giornidiff = $giornidiff - Deltagiorni;
                $diff++;

            }

        }
        $clusterId=$this->getIDClusterFromNome($clusterName);
        $this->insertProjectCluster($clusterId[0]['idcluster'],$ProjectId,$diff);

    }




    function getDifficoultiesFromProjectID($idProgetto){

        $query = "SELECT * FROM progetto_has_cluster WHERE Progetto_idProgetto = '".$idProgetto."'";
        return $this->query($query,1);

    }



    function getProgrammatoreClusters($idProgrammatore){

        $query = "SELECT * FROM programmatore_has_cluster WHERE programmatore_idProgrammatore = '".$idProgrammatore."'";
        return $this->query($query,1);
    }
	
	function getProgrammatoreClustersNameAndValore($idProgrammatore){
$query="
		SELECT cluster.nome,programmatore_has_cluster.valore FROM programmatore_has_cluster,cluster WHERE programmatore_idProgrammatore ='".$idProgrammatore."' and cluster.idcluster=programmatore_has_cluster.cluster_idcluster	
			";
			
			 return $this->query($query,1);
    }

	 function getProgrammatoreClustersName($idProgrammatore){
		$query="
		SELECT cluster.nome FROM programmatore_has_cluster,cluster WHERE programmatore_idProgrammatore ='".$idProgrammatore."' and cluster.idcluster=programmatore_has_cluster.cluster_idcluster	
			";
			 return $this->query($query,1);
	 }
    function getOnWorking($idProgetto){

        $query = "SELECT Programmatore_idProgrammatore FROM programmatore_iscritto_progetto WHERE Progetto_idProgetto = '".$idProgetto."'AND onWorking=1";
        return $this->query($query,1);
    }

	function setOnWorking($idProgrammatore,$idProgetto){
		$query=" UPDATE programmatore_iscritto_progetto SET onWorking='1' WHERE Programmatore_idProgrammatore='$idProgrammatore' AND Progetto_idProgetto='$idProgetto'";
		
		return $this->query($query,0);
		
	}
	

	//funzioni tabella programmatore_as_invito
	function getInvito($idProgrammatore){
		$query="SELECT * FROM programmatore_as_invito WHERE idProgrammatore='$idProgrammatore'";
		return $this->query($query,1);
	}
	
	function setInvito($idProgrammatore,$idProgramma){
		$query="INSERT INTO programmatore_as_invito (idProgrammatore,idProgetto) VALUES ('$idProgrammatore','$idProgramma')";
		return $this->query($query,0);
	}
	function removeInvito($idProgrammatore,$idProgetto){
		$query="DELETE  FROM programmatore_as_invito WHERE idProgrammatore='$idProgrammatore' AND idProgetto='$idProgetto'";
		return $this->query($query,0);
	
	}
    
	
	
	/////////////////////////////////////////////////////////API RICECA
	
		function serchProjectByName($name,$namOrder,$order){
			 
			$query="SELECT DISTINCT * FROM progetto WHERE progetto.stato = 1 AND nome LIKE '%".$name."%' ORDER BY  " .$namOrder . "  " . $order;
			
			return $this->query($query,1);
		}
		
		function serchProjectByCompetenze($name,$namOrder,$order){
			
			$query="SELECT DISTINCT  progetto.* FROM progetto, progetto_has_cluster,cluster WHERE progetto.stato = 1 AND cluster.nome LIKE '%".$name."%' AND progetto.idProgetto=progetto_has_cluster.progetto_idProgetto AND progetto_has_cluster.cluster_idcluster= cluster.idcluster ORDER BY  " .$namOrder . "  " . $order;
			
			return $this->query($query,1);
		}
		
		
	
	
	
}//fine classe DB_API


?>
