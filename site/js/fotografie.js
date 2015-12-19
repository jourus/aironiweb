/**
 * 
 */



function getElencoFoto() {

	var myUrl = 'api/?method=elencofoto&format=json';
	var esito=[];
	$.ajax({
			dataType: 'json',
			url: myUrl, 
			async: false, 
			success: function(data) {
					esito = data.data;				
				}
	});
	return esito;
	
}



// Accoda in session l'elenco delle foto (random) da far girare.
function preloadFoto() {

	var myUrl = 'api/?method=elencofoto&format=json';
	
	$.ajax({
			dataType: 'json',
			url: myUrl, 
			async: true, 
			success: function(data) {
					
					var elencoFoto = [];
					
					

					if(sessionStorage.ElencoFoto)
					{	
						elencoFoto = JSON.parse(sessionStorage.ElencoFoto);
					}

					// if (elencoFoto.lenght < 10) {}
					var esito = elencoFoto.concat(data.data);
					sessionStorage.ElencoFoto = JSON.stringify(esito);
									
				}
	});
}


function refreshFoto() {
	// http://localhost/airo/api/?method=elencofoto&format=json
	// http://localhost/airo/api/?method=layoutfoto&format=json
	var urlOpzioni=  'api/?method=layoutfoto&format=json';
	
	var conta = 1;
	$.getJSON(urlOpzioni, function(data) {
		/// Inizio --> Scelta del layout. 
		// il servizio restituisce tutti i layout disponibili. Qui ne viene scelto solo uno da presentare
		// Le "Posizioni" sono le coordinate delle foto da collocare in pagina
		
		// n. Layout disponibili
		var opzioni = data.data.layout.length;
		
		// selezione casuale del layout 
		var scelto = Math.floor((Math.random() * opzioni));

		// Viene creato l'elenco delle posizioni da collocare
		var Posizioni = data.data.layout[scelto].foto;

		/// Fine --> Scelta del lauyout

		
		
		/// Inizio --> Scelta delle foto da esporre.
		//  Vengono recuperate le foto disponibili dalla sessione (c'è una funzione che ne carica in continuo). 
		
		var ElencoFoto= [];
		
		if(sessionStorage.ElencoFoto)
		{	
			ElencoFoto = JSON.parse(sessionStorage.ElencoFoto);
		}

		// Se le foto disponibili non bastano per riempire i layout, la funzione termina: ne verranno accodate altre più tardi.
		if (ElencoFoto.length < Posizioni.length) {
				console.log('Non ci sono abbastanza foto nel buffer');
				return;
		}
		
		var FotoPronte = [];
		// vengono prelevate le foto necessarie
		for (x=0; x < Posizioni.length; x++) {
			FotoPronte.push(ElencoFoto.shift());	
		}
		// il buffer viene aggiornato
		sessionStorage.ElencoFoto = JSON.stringify(ElencoFoto);

		// Eliminazione vecchie foto
		$(".myItem").remove();
		
		/// aggiunta delle nuove foto (invisibili)
		$.each(Posizioni, function(key, layout) {

			// Viene accodata la foto (non visualizzabile)
			$("#theDiv").append("<img  id='image" + key + "' class='myItem'  src='" + FotoPronte[key] + "' />");

			// la foto viene valorizzata con le proprietà del css del layout selezionato
			var info = JSON.parse(JSON.stringify(layout));
			$('#image' + key ).css(info);
						
			
		});

		/// ingresso con fading.
		$(".myItem").fadeIn(1500)		
	});


}
// refreshFoto();	
function controlloStatoFoto() {
	var elencoFoto = [];
	

	if(sessionStorage.ElencoFoto)
	{	
		elencoFoto = JSON.parse(sessionStorage.ElencoFoto);
	}

	if (elencoFoto.length < 10) {
		preloadFoto();
	}
	
	

	
}


function transizioneFoto() {
	$(".myItem").fadeOut(1000, function(){refreshFoto();});
	// $(".myItem").fadeIn(2000);

	
}

function body_onload() {
	var accoda = setInterval(function() {transizioneFoto();}, 4000);
	
	var preload = setInterval(function(){controlloStatoFoto();}, 500);
}

