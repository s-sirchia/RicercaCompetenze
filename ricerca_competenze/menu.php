<?php
include_once dirname(__FILE__) . "/util.php";
include_once dirname(__FILE__) . './connDB/DB_API.php';
include_once dirname(__FILE__) . './connDB/dbconn.php';






function getEsperienza($rate){
	$str;
	$num = $rate;
	if($num < 10)$str = 'Noob';
	if($num < 20 && $num >= 10) $str = 'Low';
	if($num < 30 && $num >= 20)$str = 'Normal';
	if($num < 40 && $num >= 30)$str = 'Pro';
	if($num < 30 && $num >= 40)$str = 'Awesome';
	if( $num >= 50){
		$str = 'Ancient wise';
		$rate = 100;
	}else{
	 $rate = $rate*2;	
	}
	
	return $str . '<div class="contExp" style="width:100%"><div class="realExp" style="width:'.$rate.'%"> <br></div></div>';
	
}


function importLib($directory){
	
	
		echo '
		
		<link rel="stylesheet" href="' . $directory . 'css/examples.css">
		
		<script src="' . $directory . 'lib/jquery.min.js"></script>
		<script src="' . $directory . 'lib/jquery.barrating.js"></script>
		<script src="' . $directory . 'lib/examples.js"></script>';
		
		
}
function getExp($directory,$num){

	
	$str = '
										<select id="example-b" name="rating">
											<option value="Noob" '; if($num < 10)$str .= 'selected="selected"'; $str .='>Noob</option>';	
										$str .='<option value="Low" '; if($num < 20 && $num >= 10)$str .= 'selected="selected"'; $str .='>Low</option>';
										
										
										$str .='<option value="Mod" '; if($num < 30 && $num >= 20)$str .= 'selected="selected"'; $str .='>Moderate</option>';
										
										$str .='<option value="Pro" '; if($num >= 30)echo 'selected="selected"'; $str .='>Pro</option>';
										$str .= '</select>
									';
									return $str;
}


function menu($directory){
	

	
$flag = true;
$nome;
$tipologia;		
$util = new Util();
if($util->isPM()){
	$nome = $_SESSION['nome'];
	$tipologia = "Project Manager";
}else if($util->isProgrammatore()){
	$nome = $_SESSION['nome'];
	
	$tipologia = "Sviluppatore";
}else{
 $flag = false;
}

if($flag){
	
	
	
	
echo '
						<div class="welcome">
						<div>
								<div ><h3>Utente: '. trim($nome) .'</h3></div><br>
								<div><h3>Tipologia: '. trim($tipologia) .'</h3></div>
								
						</div>
						</div>
						
				
					
			';		
}else{
	echo '
						<div class="welcome"><div></div> <br><div></div>
						</div>
						
				
					
			';	
}
echo ' <div class="menu"><table>';
echo ' <tr>
               	
                <td><div class="menuEl"><a href="' . $directory . 'index.php">Home</a></div>
                </td>
               	<td><div class="menuEl"><a href="' . $directory  . 'about.php">About</a></div>
               	</td>';

if($flag){
 echo '            	<td><div class="menuEl"><a href="' . $directory  . 'logout.php">Logout</a></div>
               	</td>';
echo '            	<td><div class="menuEl"><a href="' . $directory  . 'viewProjects/area_utente.php">Utente</a></div>
               	</td>';
	
}else{
	
 echo '            	<td><div class="menuEl"><a href="' . $directory  . 'login.php">Login</a></div>
               	</td>';
				
				
echo '            	<td><div class="menuEl"><a href="' . $directory  . 'registrazione_programmatore.php">Registrati</a></div>    	</td>';
	
}
				
echo '</tr>
               </table>
               </div>';	
	
}

function menuProgrammatore($directory){
	$db = new DB_API();
	$idProg = $_SESSION['idProgrammatore'];
echo '<div class="container">
    	<table>
        	<tr>
            	<td>
                	<div id="topnav">
                        <ul class="wsite-menu-default">
								<li id="pg429123195586581630" class="wsite-menu-item-wrap">
								<a href="' . $directory . 'homeProgrammatore.php" data-membership-required="0" class="wsite-menu-item">		Tutti i progetti
								</a>
								</li>
								
								<li id="pg429123195586581630" class=" wsite-menu-item-wrap">
								<a href="' . $directory . 'inviti.php" data-membership-required="0" class="cont-notify wsite-menu-item">		I miei inviti 						';
								$ris=$db->getInvito($idProg);
								$num =  count($ris);
								if($num > 0){
								echo '<div class="notify">'.	$num . '</div>';	
								}
								echo '
								</a>
								 
								
								</li>
								
								
								<li>
								<a href="' . $directory . 'progetti_programmatore.php" data-membership-required="0" class="wsite-menu-item">
								Progetti che seguo
								</a>
								</li>
								
								
									<li>
								<a href="' . $directory . 'working_programmatore.php" data-membership-required="0" class="wsite-menu-item">
								Progetti on working
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
    </div>';

	
}

function menuPM($directory){
echo '<div class="container">
    	<table>
        	<tr>
            	<td>
                	<div id="topnav">
                        <ul class="wsite-menu-default">
								<li id="pg429123195586581630" class="wsite-menu-item-wrap">
								<a href="' . $directory . 'projects.php" data-membership-required="0" class="wsite-menu-item">
									Tutti i miei progetti
								</a>
								</li>
								<li>
								<a href="' . $directory . 'progetti_in_progress.php" data-membership-required="0" class="wsite-menu-item">
									Progetti in avanzamento
								</a>
								</li>
										<li>
								<a href="' . $directory . 'projects_close.php" data-membership-required="0" class="wsite-menu-item">
									Progetti conclusi
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
    </div>';

	
}



?>