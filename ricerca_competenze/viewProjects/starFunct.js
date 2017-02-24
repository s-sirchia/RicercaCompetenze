// faccio il preload dell'immagine utilizzata per l'effetto rollover
var staron = new Image(); staron.src = "star-on.gif";

// Definisco la funzione per la votazione che verrà lanciata
// all'evento onclick su una delle 5 stelle
function star_vota(QT,id)
{
  // Creo una variabile con l'output da restituire al momento del voto
  var star_output = '<span class="output" data-*="'+QT+'">Hai votato ' + QT + ' stelle!</span>';
  // Cambio dinamicamente il contenuto del DIV contenitore con il messaggio di
  // conferma di votazione avvenuta
  document.getElementById(id +'cont').innerHTML = star_output;
 // window.location.href="inserisci_feedback.php";
}

// Definisco la funzione per "accendere" dinamicamente le stelle
// unico argomento è il numero di stelle da accendere
function star_accendi(QT,id)
{
  // verifico che esistano i DIV delle stelle
  // se il DIV non esiste significa che si è già votato
  if (document.getElementById('star_1'+id))
  {
    // Ciclo tutte e 5 i DIV contenenti le stelle
    for (i=1; i<=5; i++)
    {
      // se il div è minore o uguale del numero di stelle da accendere
      // imposto dinamicamente la classe su "on"
      if (i<=QT) document.getElementById('star_' + i + id).className = 'on';
      // in caso contrario spengo la stella...
      else{
		   document.getElementById('star_' + i + id).className = '';
	 	 }
    }
  }
}

function redirect(QT){
	var url="inserisci_feedback.php?val="+QT;
	window.location.href=url;
}

// Questa è la funzione che produce l'output.
// richiede come unico argomento il numero di stelle che si vuole accendere
// di default (possiamo in questo, ad esempio, modo mostrare il voto ottenuto
// nelle precedenti votazioni)
function star(QT,id)
{
  // stampo il codice HTML che produce le stelle
  document.write('<div class="STAR_RATING" id="'+id+'cont" onmouseout="star_accendi(' + QT + ')""><ul>');
  document.write('<li id="star_1'+id+'" onclick="insertDB(1,event'+id+')" onmouseout="star_accendi(3,'+id+')" onmouseover="star_accendi(0,'+id+'); star_accendi(1,'+id+')"></li>');
  document.write('<li id="star_2'+id+'" onclick="insertDB(2,event,'+id+')" onmouseout="star_accendi(3,'+id+')" onmouseover="star_accendi(0,'+id+'); star_accendi(2,'+id+')"></li>');
  document.write('<li id="star_3'+id+'" onclick="insertDB(3,event,'+id+')" onmouseout="star_accendi(3,'+id+')" onmouseover="star_accendi(0,'+id+'); star_accendi(3,'+id+')"></li>');
  document.write('<li id="star_4'+id+'" onclick="insertDB(4,event,'+id+')" onmouseout="star_accendi(3,'+id+')" onmouseover="star_accendi(0,'+id+'); star_accendi(4,'+id+')"></li>');
  document.write('<li id="star_5'+id+'" onclick="insertDB(5,event,'+id+')" onmouseout="star_accendi(3,'+id+')" onmouseover="star_accendi(0,'+id+'); star_accendi(5,'+id+')"></li>');
  document.write('</ul></div>');
  // accendo le stelle definite in argomento
  star_accendi(QT,id);
}











function insertDB(QT, event,id){
	
	
	var  xmlhttp=new XMLHttpRequest();
	xmlhttp.open("POST","inserisci_feedback.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	event.preventDefault();
	var idProj = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute("value");
	var idProg = event.target.parentNode.parentNode.parentNode.parentNode.getAttribute("id");
	//console.log(idProg);
	
	r = confirm("Confermare la valutazione?");
	if(r == true){
	xmlhttp.send("val="+QT+
			"&idProg="+idProg+
			"&idProj="+idProj);
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				//window.location.assign("../estrazione_kw.php");
				star_vota(QT,id);
			}
		}
	}
	/*
	var idProj = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute("value");
	var idProg = event.target.parentNode.parentNode.parentNode.parentNode.getAttribute("id");
	var url="inserisci_feedback.php?val="+QT+"&idProg="+idProg+"&idProj="+idProj;
	window.location.href=url;
	*/

}