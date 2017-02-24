<?php
/**
 * Created by PhpStorm.
 * User: Luigi
 * Date: 26/05/15
 * Time: 09:39
 */

$MAXITER=100;

$Task=array(
"Java"=>4,
"C"=>2,
"PHP"=>6
);

$Lavoratori=array(
    "Steve"=>array( "Java"=>5, "C"=>3, "PHP"=>7, "Costo"=>45),
    "Luigi"=>array( "Java"=>5, "C"=>1, "PHP"=>1,"Costo"=>13),
    "Rosario"=>array( "Java"=>1, "C"=>1, "PHP"=>7,"Costo"=>14),
    "Francesco"=>array( "Java"=>5, "C"=>1, "PHP"=>1,"Costo"=>16),
    "Vincenzo"=>array( "Java"=>1, "C"=>5, "PHP"=>1,"Costo"=>12),

);

$RemTask;

foreach($Lavoratori as $key=>$value){

    $count=0;
    $linguaggi=array();
    foreach($Task as $chiave=>$valore){

        if ($value[$chiave]>$valore){


            array_push($linguaggi,$chiave);
            //echo $valore;
            $count+=1;
        }

        if (!(in_array($chiave, $RemTask))) {
            $RemTask[$chiave]=1;
        }

    }

    $normVal= $value["Costo"]/$count;

    $CostoLavoratori[$key]=array("Valore"=>$normVal,"Linguaggi"=>$linguaggi);

}

//print_r($CostoLavoratori);
asort($CostoLavoratori);
echo "<br>";
//print_r($CostoLavoratori);
//print_r($RemTask);


/*Algoritmo Greedy per trovare una soluzione*/

$Soluzione;
foreach($CostoLavoratori as $key=>$value){

    $Soluzione[$key]=$value["Valore"];

    $ling=$value["Linguaggi"];

    foreach($ling as $val){

        if(array_key_exists($val, $RemTask)){
            unset($RemTask[$val]);

        }

    }

    if(count($RemTask)==0)
        break;
}


if(count($RemTask)!=0)
    $Soluzione=null;

/*Euristica per la migliorare la soluzione da*/


echo "La soluzione è: ";
print_r($Soluzione);
echo " a costo: ". array_sum($Soluzione);



