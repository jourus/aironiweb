/**
 * 
 */

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

function formatDate(giorno) {
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

function SetInfogara(objectName) {
	var url=  'api/?method=infogara&format=json';
	$.getJSON(url, function(data) {
		
		if (data.status ==200){
			$(objectName).text(data.data.localita + ' (' + data.data.provincia + '), ' + formatDate(data.data.data));
	
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
		//if (data.data.length > 0){
			//$('#NomeArciere3').text(data.data[0].arciere);
				
			$('#NomeArciere' + conta).text(val.arciere);
			$('#PodioPunti' + conta).text(val.punti);
			$('#PodioSpot' + conta).text(val.spot);
			$('#PodioSuper' + conta).text(val.superspot);
			$('#FotoPodio' + conta).attr('src','immagini/foto/' + val.foto);
			$("#divPodio" + conta).fadeIn(3000);
			$("#BarraVerticalePodio" + conta).fadeIn(3000);
			conta ++;
		});
		
	});
 
}