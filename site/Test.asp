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
	
	ssqlgraficoCons="SELECT count(PUNTI) as numcons FROM airo.dbo.ISCRITTI WHERE CLASSE= '"&classe&"' AND CATEGORIA = '"&categoria&"' AND PUNTI IS NOT NULL"
	scorescons.Open ssqlgraficoCons, strConnString,adOpenDynamic
		
		
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
Ciao
</body>
</html>
