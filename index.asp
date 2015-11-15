<!--#include file="config.inc"-->
<% set RsClassicat = Server.CreateObject("ADODB.Recordset")
' recuperare l'elenco classi categorie 
set rsclasscat = Server.CreateObject("ADODB.Recordset")

ssql=" SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE Order BY ISCRITTI.CATEGORIA , ISCRITTI.CLASSE DESC ;"

RsClassicat.Open ssql, strConnString	 


ncategorie=-1
		if (not RsClassicat.eof) then 
			


		avarGetRowsArray = RsClassicat.getrows()

		ncategorie=ubound(avarGetRowsArray,2)
			
		end if  %>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Aironi_consolle</title>
<link href="stile.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body leftmargin="2" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
  
  <tr>
    <td><table width="100%" border="1">
        <tr>
          <td><table border="0" cellpadding="0" cellspacing="1" bordercolor="#999999">
              <tr class="intestazioni"> 
                <td width="50"> <div align="right">Podio</div></td>
                <td width="100"> <div align="center">Classe</div></td>
                <td width="200"> <div align="center">Categoria</div></td>
                <td width="80"> <div align="left">Classifica</div></td>
              </tr>
              <% for j = 0 to ncategorie%>
              <% If  (j mod 2)=0 then 
		 bgcolor="#FFFF9E"
		 
		 
		 Else 
		 bgcolor="#FFFFFF"
		  
		  End  If 
		 classe=avarGetRowsArray(1,j)
		 categoria=avarGetRowsArray(0,j)
		 
		 if right(classe,1)="M" then
		 imgvideo="PodioSimpleM.jpg"
		 else
		 imgvideo="PodioSimpleF.jpg"
		 end if
		 
		 
		 
		  %>
              <tr bgcolor="<%=bgcolor%>"> 
                <td width="50"> <div align="right"><a href="#" onClick="MM_openBrWindow('podio.asp?classe=<%=classe%>&categoria=<%=categoria %>','onda','menubar=no,width=800,height=600')"><img src="immagini/<%=imgvideo%>" width="14" height="14" border="0"></a></div></td>
                <td width="100" class="classicatindex"> <div align="center"> 
                    <%response.write(avarGetRowsArray(1,j))%>
                  </div></td>
                <td width="200" class="classicatindex"> <div align="center"> 
                    <%response.write(avarGetRowsArray(0,j))%>
                  </div></td>
                <td width="80"> <div align="left"><a href="#" onClick="MM_openBrWindow('classifica.asp?classe=<%=classe%>&categoria=<%=categoria %>','onda','menubar=no,width=800,height=600')"><img src="immagini/<%=imgvideo%>" width="14" height="14" border="0"></a></div></td>
              </tr>
             <tr> 
          <td width="100" height="4"><img src="immagini/linea.jpg" width="100" height="4"></td>
          <td width="200" height="4"><img src="immagini/spaziatore.gif" width="1" height="1"></td>
          <td height="4"><img src="immagini/spaziatore.gif" width="1" height="1"></td>
          <td height="4"><img src="immagini/linead.JPG" width="200" height="4"></td>
        </tr> 
              <% next %>
            </table></td>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
              <tr> 
                <td width="200" class="intestazioni">Speciali</td>
                <td>&nbsp;</td>
              </tr>
              <tr class="intestazioni"> 
                <td width="200"><div align="center"></div></td>
                <td><div align="center"></div></td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Piazzole</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('piazzoletot.asp','onda','menubar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Autogiro</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('contenitore.htm','onda','menubar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Benvenuti</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('benveuti.htm','onda','toolbar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Autofoto</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('fotografie_auto.asp','onda','toolbar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>

              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>

       

            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
