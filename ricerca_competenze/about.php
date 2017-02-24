<?php
require_once dirname(__FILE__) . "/util.php";
require_once dirname(__FILE__) . "/menu.php";
include_once dirname(__FILE__) . '/connDB/DB_API.php';
session_start();
?>
<html>
<head>
 
<title>Visualizzazione Progett</title>
 
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="viewProjects/main_style.css">
 
<style type="text/css">
#main-wrap tr:hover{
        background-color: #FFF;
        color: #333333;
}
 
 
 
 
 
.message {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #F00;
        width: 100%;
        text-align: center;
        height: 5px;
        padding-top: 5px;
        padding-bottom: 5px;
}
.info {
        height: 40px;
        width: 40px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        font-weight: bold;
        color: #FFF;
        background-color: #666;
        background-image: url(img/info-icon0.png);
}
.info:hover {
        background-image: url(img/info-icon1.png);
}
.button {
        color:#fff;
        font-family: Helvetica, Arial, sans-serif;
        height: 31px; display: inline-block;
        font-weight:normal;
        font-size:15px;
        text-decoration: none;
        border:none;
        padding-left:10px;
        padding-right:10px;  
        background-color: #5e5e5e;
   }
.nomeProg {
        text-align: left;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: 500px;
}
</style>
 
 
 
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="lib/popup.js"></script>
<script>
 
$(document).ready(function(e) {
    $('#popup').hide();
});
 
 
 
function conferma(event,str){
         var r = confirm(str);
         if (r != true) {
                 event.preventDefault();
        }
}
 
 
function showInfo(nome){
        res = document.getElementById(nome);
       
        //alert(res.value);
        addToDiv(res.value);
}
 
</script>
 
 
</head>
 
<body class=" no-header-page  wsite-theme-light  wsite-page-visualizzazione-progetti">
<div id="popup">Lorem Ipsum Dolor sit</div>
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
                <td>
                <div class="paragraph" style="text-align:left;">
                <span style="line-height: 23.3999996185303px; background-color: initial;">
                Il mondo della gestione progettuale, qualsiasi sia la natura del prodotto che si
vuole produrre, &eacute; caratterizzato da diverse problematiche, pi&uacute; o meno gravi, che
possono intuire sulla buona pianificazione delle attivit&aacute; di progettazione e produzione.
                </span>
                </div>
               
               
                <div class="paragraph" style="text-align:left;">
                <span style="line-height: 23.3999996185303px; background-color: initial;">
                 Una cattiva scelta del personale pu&oacute; impattare su costi e tempi dello sviluppo, cos&igrave;
come sulla qualit&aacute; prodotto.
               
                </span>
                </div>
                <div class="paragraph" style="text-align:left;">
                <span style="line-height: 23.3999996185303px; background-color: initial;">
                Questo &eacute;  un sistema di supporto alla gestione di progetti software con l&rsquo;obiettivo di ridurre le difficolt&aacute; sopra citate, da parte di un responsabile o di un project manager, nel selezionare le persone adatte per lo svolgimento e la realizzazione di un progetto. Il cuore
del sistema quindi consiste nel suggerire al project manager, tra un pool di programmatori, un gruppo di persone tali che le loro conoscenze ricoprano le
competenze necessarie richieste dal progetto con lo scopo aggiuntivo di minimizzare il costo necessario per la realizzazione.
                </span>
                </div>
                <br>
                <br>
                </td>
                </tr>
                </table>
                <h2 style="text-align:center">Developers</h2>
               
                <table>
                <tr><td><a>
<img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/AAEAAQAAAAAAAAMkAAAAJGUwMDA3MTg3LTI4ZTYtNDU0MS1hMmYwLTIyZDFjOTY5YTUxMw.jpg" alt="Picture" style="width:100%;max-width:177px" />
</a></td><td>
                <h3>Rosario Di Florio</h3>
                </td></tr>
 
                <tr><td><a><img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p160x160/1491704_10204320813047800_8188024890250518621_n.jpg?oh=6b4875e787e739a790af090511d4bfb7&oe=55A355C3&__gda__=1437105980_57850e78a24ff3aa7058d697162b25e0" alt="Picture" style="width:100%;max-width:177px" />              
</a></td><td>
                <h3>Vincenzo Venosi</h3>
                </td></tr>
               
                <tr><td><a>
<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/c139.4.631.631/s160x160/10354160_10203766074098512_545317868660982485_n.jpg?oh=68e7a3eb7d7a1e33105b4cd6b85e2724&oe=562A58BE&__gda__=1444962209_f9ba702c9642b2050aca2bd824c94b46" alt="Picture" style="width:100%;max-width:177px" />
</a></td><td>
                <h3>Luigi Giugliano</h3>
                </td></tr>
               
                <tr><td><a>
<img src="http://www.gamesearch.altervista.org/uploads/2/1/9/8/21980696/1400682_orig.jpg" alt="Picture" style="width:100%;max-width:177px" />
</a></td><td>
                <h3>Steven Rosario Sirchia</h3>
                </td></tr>
               
                <tr><td><a>
<img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/3/005/0a3/26b/054defb.jpg" alt="Picture" style="width:100%;max-width:177px" />
</a></td><td>
                <h3>Luigi Lomasto</h3>
                </td></tr>
               
                <tr><td><a>
<img src="https://scontent-mxp1-1.xx.fbcdn.net/hphotos-xta1/v/t1.0-9/1013635_10205357560482688_7922596209272688426_n.jpg?oh=a123e4c612a8f79f6c7ac45a17e5dba9&oe=561154E0" alt="Picture" style="width:100%;max-width:177px" />
</a></td><td>
                <h3>Francesco Gaetano</h3>
                </td></tr>
               
               
                </table>
               
               
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