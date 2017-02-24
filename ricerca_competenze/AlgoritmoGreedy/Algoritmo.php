<?php
/**
 * Created by PhpStorm.
 * User: Luigi
 * Date: 11/06/15
 * Time: 14:39
 */

require_once('../connDB/DB_API.php');
	const DeltaEsp=5;

class Algoritmo {


    private $db;

    private $idProgetto;
    private $programmatori;
    private $ClusterseDiff;             /*Array in cui sono contenute le difficoltà dei cluster che compongono
                                           il progetto con idProgetto*/

    private $ProgCandidati=[];

    function __construct($id){

        $this->idProgetto=$id;
        $this->db= new DB_API();

        $this->programmatori=$this->db->getProgrammerSign($this->idProgetto);

        //print_r($this->programmatori);

        $ClusTemp= $this->db->getDifficoultiesFromProjectID($this->idProgetto);

        $j=0;

        foreach($ClusTemp as $ClusTempRow){

            $ID=$ClusTempRow['progetto_idProgetto'];
            $IDCL=$ClusTempRow['cluster_idcluster'];
            $IDVL=$ClusTempRow['valore'];

            $this->ClusterseDiff[$j][$IDCL]=$IDVL;
            $j++;
        }

        $i=0;

        foreach ($this->programmatori as $rowProg){

            $idProgrammatore= $rowProg['Programmatore_idProgrammatore'];

            $clusters=$this->db->getProgrammatoreClusters($idProgrammatore);    /*Cluster che ha il programmatore*/

            $this->ProgCandidati[$i]['ID']=$idProgrammatore;
            $CostoProgrammatore=$rowProg['costo_ora'];
            $esperienza=$rowProg['esperienza'];				/*Non so se è col la lettera grande o piccola :) */


            /*Per ogni Cluster ha il programmatore*/
			
			if(count($clusters)==0)
				continue;
			
            foreach($clusters as $rowCluster){

                $ClusterProgrammatore=$rowCluster['cluster_idcluster'];
                $ValoreClusterProgrammatore=$rowCluster['valore'];

                while($esperienza>DeltaEsp){
                	$ValoreClusterProgrammatore++;
                	$esperienza=$esperienza-DeltaEsp;
                }


                /*Per ogni cluster del progetto*/
                foreach($this->ClusterseDiff as $rowClusterDiff){

                    $ClustersProgetto=key($rowClusterDiff);


                    if($ClusterProgrammatore==$ClustersProgetto){

                        $this->ProgCandidati[$i][$ClusterProgrammatore]=$ValoreClusterProgrammatore;
                        $this->ProgCandidati[$i]['Costo']=$CostoProgrammatore;

                        break;

                    }


                }
            }

            $i++;

        }

    }

    function Compute(){

        $this->RemvoeCoveredCluster();

        $RemTask=[];

        foreach($this->ProgCandidati as $rowProgCandidati) {


            //echo "Riga di rowProgrCandidati<br>";
            // print_r($rowProgCandidati);


            $clusters = array();


            foreach ($this->ClusterseDiff as $rowClusterseDiff) {

                $chiave = key($rowClusterseDiff);
                $valore = $rowClusterseDiff[$chiave];


                if (array_key_exists($chiave, $rowProgCandidati)) {

                    if ($rowProgCandidati[$chiave] > $valore) {


                        array_push($clusters, $chiave);
                    }

                    if (!(in_array($chiave, $RemTask))) {
                        $RemTask[$chiave] = 1;
                    }

                }

            }

            if (count($clusters) != 0) {


                $normVal = $rowProgCandidati['Costo'] / count($clusters);

                $key = $rowProgCandidati['ID'];

                $CostoLavoratori[$key] = array("Valore" => $normVal, "Linguaggi" => $clusters, "Costo_ora"=>$rowProgCandidati['Costo']);
            }

        }


        //print_r($CostoLavoratori);

        //echo "<br>";

        //print_r($RemTask);

        asort($CostoLavoratori);



        /*Algoritmo Greedy per trovare una soluzione*/

        $Soluzione=[];
        foreach($CostoLavoratori as $key=>$value){

            $Soluzione[$key]=$value["Costo_ora"];

            $clusters=$value["Linguaggi"];

            foreach($clusters as $val){

                if(array_key_exists($val, $RemTask)){
                    unset($RemTask[$val]);

                }

            }

            if(count($RemTask)==0)
                break;
        }

        //print_r($Soluzione);
		return $Soluzione;
    }


    function RemvoeCoveredCluster(){

        $ProgOW=$this->db->getOnWorking($this->idProgetto);
		if(count($ProgOW)!=0){
        //print_r($this->programmatori);

        foreach ($ProgOW as $RowProgOW) {

            $i=0;
            foreach ($this->programmatori as $RowProgrammatori){

                if($RowProgrammatori['Programmatore_idProgrammatore']== $RowProgOW['Programmatore_idProgrammatore'])
                    unset($this->programmatori[$i]);

                $i++;
            }


            $CluOW = $this->db->getProgrammatoreClusters($RowProgOW['Programmatore_idProgrammatore']);
			if(count($CluOW)==0)
				continue;
            //print_r($this->ClusterseDiff);

            foreach ($CluOW as $RowCluOW){

                    $i=0;
                    foreach ($this->ClusterseDiff as $RowCluDiff){

                        if(key($RowCluDiff)==$RowCluOW['cluster_idcluster'])
                            unset($this->ClusterseDiff[$i]);
                        $i++;
                    }

            }

            //print_r($this->ClusterseDiff);

        }
		}
    }



}