


var AutoGiro = {
		arrclassi: [],
		arrcategorie: [],
		arrCompagnie: [],
		indice: 0 ,	// indice dell ciclo su classi e categorie. Viene usato per podio e classifica
		indicecomp: 0 ,  // indice del ciclo sulle compagnie

		tiposchermata: 0 ,  // 0 podio 123 , 1 classifica completa , 2 foto varie, 3 classifica compagnie

		durataCicloDefault: 7000,
		durataCicloFoto: 13000,
		durataCicloClassifica: 10000,
		secondiciclo: this.durataCicloDefault , // 	il tempo di default è 7000, ma può 
											//	variare a seconda di cosa viene visualizzato
		TutteCompagnie: 0,
		TutteClassi: 0 ,
		msFadeIn: 1000,
		msFadeOut: 800,
		
		
		
		//funzione per caricare classi e categorie - Al termine, chiama la funzione di verifica per iniziare l'autogiro
		loadClassiCat: function( ) {
			
		//	arrclassi.length=0;
		//	arrcategorie.length=0;

			var terminatore = "fine";

			var url = 'api/?method=classicat&format=json';
			$.getJSON(url, function(data) {

				$.each(data.data, function(key, val) {
					
					AutoGiro.arrclassi.push(val.CLASSE); 
					AutoGiro.arrcategorie.push(val.CATEGORIA);
					
				});

				AutoGiro.arrclassi.push(terminatore);
				AutoGiro.arrcategorie.push(terminatore);
				console.log(AutoGiro.arrclassi);
				console.log(AutoGiro.arrcategorie);
				AutoGiro.dataLoadCompleted();
			});

		},

		//funzione per caricare le compagnie
		loadCompagnie: function () {
			this.arrCompagnie.length=0;

			var terminatore = "finecomp";

			var url = 'api/?method=compagnie&format=json';
			$.getJSON(url, function(data) {

				$.each(data.data, function(key, val) {
					AutoGiro.arrCompagnie.push(val.Compagnia);
				});
				
				AutoGiro.arrCompagnie.push(terminatore);
				console.log(AutoGiro.arrCompagnie);
				AutoGiro.dataLoadCompleted();
			});

		},

		 // se il caricamento dati è compeltato, viene lanciato il ciclo continuo.
		dataLoadCompleted: function () {
			if ((this.arrclassi.length > 0) && ( this.arrCompagnie.length > 0)) {
				this.ciclocontinuo();
			}
		},

	// ad intervalli variabili, aggiorna la schermata corrente
		cambiapodio: function (){
			
			
			classe = this.arrclassi[this.indice];
			categoria = this.arrcategorie[this.indice];
			compagnia = this.arrCompagnie[this.indicecomp];
	
			if ((this.TutteClassi==1) && (this.TutteCompagnie==1))
			//reload della pagina per ricostruire gli array con in nuovi cat classi e compagnie che hanno punti
			{
				self.location.replace('logica.html');
			}
	
			else{
	
	
				if (classe=="fine")
				//azzero il counter classicat
				{
					this.indice=0;
					this.TutteClassi=1;
				}
	
				if (compagnia=="finecomp")
				//azzero il counter delle compagnie
				{
					this.indicecomp=0;
					this.TutteCompagnie=1;
				}
	
	
	
	
				switch (this.tiposchermata) {
	
				case 0:
					this.secondiciclo=this.durataCicloDefault;
					urlpodio='podio.html?classe='+classe+'&categoria='+categoria;
	
					break;
				case 1:
					this.secondiciclo = this.durataCicloClassifica;
					urlpodio='classifica.html?classe='+classe+'&categoria='+categoria;
					this.indice++;
	
	
					break;
				case 2:
					this.secondiciclo = this.durataCicloFoto;
					
					urlpodio='fotografie.html';
					
					break;
				case 3:
					this.secondiciclo=this.durataCicloDefault;
					urlpodio='classifica_compagnia.html?compagnia='+compagnia;
					
					break;
				}
				
				this.tiposchermata++;
	
				if (this.tiposchermata > 3) {
					this.tiposchermata = 0;
				}
	
	
	
				$('#spettacolo').fadeOut(this.msFadeOut, function(){
						$('#spettacolo').attr('src', urlpodio);
						
				});
	
			}
	
		},
	
		// è il temporizzatore di tutto: chiama un cambio della schermata allo scadere di un tempo determinato.
		ciclocontinuo: function ()
		{
			var tempo = this.cambiapodio();
			window.setTimeout('AutoGiro.ciclocontinuo()',this.secondiciclo);
		},
	
		aggiornaFrame: function() { $("#spettacolo").fadeIn(this.msFadeIn); }

}


// gestisce la transizione di ingresso ogni volta che viene cariata una pagina nel frame.
function myframe_onload(){
	// $("#spettacolo").fadeIn(msFadeIn);	
	//alert("fatto");
	AutoGiro.aggiornaFrame();
}


function body_on_load() {
	
	
	AutoGiro.loadClassiCat() ;
	
	AutoGiro.loadCompagnie() ;
}

