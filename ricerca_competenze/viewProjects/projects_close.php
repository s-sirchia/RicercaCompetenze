<?php 
include_once dirname(__FILE__) . "/../menu.php";
include_once dirname(__FILE__) . '/../connDB/DB_API.php';
session_start();
$idPM=$_SESSION['idPM'];
//$_SESSION['idPM'] = $idPM;

		  
		 
?>

<html>
<head>
<script src="scriptProjects.js"></script>
<title>Visualizzazione Progett</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="main_style.css" title="wsite-theme-css" />
<style type="text/css"></style>

</head>

<body>
	<div id="header-wrap">
    	<div class="container">
        	<table id="header">
        	<tr>
           		<td id="logo"><span class="wsite-logo">
					<a href="#">
					<span id="wsite-title">Ricerca Competenze</span>
					</a></span>
				</td>
           <td id="header-right">
           <?php
		   
		   menu("../");
		   ?>
            <!--   <div class="menu">
               <table><tr>
               	
                <td><div class="menuEl"><a href="#">Home</a></div>
                </td>
               	<td><div class="menuEl"><a href="#">About</a></div>
               	</td>
               </tr>
               </table>
               </div>-->
       		</tr>
       </table>   
    </div>
</div>

<div id="topnav-wrap">
<?php 
	 menuPM("");
?>
<!--<div class="container">
    	<table>
        	<tr>
            	<td>
                	<div id="topnav">
                        <ul class="wsite-menu-default"><li id="pg429123195586581630" class="wsite-menu-item-wrap">
	<a href="projects.php" data-membership-required="0" class="wsite-menu-item">
		Home
	</a>
	</li>
	<li>
	<a href="projects.php" data-membership-required="0" class="wsite-menu-item">
		About
	</a>
	</li>
	<li>
	<a href="progetti_conclusi.php" data-membership-required="0" class="wsite-menu-item">
		Visualizza Progetti Conclusi
	</a>
	</li>
	</ul>
                        <div style="clear:both"></div>
                    </div>
                </td>
                <td><div class="search"></div></td>
            </tr>
        </table>
        <div style="clear:both;"></div>
    </div>-->
</div>
<div id="main-wrap">
    <div class="container">
        <div id="main">
        	<div id="content">
        	<div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div style="text-align:left;">
<form name="moduloProgetti" action="controlProj.php" id="modProj" method="POST">
        		
   <table>     			
   <tr>
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Progetti conclusi</h1>
</tr>
<tr>

	
		
	
		<input class="button"  type="submit" name="view" value ="Visualizza " onClick="checkProject(event)">
	
	
	
	<input class="button"   type="submit" name="part" value ="Partecipanti" onClick="checkProject(event)">
    
    <input type="hidden" value="close" name="tipo" >
	</tr>
	
	</table>

<?php
$db  = new DB_API();
$result = $db->getProjectPMFromStateId(3,$idPM); //3 = stato terminato
if($result == NULL){
	echo '<div>Attualmente non hai progetti conclusi</div>';
}else{
	
	echo '



		<table id="tabProgetti">
			<tr style="background:#fff; color:#5e5e5e">
				<td ><h3>*</h3></td>
				
				<td><h3>#</h3></td>
				
				<td><h3>Project</h3></td>
				
				<td><h3>Status</h3></td>
				
				<td><h3>Start Date</h3></td>
				
				<td><h3>Due Date</h3></td>
				

			</tr>';

	

	for($i = 0;$i<count($result);$i++){
		$stato = $db->getStato($result[$i]['stato']);
		echo "<tr>
				<td> <input type='radio' name='proj' value='".$result[$i]['idProgetto']."'/>
				<td>".$result[$i]['idProgetto']."</td>
				<td>".$result[$i]['nome']."</td>
				<td>".$stato[0]['stato']."</td>
				<td>".$result[$i]['data_inizio']."</td>
				<td>".$result[$i]['data_fine']."</td>
				
						
						";	
	}
}
?>
</form>

</table>
			
				</div>
			</div>
		</div>
	</div>
	</div>

	<div style="padding-top:200px; background:#fff;"></div>	
	<div id="footer-wrap">
	<div class="container">
		<div id="footer"></div>
    </div>
	</div>
</div>
</body>
</html>