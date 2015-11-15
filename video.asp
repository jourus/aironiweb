<!--#include file="config.inc"-->
<% 
response.expires=-1
dim elencodir 

Set elencodir = CreateObject("Scripting.FileSystemObject")

'If   1=2 Then
If   elencodir.FolderExists(pathVideogeneriche) Then
   
   Response.Write("dir esistente")

   
  	Set fs=CreateObject("Scripting.FileSystemObject") 
	Set f=fs.GetFolder(pathVideogeneriche) ' directory che verrà esaminata 
	set fc=f.Files 

	numero_file=-1
	dim arrfiles(500) 

	for Each whatever in fc 
	numero_file=numero_file+1
   	arrfiles(numero_file)=Trim(whatever.name) 
   	 
	next 

	

randomize
sngRandomValue = intRangeSize * Rnd(timer())


sngRandomValue = sngRandomValue + intLowerBound


intRandomInteger = Int(Rnd(timer())*numero_file)




randomfoto1=arrfiles(intRandomInteger)




'response.write("x"&intRandomInteger&"<br>")

	
	
	
	
	
else

		randomfoto1=videostandard
		

End If



set elencodir = nothing
set fs = nothing


 %>

<html>
<head>
<title>Foto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--

function cambioVideo(){

self.location.replace('video.asp');

}


function ciclocontinuo()
{

 window.setTimeout('cambioVideo()',40000);
  
}




function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<!-- <META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=2,Transition=23)"> -->
<body bgcolor="#FFFFFF" background="sfondo_class.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >

<OBJECT data="<%=randomfoto1%>"  WIDTH="416" HEIGHT="256" > </object>


</body>
</html>
