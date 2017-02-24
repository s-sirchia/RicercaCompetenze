
function checkProject(event){
	
	
	var idprogetto;
	var progetti = document.getElementsByName('proj');
	for (i = 0; i < progetti.length; i++) {
	    if (progetti[i].checked == true) {
	        idprogetto = progetti[i].value;
	    }
	}
	if(idprogetto == null){
	//window.location.replace("updateProj.php?idprogetto="+idprogetto);
		window.alert("nessun progetto selezionato");
		event.preventDefault();
	}

}





