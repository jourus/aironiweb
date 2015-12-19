



var arrclassi= [] ;
var arrcategorie= [];
var arrCompagnie= [];
var indice = 0 ;	// indice dell ciclo su classi e categorie. Viene usato per podio e classifica
var indicecomp = 0 ;  // indice del ciclo sulle compagnie

var tiposchermata = 0 ;

var durataCicloDefault = 7000;
var durataCicloFoto = 13000;
var durataCicloClassifica = 10000;
var secondiciclo = durataCicloDefault ; // 	il tempo di default è 7000, ma può 
										//	variare a seconda di cosa viene visualizzato
var TutteCompagnie = 0;
var TutteClassi = 0 ;
var msFadeIn = 1000; 
var msFadeOut = 800;

// 0 podio 123 , 1 classifica completa , 2 foto varie, 3 classifica compagnie



function body_on_load() {
	loadClassiCat() ;
	
	loadCompagnie() ;
}



//funzione per caricare classi e categorie
function loadClassiCat() {
	arrclassi.length=0;
	arrcategorie.length=0;

	var terminatore = "fine";

	var url = 'api/?method=classicat&format=json';
	$.getJSON(url, function(data) {

		$.each(data.data, function(key, val) {
			
			arrclassi.push(val.CLASSE); 
			arrcategorie.push(val.CATEGORIA);
			
		});
		arrclassi.push(terminatore);
		arrcategorie.push(terminatore);
		console.log(arrclassi);
		console.log(arrcategorie);
		dataLoadCompleted();
	});

}

//funzione per caricare le compagnie
function loadCompagnie() {
	arrCompagnie.length=0;

	var terminatore = "finecomp";

	var url = 'api/?method=compagnie&format=json';
	$.getJSON(url, function(data) {

		$.each(data.data, function(key, val) {
			arrCompagnie.push(val.Compagnia);
		});
		
		arrCompagnie.push(terminatore);
		console.log(arrCompagnie);
		dataLoadCompleted();
	});

}



 // se il caricamento dati è compeltato, viene lanciato il ciclo continuo.
function dataLoadCompleted() {
	if ((arrclassi.length > 0) && ( arrCompagnie.length > 0)) {
		ciclocontinuo();
	}
}



// ad intervalli variabili, aggiorna la schermata corrente
// 
function cambiapodio(){

	classe=arrclassi[indice];
	categoria=arrcategorie[indice];
	compagnia=arrCompagnie[indicecomp];

	if ((TutteClassi==1) && (TutteCompagnie==1))
	//reload della pagina per ricostruire gli array con in nuovi cat classi e compagnie che hanno punti
	{
		self.location.replace('logica.php');
	}

	else{


		if (classe=="fine")
		//azzero il counter classicat
		{
			indice=0;
			TutteClassi=1;
		}

		if (compagnia=="finecomp")
		//azzero il counter delle compagnie
		{
			indicecomp=0;
			TutteCompagnie=1;
		}




		switch (tiposchermata) {

		case 0:
			secondiciclo=durataCicloDefault;
			urlpodio='podio.html?classe='+classe+'&categoria='+categoria;

			break;
		case 1:
			secondiciclo = durataCicloClassifica;
			urlpodio='classifica.html?classe='+classe+'&categoria='+categoria;
			indice++;


			break;
		case 2:
			secondiciclo = durataCicloFoto;
			
			urlpodio='fotografie.html';
			
			break;
		case 3:
			secondiciclo=durataCicloDefault;
			urlpodio='classifica_compagnia.html?compagnia='+compagnia;
			
			break;
		}
		
		tiposchermata++;

		if (tiposchermata > 3) {
			tiposchermata = 0;
		}



		$('#spettacolo').fadeOut(msFadeOut, function(){
				$('#spettacolo').attr('src', urlpodio);
				
		});

	}

}

// è il temporizzatore di tutto: chiama un cambio della schermata allo scadere di un tempo determinato.
function ciclocontinuo()
{

	var tempo = cambiapodio();

	window.setTimeout('ciclocontinuo()',secondiciclo);

	//alert('ciao');
}


// gestisce la transizione di ingresso ogni volta che viene cariata una pagina nel frame.
function myframe_onload(){
	$("#spettacolo").fadeIn(msFadeIn);	
	//alert("fatto");
	
}