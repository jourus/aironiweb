<!-- #include file="config.inc" -->
<% 


    set scorescons = Server.CreateObject("ADODB.Recordset")
	ssqCons="SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE Piazzuola="

set rscalssifica = Server.CreateObject("ADODB.Recordset")

 %>
<table width="100%" border="0">
  <tr class="posclassifica2">
    <td class="PloticusTitle">Scores Consegnati per piazzola</td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio">&nbsp;</td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio">
	<!--tabella Piazzole-->
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <% For i = 1 to 14 
		 
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
          <% For i = 15 to 28 
		  
		  scorescons.Open ssqCons&" "&i , strConnString,adOpenDynamic
		  
		  if scorescons("numcons")=0 then 
		  piazzscoreconsyesno="piazzscoreconsno"
		  	else
		  	piazzscoreconsyesno="piazzscoreconsyes"
		  End If
		  scorescons.close
		   %>
           <td class="<%=piazzscoreconsyesno%>"><%= Response.Write(i) %></td>
          <% next %>
        </tr>
      </table>
	  </td>
  </tr>
</table>