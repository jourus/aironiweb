<!-- #include file="config.inc" -->
<% 

Compagnia=request("Compagnia")

'creare il file con i dati per generare il grafico degli scores consegnati per questa compagnia
'nomefilegrafico="c:\airo\sito\datagraph\"&classe&"_"&categoria&".txt"
nomefilegrafico="c:\andrea\airo\sito\datagraph\Compagnia.txt"

Dim fs,f
    set scorescons = Server.CreateObject("ADODB.Recordset")
	 set scoresNOcons = Server.CreateObject("ADODB.Recordset")
	set fs = Server.CreateObject("Scripting.FileSystemObject")
	set f = fs.CreateTextFile(nomefilegrafico,true) 
	f.Write("")
	
	ssqlgraficoCons="SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE COMP= '"&Compagnia&"' AND PUNTI IS NOT NULL"
	scorescons.Open ssqlgraficoCons, strConnString,adOpenDynamic
		
		ssqlgraficoNOCons="SELECT count(TESSERA) as numnocons FROM ISCRITTI WHERE  COMP= '"&Compagnia&"' AND PUNTI IS NULL"
		'response.write(" ssqlgraficoNOCons " & ssqlgraficoNOCons &"<br>")
	scoresNOcons.Open ssqlgraficoNOCons, strConnString,adOpenDynamic
		
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
ssql="SELECT ISCRITTI.NOME + ' ' + ISCRITTI.COGNOME AS ISCRITTI, PUNTI , SPOT ,CLASSE , CATEGORIA FROM ISCRITTI WHERE  COMP= '"&Compagnia&"' AND PUNTI IS NOT NULL ORDER BY COGNOME,CLASSE,categoria,PUNTI DESC"
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
				
		
			
		
		
		
		
		if numeroarciei > 25 then 
		
		limite1 = 25
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
        <tr class="classe"> 
         
          <td align="center"> 
            <% response.write("COMPAGNIA: "&compagnia&"<br>")
 %>
          </td>

     
        </tr>
      </table></td>
  </tr>
  <tr>
    <td> <table width="100%" border="0">
        <tr>
          <td width="50%" valign="top"><table width="100%" border="0">
              <tr class="posclassifica"> 
                <td width="60"> <div align="center" class="posclassifica">CLASSE CATEGORIA</div></td>
                <td> <div align="center">Nome</div></td>
                <td>&nbsp;</td>
                <td width="100"> <div align="right">Punti</div></td>
                <td width="100"> <div align="right">Spot</div></td>
                <td>&nbsp;</td>
              </tr>
              <% 
			  
			 
			  for j = 0 to limite1
			
				
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
                <td class="tabellapodio"> <div align="center"> 
                    <%response.write(avarGetRowsArray(3,j)&" "&avarGetRowsArray(4,j))%>
                  </div></td>
                <td nowrap> 
                  <div align="center"> 
                    <%response.write(avarGetRowsArray(0,j))%>
                  </div></td>
                <td>&nbsp;</td>
                <td width="100" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(1,j))%>
                  </div></td>
                <td width="100" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(2,j))%>
                  </div></td>
                <td class="tabellapodio">&nbsp;</td>
              </tr>
              <% next %>
          </table></td>
          <td valign="top">
		  <table width="100%" border="0">
		  <% If  limite2<>-1 then%>
              <tr class="posclassifica2"> 
                <td width="60"> <div align="center" class="posclassifica2">POS</div></td>
                <td> <div align="center">Nome</div></td>
                <td>&nbsp;</td>
                <td width="100"> <div align="right">Punti</div></td>
                <td width="100"> <div align="right">Spot</div></td>
                <td>&nbsp;</td>
              </tr>
			  <% End If %>
              <% for j =26 to limite2
			
				
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
                <td class="tabellapodio"> <div align="center"> 
                     <%response.write(avarGetRowsArray(3,j)&" "&avarGetRowsArray(4,j))%>
                  </div></td>
                <td nowrap> 
                  <div align="center"> 
                    <%response.write(avarGetRowsArray(0,j))%>
                  </div></td>
                <td>&nbsp;</td>
                <td width="100" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(1,j))%>
                  </div></td>
                <td width="100" class="tabellapodio"> <div align="right"> 
                    <%response.write(avarGetRowsArray(2,j))%>
                  </div></td>
                <td class="tabellapodio">&nbsp;</td>
              </tr>
              <% next %>
            </table> 
			
			<!-- Tab Ploticus per Grafico-->
			
		  </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
