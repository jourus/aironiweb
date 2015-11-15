<!-- #include file="config.inc" -->
<% 
set RsClassicat = Server.CreateObject("ADODB.Recordset")
' recuperare l'elenco classi categorie diverse dagli scores consegnati che hanno punti



'ssql="SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE, Count(ISCRITTI.CATEGORIA) AS ConteggioDiCATEGORIA FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE ORDER BY Count(ISCRITTI.CATEGORIA) DESC;"

ssql="SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE, Count(ISCRITTI.CATEGORIA) AS ConteggioDiCATEGORIA, Sum(ISCRITTI.PUNTI) AS SommaDiPUNTI FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE HAVING (((Sum(ISCRITTI.PUNTI)) Is Not Null)) ORDER BY Count(ISCRITTI.CATEGORIA) DESC"


'ssql=" SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE;"

RsClassicat.Open ssql, strConnString	

arrayclassi=""
arraycategorie=""

terminestringa="'fine'"

		if (not RsClassicat.eof) then 
			do while (not RsClassicat.eof)	
				categoria=RsClassicat.fields("categoria")
				classe=RsClassicat.fields("classe")
				arrayclassi=arrayclassi&"'"&classe&"',"
				arraycategorie=arraycategorie&"'"&categoria&"',"
				RsClassicat.movenext
			loop
		end if 
		
		set RsClassicat=nothing
		arrayfinaleclassi=arrayclassi&terminestringa
		arrayfinalecategorie=arraycategorie&terminestringa
		
		
		
		set rscomp = Server.CreateObject("ADODB.Recordset")
		
		SSQLCOMPAGNIE="SELECT DISTINCT COMP FROM ISCRITTI WHERE PUNTI IS NOT NULL"
		rscomp.Open SSQLCOMPAGNIE, strConnString	


arraycompagnie=""

terminestringacomp="'finecomp'"

		if (not rscomp.eof) then 
			do while (not rscomp.eof)	
				COMP=rscomp.fields("COMP")
				
				arraycompagnie=arraycompagnie&"'"&COMP&"',"
				
				rscomp.movenext
			loop
		end if 
		
		set rscomp=nothing
		
		arraycompagnie=arraycompagnie&terminestringacomp
		



		
		

		response.write(arrayfinaleclassi&"<BR>"&arrayfinalecategorie&"<br>"&arraycompagnie)
 %>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Logica</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script>
//script Aury



var arrclassi= [<%= arrayfinaleclassi %>] ;
var arrcategorie= [<%= arrayfinalecategorie %>] ;
var arrCompagnie= [<%= arraycompagnie%>] ;
var indice = 0 ;
var indicecomp = 0 ;
var tiposchermata = 0 ; 
var secondiciclo = 4000 ;
var TutteCompagnie = 0;
var TutteClassi = 0 ;
// 0 podio 123 , 1 classifica completa , 2 foto varie, 3 classifica compagnie
</script>

<SCRIPT TYPE="text/javascript">
<!--

function cambiapodio(){

classe=arrclassi[indice];
categoria=arrcategorie[indice];
compagnia=arrCompagnie[indicecomp];

if ((TutteClassi==1) && (TutteCompagnie==1))
//reload della pagina per ricostruire gli array con in nuovi cat classi e compagnie che hanno punti
{
self.location.replace('logica.asp');
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

		vartiposchermata = tiposchermata
		//alert (vartiposchermata)
		if (vartiposchermata == 0) 
						{//schermata del podio classico
						
							//contollare il tipo di categoria pere decidere il podio
							
								urlpodio='podio.asp?classe='+classe+'&categoria='+categoria;
								
								//alert(urlpodio);
								parent.contpodio.location.replace(urlpodio);
								tiposchermata = tiposchermata+1
						}
						else
								{
								if (vartiposchermata == 1) {//schermata classifica
						
								urlpodio='classifica.asp?classe='+classe+'&categoria='+categoria;
								
								
								parent.contpodio.location.replace(urlpodio);
								tiposchermata = tiposchermata+1;
								indice=indice+1;
															}
								else
									{
									
									
									if (vartiposchermata == 2) {//schermata foto
												urlpodio='fotografie.asp';
												//alert(urlpodio);
												
												parent.contpodio.location.replace(urlpodio);
												tiposchermata = tiposchermata+1;
												//commentare la riga sotto per avere la class per compagnie
												//tiposchermata = 0;
												//
												tiposchermata = tiposchermata + 1;
															}
												else
												{//schermata classifica per comp
										 		
												
												
												urlpodio='classifica_compagnia.asp?Compagnia='+compagnia;
												//alert(urlpodio);
												
												parent.contpodio.location.replace(urlpodio);
												indicecomp=indicecomp+1;
												tiposchermata = 0;
												
												
												
												}
									
									
									
									}		
								
								
								}		
									




}

}





function ciclocontinuo()
{

 var tempo = cambiapodio();		
 
 window.setTimeout('ciclocontinuo()',secondiciclo);
		
  //alert('ciao');
}

//-->
</script>

<!-- <body onload="window.setTimeout('getSecs()',1)"> -->
<body onload="ciclocontinuo();">
</body> 
</html>
