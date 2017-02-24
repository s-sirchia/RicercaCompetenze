<?php 
session_start();

if(isset($_SESSION['idPM']))
	$idPM = $_SESSION['idPM'];

if(isset($_POST)){

	
	if(isset($_POST['mod'])){
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;
		$_SESSION['modalita'] = "mod";
		header("location: modificaProj.php");
		
	}else if(isset($_POST['add'])){
		
		header("location: ../inserimento_progetto.php");
		
		
	}else if(isset($_POST['del'])){
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;

		header("location: elimina_progetto.php");
		
	}else if(isset($_POST['view'])){
		
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;
		$_SESSION['modalita'] = "view";	
		header("location: modificaProj.php");
		
	}else if($_POST['sign']){
		
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;
		header("location: manageSign.php");
		
	/*Pagina che visualizza i partecipanti di un progetto concluso*/
	}else if($_POST['part']){
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;
		if($_POST['tipo']=="progress"){
			$_SESSION['progress']=true;
		}else{
			$_SESSION['progress']=false;
		}
		header("location: visualizza_partecipanti.php");
		
	/*Pagina per ssegnare i feedback ad un progemmatore*/

	}else if($_POST['feed']){
		$idProj = $_POST['proj'];
		$_SESSION['idProj'] = $idProj;
		header("location: visualizza_partecipanti.php");
	}
	
}
?>
