<!-- #include file="config.inc" -->
<% 


' recuperiamo la pagina corrente 
Pagcorrente=Request("Pagcorrente")

if Pagcorrente="" then 
Pagcorrente=1
end if

if Pagcorrente<4 then
Pagsuccessiva=Pagcorrente+1
else
Pagsuccessiva=1
end if

set Rssingolo = Server.CreateObject("ADODB.Recordset")

'response.write(" Pagcorrente " & Pagcorrente &"<br>")

Prima=Pagcorrente*6-5
'response.write(" Prima " & Prima &"<br>")
Seconda=Pagcorrente*6-4
Terza=Pagcorrente*6-3
Quarta=Pagcorrente*6-2
Quinta=Pagcorrente*6-1
Sesta=Pagcorrente*6

'response.write(" Pagcorrente " & Pagcorrente &"<br>")

 %>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Piazzole</title>
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
<script>
<!--
function cambio(){

self.location.replace('piazzoletot.asp?Pagcorrente=<%=Pagsuccessiva%>');

}


function ciclocontinuo()
{

 window.setTimeout('cambio()',5000);
  //alert('test')
}
//-->
</script>
<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=10)">
<link href="stile.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>


<body background="sfondo_classcent.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="ciclocontinuo()">
<table width="100%" border="0">
   <tr>
    <td class="categoria"><div align="center">Piazzole</div></td>
  </tr>
  <tr>
    <td> <table width="100%" border="0">
        <tr>
          <td width="50%"><table width="100%"  border="1" bordercolor="#0000FF">
            <tr>
              <td><table width="100%" border="0">
                <tr>
                  <td class="POSclassifica">
                    <div align="center" class="posclassifica2">Piazzola <%= Prima %></div></td>
                  </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Prima&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center" class="nomeinpiazzola">
                      <%response.write(nome)%>
                  </div></td>
                  </tr>
				  
                <% 
				
				next %>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr class="POSclassifica">
                  <td class="posclassifica2">
                    <div align="center">Piazzola <%= Seconda %></div></td>
                </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Seconda&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center">
                      <%response.write(nome)%>
                  </div></td>
                </tr>
                <% 
				
				next %>
              </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0">
                <tr class="POSclassifica">
                  <td class="posclassifica2">
                    <div align="center">Piazzola <%= Terza %></div></td>
                </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Terza&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center">
                      <%response.write(nome)%>
                  </div></td>
                </tr>
                <% 
				
				next %>
              </table></td>
            </tr>
          </table></td>
          <td valign="top">		  <table width="100%"  border="1" bordercolor="#0000FF">
            <tr>
              <td><table width="100%" border="0">
                <tr class="POSclassifica">
                  <td class="posclassifica2">
                    <div align="center">Piazzola <%= Quarta %></div></td>
                </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Quarta&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center">
                      <%response.write(nome)%>
                  </div></td>
                </tr>
                <% 
				
				next %>
              </table></td>
            </tr>
			
			
					  <%  If Quinta < 29 then %>
			
            <tr>
			 
			 <td>
              
	
			  <table width="100%" border="0">
                <tr class="POSclassifica">
                  <td class="posclassifica2">
                    <% If Quinta < 29 then  %><div align="center">Piazzola <%= Quinta %></div> <% end if  %></td>
                </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Quinta&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center">
                      <%response.write(nome)%>
                  </div></td>
                </tr>
                <% 
				
				next %>
              </table>
			
			  </td>
            </tr>
            <tr>
              <td>
			  
			  
						   
			  <table width="100%" border="0">
                <tr class="POSclassifica">
                  <td class="posclassifica2">
                    <%  If Quinta < 29 then %><div align="center">Piazzola <%= Sesta %></div><% End If %></td>
                </tr>
                <% 
			  
			 	
				
			  for  j= 1 to 6
			' response.write(" j " & j &"<br>") 
				'verifichiamo se esiste un Arciere nella POSione corrente nella piazzola corrente
				
				ssql="SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA ="&Sesta&" AND POS ="& j 
				'response.write(" ssql " & ssql &"<br>")
				'response.flush
				Rssingolo.Open ssql, strConnString,adOpenDynamic
				
				if not Rssingolo.eof then
				nome=Rssingolo("NOME") &" " &Rssingolo("COGNOME") 
				else
				nome="&nbsp;"
				end if
				Rssingolo.close 
				
				 %>
                <tr >
                  <td nowrap class="nomeinpiazzola">
                    <div align="center">
                      <%response.write(nome)%>
                  </div></td>
                </tr>
                <% 
				
				next %>
              </table>
			 
			  </td>
            </tr>
          </table></td>
		    <% End If %>
        </tr>
      </table></td>
  </tr>
 
</table>
</body>
</html>
