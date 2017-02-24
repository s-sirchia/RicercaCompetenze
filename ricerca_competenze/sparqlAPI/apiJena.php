<?php
require_once dirname(__FILE__) . "/sparqllib.php";
 
class ApiJena{
	
	private $urlDB;
	
	function __construct($endpoint){
	 $this->urlDB = $endpoint;
	}
	
	
	function getClusterFromLanguage($language){
		$language = $this->formatForLanguageIT($language);
			$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			
			$sparql = "SELECT ?x
						WHERE{
						?Ling <http://www.competenze.com/ontologia#nome> $language .
						?Ling <http://www.competenze.com/ontologia#appartiene_a> ?x }";
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					$pos = strpos($row[$field], "#") + 1;
					$toReturn[] = substr($row[$field],$pos);
				}
				
			}
			
			//print_r($toReturn);
			return $toReturn;				
	
		
							
	
	}
	
	function getSoftwareFromTag($tag){
		$tag = $this->formatForLanguageIT($tag);
		$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			
			$sparql = "SELECT ?x 
					WHERE{ 
					?Tag <http://www.competenze.com/ontologia#valore> $tag .
					 ?x <http://www.competenze.com/ontologia#tag> ?Tag .
					}";
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					$pos = strpos($row[$field], "#") + 1;
					$toReturn[] = substr($row[$field],$pos);
				}
				
			}
			
			//print_r($toReturn);
			return $toReturn;				
	
	
		
	}
	
	
	function getClusterFromSoftware($software){
			$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			
			$sparql = "SELECT ?x 
					WHERE{
					<http://www.competenze.com/ontologia#$software>
					<http://www.competenze.com/ontologia#appartiene_a> ?x 
					}";
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					$pos = strpos($row[$field], "#") + 1;
					$toReturn[] = substr($row[$field],$pos);
				}
				
			}
			
			//print_r($toReturn);
			return $toReturn;				
	
		
	}
	
	
	function getSoftwareFromCluster($cluster){
			$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			//echo $cluster;
			
			$sparql = 'SELECT ?x WHERE { <http://www.competenze.com/ontologia#'.$cluster.'> a <http://www.competenze.com/ontologia#Cluster> . 
  <http://www.competenze.com/ontologia#'.$cluster.'> <http://www.competenze.com/ontologia#include> ?x . 
  ?x a <http://www.competenze.com/ontologia#Software> }';
			
			
			$result = sparql_query( $sparql ); 
			
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					$pos = strpos($row[$field], "#") + 1;
					$toReturn[] = substr($row[$field],$pos);
					
					
				}
				
			}
			
			return $toReturn;				
	
		
	}
	
	
	
	function getAllKey(){
			$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			
			$sparql = "SELECT ?x WHERE{ ?y <http://www.competenze.com/ontologia#valore> ?x}";
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					
					$toReturn[] = $row[$field];
				}
				
			}
			
			//print_r($toReturn);
			return $toReturn;				
	
	}

	function getAllCluster(){
			$db = sparql_connect( $this->urlDB );
			if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			
			$sparql = "SELECT ?y WHERE{ ?y a <http://www.competenze.com/ontologia#Cluster> }";
			$result = sparql_query( $sparql ); 
			if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
			 
			$fields = sparql_field_array( $result );
			 
			$toReturn = array();
			while( $row = sparql_fetch_array( $result ) )
			{
				
				foreach( $fields as $field )
				{
					
					$toReturn[] = $row[$field];
				}
				
			}
			
			//print_r($toReturn);
			return $toReturn;				
	
	}
	

    function getDataFromClusterName($clusterName){

        $db = sparql_connect( $this->urlDB );
        if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $sparql = "SELECT ?Durata
                   WHERE{
                   ?Cluster <http://www.competenze.com/ontologia#ha_durata> ?Durata.
                   ?Cluster <http://www.competenze.com/ontologia#nome> '$clusterName'@it
                   }";
        $result = sparql_query( $sparql );
        if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $fields = sparql_field_array( $result );

        $toReturn = array();
        while( $row = sparql_fetch_array( $result ) )
        {

            foreach( $fields as $field )
            {

                $toReturn[] = $row[$field];
            }

        }

        //print_r($toReturn);
        return $toReturn;

    }

    function getDiffFromClusterName($clusterName){

        $db = sparql_connect( $this->urlDB );
        if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $sparql = "SELECT ?Diff
                    WHERE{
                    ?Cluster <http://www.competenze.com/ontologia#ha_difficolta> ?Diff.
                    ?Cluster <http://www.competenze.com/ontologia#nome> '$clusterName'@it
                    }";
        $result = sparql_query( $sparql );
        if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $fields = sparql_field_array( $result );

        $toReturn = array();
        while( $row = sparql_fetch_array( $result ) )
        {

            foreach( $fields as $field )
            {

                $toReturn[] = $row[$field];
            }

        }

        //print_r($toReturn);
        return $toReturn;

    }
	
	
	
	function getDurFromClusterName($clusterName){

        $db = sparql_connect( $this->urlDB );
        if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $sparql = "SELECT ?Dur
                    WHERE{
                    ?Cluster <http://www.competenze.com/ontologia#ha_durata> ?Dur.
                    ?Cluster <http://www.competenze.com/ontologia#nome> '$clusterName'@it
                    }";
        $result = sparql_query( $sparql );
        if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

        $fields = sparql_field_array( $result );

        $toReturn = array();
        while( $row = sparql_fetch_array( $result ) )
        {

            foreach( $fields as $field )
            {

                $toReturn[] = $row[$field];
            }

        }

        //print_r($toReturn);
        return $toReturn;

    }
	
	
	
	
	
	function formatForLanguageIT($str){
		return "\"$str\"@it";	
	}


	
	
}

//$apij = new ApiJena("http://localhost:3030/antologiaGPS/sparql");
//print_r($apij->getAllKey());
//print_r($apij->getClusterFromLanguage("Java"));
//print_r($apij->getSoftwareFromTag("android"));
//print_r($apij->getClusterFromSoftware("Android_BackEnd"));
