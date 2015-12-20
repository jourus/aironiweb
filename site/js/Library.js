/**
 * 
 */


// Mette in maiuscolo il primo carattere di ciascuna parola.
// Es. 'MARIO rossi' diventa 'Mario Rossi'

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}





function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};






function SetCategoria(objectName, categoria) {
	var url=  'api/?method=categorie&format=json&cat=' + categoria;
	$.getJSON(url, function(data) {
		
		if (data.data.length > 0){
			$(objectName).text('Categoria: ' + data.data[0].DescrizioneCategoria);
	
		}
		
	});
 
}

function SetClasse(objectName, classe) {
	var url=  'api/?method=classi&format=json&cla=' + classe;
	$.getJSON(url, function(data) {
		
		if (data.data.length > 0){
			$(objectName).text('Classe: ' + data.data[0].DescrizioneClasse);
	
		}
		
	});
 
}

function FormatDate(giorno) {
	try {
		var oggi = new Date(giorno);
		
		var G = oggi.getDate();
		var M = (oggi.getMonth());
		var A = (oggi.getYear() + 1900);
		
		var mese = Array("gennaio", "febbraio", "marzo", "aprile", "maggio", "giugno", "luglio", "agosto", "settembre", "ottobre", "novembre", "Dicembre")
		
		return(G + " " + mese[M] + " " + A);
	}
	catch (errore)
	{
		return "";
	}
}



function PiazzoleConsegnate(oggetto) {
	

	var setConsegna = function(piazzola) {
		var url = 'api/?method=score&format=json&piazzola=' + piazzola;
		$.getJSON(url, function(data) {
			var myCss = '';
			if (data.data.numcons) {
				myCss = 'piazzscoreconsyes';
			} else {
				myCss = 'piazzscoreconsno';
			}

			$('#fldConsegna' + piazzola).addClass(myCss);
		});
	}
	
	
	var url = 'api/?method=infogara&format=json';
	$.getJSON(url, function(data) {

		
		if (data.status == 200) {
			// Eliminazione righe precedenti
			$(oggetto + ' tr').remove();
			
			var piazzole = data.data.piazzole;
			var piazzolePerRiga = piazzole / 2;
			var riga = '<tr>';

			for (x = 1; x <= piazzole; x++) {
				riga += "<td id='fldConsegna" + x + "'>" + x + "</td>";

				if (x == piazzolePerRiga || x == piazzole) {
					riga += '</tr>';
					$(oggetto).append(riga);
					riga = '<tr>';
				}

			}
			
			
			for (x = 1; x <= piazzole; x++) {
				setConsegna(x);
			}
		}

	});

}

function SetInfogara(objectName) {
	var url=  'api/?method=infogara&format=json';
	$.getJSON(url, function(data) {
		
		if (data.status ==200){
			$(objectName).text(data.data.localita + ' (' + data.data.provincia + '), ' + FormatDate(data.data.data));
	
		}
		
	});
 
}

/*
 *  Specifica per il podio
 */
function SetPodio(classe, categoria)  {
	var url=  'api/?method=podio&format=json&cla=' + classe + '&cat=' + categoria;
	var conta = 1;
	$.getJSON(url, function(data) {
		
		
		$.each(data.data, function(key, val) {

				
			$('#NomeArciere' + conta).text(val.arciere);
			$('#PodioPunti' + conta).text(val.punti);
			$('#PodioSpot' + conta).text(val.spot);
			$('#PodioSuper' + conta).text(val.superspot);
			$('#FotoPodio' + conta).attr('src','immagini/foto/' + val.foto);
			$("#divPodio" + conta).fadeIn(1500);
			$("#BarraVerticalePodio" + conta).fadeIn(1500);
			conta ++;
		});
		
	});
 
}



function SetClassifica(classe, categoria) {
	// Servizio Web che eroga il dato
	// var url=  'http://localhost/airo/piazzoleservice.php?min=' + piazzola + '&max=' + piazzola;
	var url=  'api/?method=classifica&format=json&cla=' + classe + '&cat=' + categoria;
	//var elemento = '#' + tabella;


        // eliminazione di tutte le righe presenti
		$('.rigaClassifica').remove();

        // Contatore di posizione in classifica
        var posizione = 0;

        var tabella = "#tabSinistra";
        
        $.getJSON(url, function(data) {
                
                $.each(data.data, function(key, val) {
                         
                        var riga = "<tr class='rigaClassifica'>";
                        posizione++;
                        riga += "<td class='fields fieldPOS'>" + posizione + "</td>";
                        riga += "<td class='fields fieldNome'>" + toTitleCase(val.arciere) + "</td>";
                        riga += "<td class='fields fieldPunti'>" + val.punti + "</td>";
                        riga += "<td class='fields fieldSpot'>" + val.spot + "</td>";
                        riga += "<td class='fields fieldSuper'>" + val.superspot + "</td>";
                        
                        riga += "</tr>";
                        
                        // le prime 23 righe vanno nella tabella di sinistra, dalla 24 in poi vanno a destra.
                        if (posizione == 24) {tabella = "#tabDestra"}
                        
                        $(tabella).append(riga);
                        
                        
                        });

	
		});
	
		
}

function SetClassificaCompagnia(compagnia) {
	// Servizio Web che eroga il dato
	var url=  'api/?method=classificacomp&format=json&compagnia=' + compagnia;

        // eliminazione di tutte le righe presenti
		$('.rigaClassifica').remove();

        // Contatore di posizione in classifica
        var posizione = 0;

        var tabella = "#tabClassifica";
        
        $.getJSON(url, function(data) {
                
                $.each(data.data, function(key, val) {
                         
                        var riga = "<tr class='rigaClassifica'>";
                        posizione++;
                        riga += "<td class='fields fieldPOS'>" + posizione + "</td>";
                        riga += "<td class='fields fieldPOS'>" + val.classe + "</td>";
                        riga += "<td class='fields fieldPOS'>" + val.categoria + "</td>";
                        
                        riga += "<td class='fields fieldNome'>" + toTitleCase(val.arciere) + "</td>";
                        riga += "<td class='fields fieldPunti'>" + val.punti + "</td>";
                        riga += "<td class='fields fieldSpot'>" + val.spot + "</td>";
                        riga += "<td class='fields fieldSuper'>" + val.superspot + "</td>";
                        
                        riga += "</tr>";
                        
                        
                        $(tabella).append(riga);
                        
                        
                        });

	
		});
}
    