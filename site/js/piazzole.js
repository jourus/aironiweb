

function piazzole_body_onload() {
	var myDiv = document.getElementById("boxInterno");
	sessionStorage.PosizioneScroll = myDiv.parentElement.offsetHeight;;
	RefreshPiazzole();
	setTimeout(scrollit ,35);
}
// Questa funzione serve per reinizializzare i dati delle piazzole. 
// Pur non influenzando lo scorrimento dei dati sulla pagina, 
// è visibile un "saltino": verrà eseguita quando ricomincia il ciclo.
function RefreshPiazzole() {
	sessionStorage.PiazzolaPrecedente = 0;
	$('.tbpiazzola').remove();
	CaricaDati();
}



// Questa funzione gestisce lo scroll delle piazzole
// c'è un div esterno (boxContenitore) entro cui scorre un div (boxInterno)
// viene passato come argomento una funzione di callback da eseguire qualora
function scrollit() {
    var myDiv = document.getElementById("boxInterno");
    myDiv.style.top = (sessionStorage.PosizioneScroll -= 1) + 'px';
    
    if (myDiv.offsetTop + myDiv.offsetHeight < -5) {
		// questa chiamata non
		RefreshPiazzole();
    	//if(typeof(fCallback) == "function") fCallback();
	
		sessionStorage.PosizioneScroll = myDiv.parentElement.offsetHeight;
    }
    
    
    setTimeout(scrollit ,30);
}




// Recupera l'elenco degli arcieri divisi per piazzola invocando il relativo web service
// e li impagina nel div scorrevole.
function CaricaDati() {

	// Vengono caricate tutte le piazzole
	url = "api/?method=piazzole&format=json";
	$.getJSON(url, function(data) {
		
		// Questo contatore serve per allineare a destra ed a sinistra le piazzole
		// man mano che vengono caricate. NON usare il numero di piazzola: se non 
		// ci fossero tutte, si creerebbe un disallinemaneto nell'impaginazione. 
		var piazzolaVideo = 1;
		$.each(data.data, function(key, val) {
			var PiazzolaCorrente = val.Piazzola;
			var PiazzolaPrecedente = sessionStorage.PiazzolaPrecedente;
			
			var idPiazzola = "Piazzola" + PiazzolaCorrente;
			
			// Al cambio del numero piazzola (o al primo ingresso nella funzione)
			// viene stampata la tabella senza righe. Verranno aggiunte successivamente.
			if (PiazzolaPrecedente != PiazzolaCorrente) {
				sessionStorage.PiazzolaPrecedente = PiazzolaCorrente;
				var allineamento = (piazzolaVideo++ % 2 == 1 ? "dispari" : "pari");
				var table = "<table class='tbpiazzola " + allineamento + "' id='" + idPiazzola + "''><thead><tr><td>Piazzola " + PiazzolaCorrente + "</td></tr></thead><tbody></tbody></table>";
		
				$('#boxInterno').append(  table);
			}
			
			// Aggiunta righe
			$('#' + idPiazzola).append('<tr><td>' + toTitleCase(val.Cognome) + ' ' + toTitleCase(val.Nome) + '</td></tr>');
				
			
		});
	
	});

}

