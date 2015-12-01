// Questa funzione chiama l'api che decodifica l'id di una classe e restituisce la relativa descrizione
function decodeClasse(idClasse) {
	
	try {
	
		var url=  'api/?method=classi&format=json&cla=' + idClasse;
		$.getJSON(url, function(data) {
			
			if (data.data.lenght > 0){
				return data.data.val.DescrizioneClasse;
			}
			else
				return null;
			
			/* $.each(data.data, function(key, val) {
				// $(elemento).append('<tr><td>' + val.Posizione + '</td><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				return(  val.DescrizioneClasse );
				 
				});*/
		});
	}
	catch (exception) {
		
		return null;
	}

}  


//Questa funzione recupera la descrizone di una classe e la usa per impostare il titolo della pagina
function ImpostaDescrizioneClasse(idClasse) {
	var url=  'api/?method=classi&format=json&cla=' + idClasse;
		$.getJSON(url, function(data) {
			$.each(data.data, function(key, val) {
				// $(elemento).append('<tr><td>' + val.Posizione + '</td><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				alert(  val.DescrizioneClasse );
				 
				});
		});


}  

