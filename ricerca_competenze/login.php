<?php
require_once dirname(__FILE__) . "/util.php";
require_once dirname(__FILE__) . "/menu.php";
include_once dirname(__FILE__) . '/connDB/DB_API.php';
session_start();
$util = new Util();

if($util->isProgrammatore() || $util->isPM()){
//utente già loggato
header("Location: index.php?message=1");	
}
$_SESSION['active']=true;
?>
<html>
<head>

<title>Visualizzazione Progett</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css">
<style type="text/css">
#login {
}

#login input {
	height: 30px;
	width: 300px;
}
#login tr {
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	text-align: center;
	width: 300px;
}
.text {
	width: 300px;
	text-align: left;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	padding: 5px;
}
.message {
	width: 300px;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
	padding: 0px;
	font-size: 12px;
	color: #F00;
}
#login tr:hover {
	background-color: #FFF;
	color: #333;
	}
#button {
	width: 300px;
	background-color: #CCC;
	border: 1px solid #999;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #666;
	margin: 0px;
	padding: 0px;
}
#button:hover {
	color: #333;
}
</style>
<script>

function checkCampi(){
	user = document.getElementById("user");	
	pass=document.getElementById("pass");
	//alert(pass.value);
	
}


</script>

</head>

<body class=" no-header-page  wsite-theme-light  wsite-page-visualizzazione-progetti">
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
			   	menu("");
			   ?>
       		</tr>
       </table>   
    </div>
</div>

<div id="topnav-wrap">
	<?php
	 	$util = new Util();
		 if($util->isProgrammatore()){
			 menuProgrammatore("");
		 }else if($util->isPM()){
			 menuPM("viewProjects/");
		 }else{
			session_destroy(); 
		 }
	
	?>
</div>

    


<div id="main-wrap">
    <div class="container">
        <div id="main">
        	<div id="content">
        	<div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div style="text-align:left;">

        		
   <table>     			
   <tr>
<h1 class="wsite-content-title" style="text-align:left;" id= "titleHeader">Login</h1>
</tr>
<tr>

	

	</tr>
	
	</table>



<form action="control_login.php" method="post" name="login">
<table id="login">
<tr>
<td><div class="text">User
<input name="user" type="text" id="user" />
</div>

<div class="text">Pass
<input name="pass" type="password" id="pass"/>
</div>
</td>
</tr>
<tr><td>
<div class="text">
<input id="button" name="login" type="submit" value="login" onClick="checkCampi()" />	
</div></td></tr>

<tr><td><div class="message">
<?php
if(isset($_GET['message'])) {
    $message = $_GET['message'];
	if( $message == 1){
		echo "<p>nome utente e password non validi</p>";
	}else if($message == 2){
		echo "<p>utente non autorizzato</p>";
	}
}
 ?> </div></td></tr>
</table></form>



		
			
				</div>
			</div>
		</div>
	</div>
	</div> 	
		
<div id="footer-wrap">
	<div class="container">
		<div id="footer"></div>
    </div>
</div>
</body>
</html>