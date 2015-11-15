<!-- #include file="config.inc" -->
<% 

classe=request.QueryString("classe")
categoria=request.QueryString("categoria")


'creare il file con i dati per generare il grafico degli scores consegnati
'nomefilegrafico="c:\airo\sito\datagraph\"&classe&"_"&categoria&".txt"
nomefilegrafico="c:\andrea\airo\sito\datagraph\CLASSE_CATEGORIA.txt"

Dim fs,f



    set scorescons = Server.CreateObject("ADODB.Recordset")
	 set scoresNOcons = Server.CreateObject("ADODB.Recordset")
	set fs = Server.CreateObject("Scripting.FileSystemObject")
	set f = fs.CreateTextFile(nomefilegrafico,true) 
	f.Write("")
	
	ssqlgraficoCons="SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE CLASSE= '"&classe&"' AND CATEGORIA = '"&categoria&"' AND PUNTI IS NOT NULL"
	scorescons.Open ssqlgraficoCons, strConnString,adOpenDynamic
		
		ssqlgraficonoCons="SELECT count(Tessera) as numnocons FROM ISCRITTI WHERE CLASSE= '"&classe&"' AND CATEGORIA = '"&categoria&"' AND PUNTI IS NULL"
	scoresNOcons.Open ssqlgraficonoCons, strConnString,adOpenDynamic
		
		f.WriteLine("""Consegnati""" & " " & ""&scorescons("numcons")&"" )

		f.WriteLine("""In Attesa""" & " " & ""&scoresNOcons("numnocons")&"" )
		
		
	f.Close
	set f=nothing
	set fs=nothing
	set scoresNOcons=nothing
	set scorescons=nothing


set rscalssifica = Server.CreateObject("ADODB.Recordset")
' recuperare l'elenco classi categorie 
set rsclasscat = Server.CreateObject("ADODB.Recordset")
ssql="SELECT ISCRITTI.NOME + ' ' + ISCRITTI.COGNOME AS ISCRITTI, PUNTI , SPOT + SUPERSPOT as SPOT, SUPERSPOT as SUPER  FROM ISCRITTI WHERE CLASSE= '"&classe&"' AND CATEGORIA = '"&categoria&"' AND PUNTI IS NOT NULL ORDER BY PUNTI DESC, SPOT + SUPERSPOT DESC"
rscalssifica.Open ssql, strConnString,adOpenDynamic

		'response.write(ssql)

		if not(rscalssifica.eof) AND not(rscalssifica.bof) then 
		
		
		avarGetRowsArray = rscalssifica.getrows()

		numeroarciei=ubound(avarGetRowsArray,2)
		
		
		else
		numeroarciei=-1
		
		
		end if
		
		
		
		
		
		rscalssifica.close
		set rscalssifica= nothing
				
		
			
		
		
		
		
		
		if numeroarciei > MaxRigheArcieriInClassifica then 
		
		limite1 = MaxRigheArcieriInClassifica
		limite2 = numeroarciei
		else
		
		limite1 = numeroarciei
		limite2 = -1
		
		end if
		
		'response.write("narc "&numeroarciei+1&"<br>")
		
		
		
		
 %>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>classifica</title>
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

<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=12)">
<link href="stile.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

 
<body background="sfondo_class.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0">
        <tr class="posclassifica"> 
          <td></td>
          <td class="classe">- 
            <% response.write("CLASSE: "&classe&"<br>")
 %>          </td>
          <td class="classe"> -
            <% response.write("CATEGORIA: "&categoria&"<br>") %>          </td>
          <td width="100">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="440" valign="top"> <table width="100%" border="0">
        <tr>
          <td width="48%" valign="top"><table width="100%" border="0">
              <tr class="posclassifica"> 
                <td width="60"> <div align="center" class="posclassifica">POS</div></td>
                <td> <div align="center">Nome</div></td>
                <td>&nbsp;</td>
                <td width="70"> <div align="right">Punti</div></td>
                <td width="70"> <div align="right">Spot</div></td>
                <!-- 2011.03.27 GFF Aggiunta colonna super--> 
                <td width="70" > <div align="right">Super</div></td>
                
                <td>&nbsp;</td>
              </tr>
              <% 
			  
			 
			  for j = 0 to limite1
			
				
				 %>
              <tr class="tabellapodio"> 
                <td class="tabellapodio"> <div align="center"> 
                    <%response.write(j+1)%>
                  </div></td>
                <td nowrap> 
                  <div align="center" > 
                    <%response.write(avarGetRowsArray(0,j))%>
                  </div></td>
                <td>&nbsp;</td>
                <td width="70" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(1,j))%>
                  </div></td>
                <td width="70" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(2,j))%>
                  </div></td>
                  <!-- 2011.03.27 GFF Aggiunta colonna super--> 
                <td width="70" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(3,j))%>
                  </div></td>
                <td class="tabellapodio">&nbsp;</td>
              </tr>
              <% next %>
          </table></td>
          <td valign="top">
		  <table width="100%" border="0">
		  <% If  limite2<>-1 then%>
              <tr class="posclassifica2"> 
              	
              	<td width="50"> <div align="right">&nbsp;</div></td>
              	
                <td width="60"> <div align="center" class="posclassifica2">POS</div></td>
                <td> <div align="center">Nome</div></td>
                <td>&nbsp;</td>
                <td width="70"> <div align="right">Punti</div></td>
                <td width="70"> <div align="right">Spot</div></td>
                 <!-- 2011.03.27 GFF Aggiunta colonna super--> 
                 <td width="70"> <div align="right">Super</div></td>
                <td>&nbsp;</td>
              </tr>
			  <% End If %>
              <% for j =MaxRigheArcieriInClassifica + 1 to limite2
			
				
				'response.write("<tr>")
				'response.write("<td>")
				'response.write(j+1)
				'response.write("</td>")
				'response.write("<td>")
				'response.write(avarGetRowsArray(4,j))
				'response.write("</td>")
				'response.write("<td>")
				'response.write(avarGetRowsArray(1,j))
				'response.write("</td>")
				'response.write("<td>")
				'response.write(avarGetRowsArray(2,j))
				'response.write("</td>")
				'response.write("</tr>")
				 %>
              <tr class="tabellapodio"> 
              	<td>&nbsp;</td>
                <td class="tabellapodio"> <div align="center"> 
                    <%response.write(j+1)%>
                  </div></td>
                  
                <td nowrap> 
                  <div align="center"> 
                    <%response.write(avarGetRowsArray(0,j))%>
                  </div></td>
                <td>&nbsp;</td>
                <td width="70" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(1,j))%>
                  </div></td>
                <td width="70" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(2,j))%>
                    </td>
                <td width="70" class="tabellapodio"> <div align="right"> 
                	<%response.write(avarGetRowsArray(3,j))%>
                    <!-- 2011.03.27 GFF Aggiunta colonna super--> 
                </div></td>
                <td class="tabellapodio">&nbsp;</td>
              </tr>
              <% next %>
            </table> 
			
			<!-- Tab Ploticus per Grafico-->
			<table width="100%" border="0">
              <tr class="posclassifica2"> 
                <td class="PloticusTitle"> <div align="center"><!-- Situazione Scores per Classe: <%= classe %> Categoria: <%= categoria %> --> </div></td>
              </tr>
              <tr class="tabellapodio"> 
                <td class="tabellapodio"> </td>
              </tr>
              <tr class="tabellapodio">
                <td class="tabellapodio"><!-- <img src=../../_code/ploticus/bin/pl.exe?cgi=1&-gif&prefabs\pie.pl&values=2&colors=auto&radius=2&firstslice=120&center=25%2025&explode=.1&labelfmtstring=@1\n(@PCT%)&data=c:\andrea\airo\sito\datagraph\CLASSE_CATEGORIA.txt>--></td>
              </tr>
            </table>
			
		  </td>
        </tr>
    </table></td>
  </tr>
</table>
<% 


    set scorescons = Server.CreateObject("ADODB.Recordset")
	ssqCons="SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE Piazzuola="

set rscalssifica = Server.CreateObject("ADODB.Recordset")

 %>
<table width="100%" border="0">
  <tr class="posclassifica2">
    <td class="PloticusTitle">Situazione Consegna Scores </td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio">
	<!--tabella Piazzole-->
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <% For i = 1 to NumeroPiazzoleGara / 2 
		 
		  scorescons.Open ssqCons&" "&i , strConnString,adOpenDynamic
		  
		   'response.write(" xxxx " & scorescons("numcons"))
		  
		  
		  if scorescons("numcons")=0 then 
		  piazzscoreconsyesno="piazzscoreconsno"
		  	else
		  	piazzscoreconsyesno="piazzscoreconsyes"
		  End If 
		  
		  scorescons.close
		   %>
          <td class="<%=piazzscoreconsyesno%>"><%= Response.Write(right("0"&i,2)) %></td>
          <% next %>
        </tr>
      </table>
	  </td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio">
	<!--tabella Piazzole-->
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <% For i = 1 + (NumeroPiazzoleGara / 2) to NumeroPiazzoleGara 
		  
		  scorescons.Open ssqCons&" "&i , strConnString,adOpenDynamic
		  
		  if scorescons("numcons")=0 then 
		  piazzscoreconsyesno="piazzscoreconsno"
		  	else
		  	piazzscoreconsyesno="piazzscoreconsyes"
		  End If
		  scorescons.close
		  
		  if (i <= NumeroPiazzoleGara) then
		  
		   %>
           <td class="<%=piazzscoreconsyesno%>"><% Response.Write(i) %></td>
           
           
          <% else %>
          
           <td class="piazzscoreneutro">00</td>
          <%
          end if
          
          next %>
        </tr>
      </table>
	  </td>
  </tr>
  <tr class="tabellapodio">
    <td class="vocimenu">Legenda</td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="piazzscoreconsyes">Piazzola che ha  CONSEGNATO</td>
        <td class="piazzscoreconsno">Piazzola che NON ha CONSEGNATO</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
