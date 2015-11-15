<!-- #include file="config.inc" -->
<% 

classe=request.QueryString("classe")
categoria=Trim(Request.QueryString("categoria"))

'response.write("x "&categoria&"<br>")








select case categoria

case "AS" 
sfondo="sfondo-lon.gif"
case "LB" 
sfondo="sfondo-lon.gif"
case "RI" 
sfondo="sfondo-ric.gif"
case "CO" 
sfondo="sfondo-comp.gif"
case "SL" 
sfondo="sfondo-comp.gif"
case "SI" 
sfondo="sfondo-comp.gif"

case else 
sfondo="sfondo-sto.gif"
end select 

set rspodio = Server.CreateObject("ADODB.Recordset")
' recuperare l'elenco classi categorie 
set rsclasscat = Server.CreateObject("ADODB.Recordset")

ssql="SELECT TOP 3 A.CATEGORIA, A.PUNTI, A.SPOT + A.SUPERSPOT as SPOT, A.NOME + ' ' + A.cognome as ISCRITTI , A.CLASSE, B.NomeFile FROM ISCRITTI A LEFT JOIN IMMAGINI B ON A.TESSERA = B.ID WHERE A.CLASSE= '"&classe&"' AND A.CATEGORIA = '"&categoria&"' AND A.PUNTI is not null  ORDER BY A.PUNTI DESC, A.SPOT + A.SUPERSPOT DESC;"


'response.write("x"&ssql&"<br>")
rspodio.Open ssql, strConnString,adOpenDynamic

				anagrafica1=""
				punti1=""
				spot1=""
				anagrafica2=""
				punti2=""
				spot2=""
				anagrafica3=""
				punti3=""
				spot3=""
				foto1=fotopodiostandard
				foto2=fotopodiostandard
				foto3=fotopodiostandard
		dim i 
	
	
			
			i = -1
			do until rspodio.eof
				i = i + 1 
				
				'response.write rspodio.fields("iscritti")
				'response.write rspodio.fields("punti")
				'response.write rspodio.fields("spot") & "<br>"
				
				'response.write rspodio.fields("NomeFile") & "xxxxxxxxxxxxxx<br>"
				
				select case i 
				
				case 0
				anagrafica1=rspodio.fields("iscritti")
				punti1=rspodio.fields("punti")
				spot1=rspodio.fields("spot")
					
					if isnull(rspodio.fields("NomeFile"))then
				foto1=fotopodiostandard
					else
				foto1=rspodio.fields("NomeFile")
					end if
				
				case 1
				
				anagrafica2=rspodio.fields("iscritti")
				punti2=rspodio.fields("punti")
				spot2=rspodio.fields("spot")
				
					if isnull(rspodio.fields("NomeFile"))then
				foto2=fotopodiostandard
					else
				foto2=rspodio.fields("NomeFile")
					end if
				
				
				case 2
				
				anagrafica3=rspodio.fields("iscritti")
				punti3=rspodio.fields("punti")
				spot3=rspodio.fields("spot")
				
				if isnull(rspodio.fields("NomeFile"))then
				foto3=fotopodiostandard
					else
				foto3=rspodio.fields("NomeFile")
					end if
				
				end select
				
				
				
				rspodio.movenext
			loop
		rspodio.close
		set rspodio= nothing

			
		
		
		arrayfinaleclassi=iniziostringa&arrayclassi&terminestringa
		arrayfinalecategorie=iniziostringa&arraycategorie&terminestringa
		
		response.write(arrayfinaleclassi&"<BR>"&arrayfinalecategorie)
 %>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Podio</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<link href="stile" rel="styleshpatht" type="text/css">
<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=12)">
<link href="stile.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<body background="<%=sfondo%>" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" tracingsrc="sfondo-comp.gif" tracingopacity="100">
<div id="classe" style="position:absolute; left:242px; top:19px; width:201px; height:23px; z-index:1;"> 
  <div align="left" class="categoria"><%= classe %></div>
</div>
<div id="categoria" style="position:absolute; left:242px; top:64px; width:315px; height:28px; z-index:2;" class="classe"> 
  <div align="left"><%= categoria %></div>
</div>
<div id="punti2" style="position:absolute; left:154px; top:445px; width:130px; height:19px; z-index:3" class="punti"><%= punti2%></div>
<div id="spot2" style="position:absolute; left:153px; top:472px; width:133px; height:20px; z-index:4" class="spot"><%= spot2%></div>
<div id="foto2" style="position:absolute; left:100px; top:161px; width:190px; height:253px; z-index:5"><img src="immagini/foto/<%=foto2%>" width="190" height="253"></div>
<div id="punti1" style="position:absolute; left:371px; top:385px; width:130px; height:19px; z-index:3" class="punti"><%= punti1 %></div>
<div id="spot1" style="position:absolute; left:371px; top:414px; width:130px; height:20px; z-index:4" class="spot"><%= spot1%></div>
<div id="punti3" style="position:absolute; left:580px; top:457px; width:130px; height:19px; z-index:3" class="punti"><%= punti3 %></div>
<div id="spot3" style="position:absolute; left:579px; top:481px; width:133px; height:20px; z-index:4" class="spot"><%= spot3%></div>
<div id="foto1" style="position:absolute; left:310px; top:105px; width:190px; height:253px; z-index:5" class="anagrafica"><img src="immagini/foto/<%=foto1%>" width="190" height="253"></div>
<div id="foto3" style="position:absolute; left:522px; top:170px; width:190px; height:253px; z-index:5"><img src="immagini/foto/<%=foto3%>" width="190" height="253"></div>
<div id="anagrafica1" style="position:absolute; width:190px; height:21px; z-index:6; left: 100px; top: 418px; background-color: #DEEFFF; layer-background-color: #DEEFFF; border: 1px none #000000;" class="anagrafica"> 
  <div align="center"><%=anagrafica2%></div>
</div>
<div id="anagrafica2" style="position:absolute; width:190px; height:21px; z-index:6; left: 311px; top: 363px; background-color: #DEEFFF; layer-background-color: #DEEFFF; border: 1px none #000000;" class="anagrafica"> 
  <div align="center"><%=anagrafica1%></div>
</div>
<div id="anagrafica3" style="position:absolute; width:190px; height:21px; z-index:6; left: 522px; top: 432px; background-color: #DEEFFF; layer-background-color: #DEEFFF;" class="anagrafica"> 
  <div align="center"><%=anagrafica3%></div>
</div>
</body>
</html>
