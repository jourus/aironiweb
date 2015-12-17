<?php
include 'config.php';


//response.expires=-1

  	if (file_exists($pathfotogeneriche)){	
	  	$arrfiles = scandir($pathfotogeneriche);
	  	$numero_file = count($arrfiles);
  	}
  	else {
  		//$arrfiles = scandir($pathfotogeneriche);
  		$numero_file = 0;
  		
  	}
  	if($numero_file>0) {
  		$offset = 2; //i primi due file della cartella sono . e ..
	  	$randomphoto1 = $pathfotogeneriche . $arrfiles[mt_rand($offset, $numero_file - 1)];
	  	$randomphoto2 = $pathfotogeneriche . $arrfiles[mt_rand($offset, $numero_file - 1)];
	  	$randomphoto3 = $pathfotogeneriche . $arrfiles[mt_rand($offset, $numero_file - 1)];
  	}
  	else 
  	{
  		$randomphoto1 = $randomphoto2 = $randomphoto3 = $pathfoto . $FotoPodioStandard;

  	}


 
?>


	<html>
	<head>
	<title>Foto</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script>


	function cambiofoto(){

//	self.location.replace('fotografie_auto.asp');
	self.location.replace('fotografie.php');

	}


	function ciclocontinuo()
	{

	 window.setTimeout('cambiofoto()',10000);
	  
	}


	function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
	    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
	}
	MM_reloadPage(true);

	function MM_timelinePlay(tmLnName, myID) { //v1.2
	  //Copyright 1997, 2000 Macromedia, Inc. All rights reserved.
	  var i,j,tmLn,props,keyFrm,sprite,numKeyFr,firstKeyFr,propNum,theObj,firstTime=false;
	  if (document.MM_Time == null) MM_initTimelines(); //if *very* 1st time
	  tmLn = document.MM_Time[tmLnName];
	  if (myID == null) { myID = ++tmLn.ID; firstTime=true;}//if new call, incr ID
	  if (myID == tmLn.ID) { //if Im newest
	    setTimeout('MM_timelinePlay("'+tmLnName+'",'+myID+')',tmLn.delay);
	    fNew = ++tmLn.curFrame;
	    for (i=0; i<tmLn.length; i++) {
	      sprite = tmLn[i];
	      if (sprite.charAt(0) == 's') {
	        if (sprite.obj) {
	          numKeyFr = sprite.keyFrames.length; firstKeyFr = sprite.keyFrames[0];
	          if (fNew >= firstKeyFr && fNew <= sprite.keyFrames[numKeyFr-1]) {//in range
	            keyFrm=1;
	            for (j=0; j<sprite.values.length; j++) {
	              props = sprite.values[j]; 
	              if (numKeyFr != props.length) {
	                if (props.prop2 == null) sprite.obj[props.prop] = props[fNew-firstKeyFr];
	                else        sprite.obj[props.prop2][props.prop] = props[fNew-firstKeyFr];
	              } else {
	                while (keyFrm<numKeyFr && fNew>=sprite.keyFrames[keyFrm]) keyFrm++;
	                if (firstTime || fNew==sprite.keyFrames[keyFrm-1]) {
	                  if (props.prop2 == null) sprite.obj[props.prop] = props[keyFrm-1];
	                  else        sprite.obj[props.prop2][props.prop] = props[keyFrm-1];
	        } } } } }
	      } else if (sprite.charAt(0)=='b' && fNew == sprite.frame) eval(sprite.value);
	      if (fNew > tmLn.lastFrame) tmLn.ID = 0;
	  } }
	}

	function MM_timelineStop(tmLnName) { //v1.2
	  //Copyright 1997, 2000 Macromedia, Inc. All rights reserved.
	  if (document.MM_Time == null) MM_initTimelines(); //if *very* 1st time
	  if (tmLnName == null)  //stop all
	    for (var i=0; i<document.MM_Time.length; i++) document.MM_Time[i].ID = null;
	  else document.MM_Time[tmLnName].ID = null; //stop one
	}

	function MM_initTimelines() { //v4.0
	    //MM_initTimelines() Copyright 1997 Macromedia, Inc. All rights reserved.
	    var ns = navigator.appName == "Netscape";
	    var ns4 = (ns && parseInt(navigator.appVersion) == 4);
	    var ns5 = (ns && parseInt(navigator.appVersion) > 4);
	    document.MM_Time = new Array(1);
	    document.MM_Time[0] = new Array(4);
	    document.MM_Time["linefoto1"] = document.MM_Time[0];
	    document.MM_Time[0].MM_Name = "linefoto1";
	    document.MM_Time[0].fps = 15;
	    document.MM_Time[0][0] = new String("sprite");
	    document.MM_Time[0][0].slot = 1;
	    if (ns4)
	        document.MM_Time[0][0].obj = document["contfotouno"] ? document["contfotouno"].document["fotomove1"] : document["fotomove1"];
	    else if (ns5)
	        document.MM_Time[0][0].obj = document.getElementById("fotomove1");
	    else
	        document.MM_Time[0][0].obj = document.all ? document.all["fotomove1"] : null;
	    document.MM_Time[0][0].keyFrames = new Array(9, 45);
	    document.MM_Time[0][0].values = new Array(5);
	    if (ns5)
	        document.MM_Time[0][0].values[0] = new Array("-300px", "-292px", "-283px", "-275px", "-267px", "-258px", "-250px", "-242px", "-233px", "-225px", "-217px", "-208px", "-200px", "-192px", "-183px", "-175px", "-167px", "-158px", "-150px", "-142px", "-133px", "-125px", "-117px", "-108px", "-100px", "-92px", "-83px", "-75px", "-67px", "-58px", "-50px", "-42px", "-33px", "-25px", "-17px", "-8px", "0px");
	    else
	        document.MM_Time[0][0].values[0] = new Array(-300,-292,-283,-275,-267,-258,-250,-242,-233,-225,-217,-208,-200,-192,-183,-175,-167,-158,-150,-142,-133,-125,-117,-108,-100,-92,-83,-75,-67,-58,-50,-42,-33,-25,-17,-8,0);
	    document.MM_Time[0][0].values[0].prop = "left";
	    if (ns5)
	        document.MM_Time[0][0].values[1] = new Array("0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px");
	    else
	        document.MM_Time[0][0].values[1] = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	    document.MM_Time[0][0].values[1].prop = "top";
	    if (!ns4) {
	        document.MM_Time[0][0].values[0].prop2 = "style";
	        document.MM_Time[0][0].values[1].prop2 = "style";
	    }
	    document.MM_Time[0][0].values[2] = new Array("1","2");
	    document.MM_Time[0][0].values[2].prop = "zIndex";
	    if (!ns4)
	        document.MM_Time[0][0].values[2].prop2 = "style";
	    if (ns5)
	        document.MM_Time[0][0].values[3] = new Array("400px", "395px", "391px", "386px", "382px", "377px", "373px", "368px", "364px", "360px", "355px", "351px", "346px", "342px", "337px", "333px", "328px", "324px", "320px", "315px", "311px", "306px", "302px", "297px", "293px", "288px", "284px", "280px", "275px", "271px", "266px", "262px", "257px", "253px", "248px", "244px", "240px");
	    else
	        document.MM_Time[0][0].values[3] = new Array(400,395,391,386,382,377,373,368,364,360,355,351,346,342,337,333,328,324,320,315,311,306,302,297,293,288,284,280,275,271,266,262,257,253,248,244,240);
	    document.MM_Time[0][0].values[3].prop = "height";
	    if (!ns4)
	        document.MM_Time[0][0].values[3].prop2 = "style";
	    if (ns5)
	        document.MM_Time[0][0].values[4] = new Array("300px", "300px", "301px", "301px", "302px", "302px", "303px", "303px", "304px", "305px", "305px", "306px", "306px", "307px", "307px", "308px", "308px", "309px", "310px", "310px", "311px", "311px", "312px", "312px", "313px", "313px", "314px", "315px", "315px", "316px", "316px", "317px", "317px", "318px", "318px", "319px", "320px");
	    else
	        document.MM_Time[0][0].values[4] = new Array(300,300,301,301,302,302,303,303,304,305,305,306,306,307,307,308,308,309,310,310,311,311,312,312,313,313,314,315,315,316,316,317,317,318,318,319,320);
	    document.MM_Time[0][0].values[4].prop = "width";
	    if (!ns4)
	        document.MM_Time[0][0].values[4].prop2 = "style";
	    document.MM_Time[0][1] = new String("sprite");
	    document.MM_Time[0][1].slot = 2;
	    if (ns4)
	        document.MM_Time[0][1].obj = document["contfoto2"] ? document["contfoto2"].document["foto2"] : document["foto2"];
	    else if (ns5)
	        document.MM_Time[0][1].obj = document.getElementById("foto2");
	    else
	        document.MM_Time[0][1].obj = document.all ? document.all["foto2"] : null;
	    document.MM_Time[0][1].keyFrames = new Array(15, 45);
	    document.MM_Time[0][1].values = new Array(5);
	    if (ns5)
	        document.MM_Time[0][1].values[0] = new Array("0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px");
	    else
	        document.MM_Time[0][1].values[0] = new Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	    document.MM_Time[0][1].values[0].prop = "left";
	    if (ns5)
	        document.MM_Time[0][1].values[1] = new Array("1000px", "967px", "933px", "900px", "867px", "833px", "800px", "767px", "733px", "700px", "667px", "633px", "600px", "567px", "533px", "500px", "467px", "433px", "400px", "367px", "333px", "300px", "267px", "233px", "200px", "167px", "133px", "100px", "67px", "33px", "0px");
	    else
	        document.MM_Time[0][1].values[1] = new Array(1000,967,933,900,867,833,800,767,733,700,667,633,600,567,533,500,467,433,400,367,333,300,267,233,200,167,133,100,67,33,0);
	    document.MM_Time[0][1].values[1].prop = "top";
	    if (!ns4) {
	        document.MM_Time[0][1].values[0].prop2 = "style";
	        document.MM_Time[0][1].values[1].prop2 = "style";
	    }
	    document.MM_Time[0][1].values[2] = new Array("1","2");
	    document.MM_Time[0][1].values[2].prop = "zIndex";
	    if (!ns4)
	        document.MM_Time[0][1].values[2].prop2 = "style";
	    if (ns5)
	        document.MM_Time[0][1].values[3] = new Array("300px", "300px", "301px", "302px", "302px", "303px", "304px", "304px", "305px", "306px", "306px", "307px", "308px", "308px", "309px", "310px", "310px", "311px", "312px", "312px", "313px", "314px", "314px", "315px", "316px", "316px", "317px", "318px", "318px", "319px", "320px");
	    else
	        document.MM_Time[0][1].values[3] = new Array(300,300,301,302,302,303,304,304,305,306,306,307,308,308,309,310,310,311,312,312,313,314,314,315,316,316,317,318,318,319,320);
	    document.MM_Time[0][1].values[3].prop = "width";
	    if (!ns4)
	        document.MM_Time[0][1].values[3].prop2 = "style";
	    if (ns5)
	        document.MM_Time[0][1].values[4] = new Array("300px", "298px", "296px", "294px", "292px", "290px", "288px", "286px", "284px", "282px", "280px", "278px", "276px", "274px", "272px", "270px", "268px", "266px", "264px", "262px", "260px", "258px", "256px", "254px", "252px", "250px", "248px", "246px", "244px", "242px", "240px");
	    else
	        document.MM_Time[0][1].values[4] = new Array(300,298,296,294,292,290,288,286,284,282,280,278,276,274,272,270,268,266,264,262,260,258,256,254,252,250,248,246,244,242,240);
	    document.MM_Time[0][1].values[4].prop = "height";
	    if (!ns4)
	        document.MM_Time[0][1].values[4].prop2 = "style";
	    document.MM_Time[0][2] = new String("behavior");
	    document.MM_Time[0][2].frame = 45;
	    document.MM_Time[0][2].value = "MM_timelineStop('linefoto1')";
	    document.MM_Time[0][3] = new String("sprite");
	    document.MM_Time[0][3].slot = 3;
	    if (ns4)
	        document.MM_Time[0][3].obj = document["fogrande"] ? document["fogrande"].document["conffotgrande"] : document["conffotgrande"];
	    else if (ns5)
	        document.MM_Time[0][3].obj = document.getElementById("conffotgrande");
	    else
	        document.MM_Time[0][3].obj = document.all ? document.all["conffotgrande"] : null;
	    document.MM_Time[0][3].keyFrames = new Array(1, 12);
	    document.MM_Time[0][3].values = new Array(5);
	    if (ns5)
	        document.MM_Time[0][3].values[0] = new Array("0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px", "0px");
	    else
	        document.MM_Time[0][3].values[0] = new Array(0,0,0,0,0,0,0,0,0,0,0,0);
	    document.MM_Time[0][3].values[0].prop = "left";
	    if (ns5)
	        document.MM_Time[0][3].values[1] = new Array("-500px", "-455px", "-409px", "-364px", "-318px", "-273px", "-227px", "-182px", "-136px", "-91px", "-45px", "0px");
	    else
	        document.MM_Time[0][3].values[1] = new Array(-500,-455,-409,-364,-318,-273,-227,-182,-136,-91,-45,0);
	    document.MM_Time[0][3].values[1].prop = "top";
	    if (!ns4) {
	        document.MM_Time[0][3].values[0].prop2 = "style";
	        document.MM_Time[0][3].values[1].prop2 = "style";
	    }
	    if (ns5)
	        document.MM_Time[0][3].values[2] = new Array("500px", "500px", "500px", "500px", "500px", "500px", "500px", "500px", "500px", "500px", "500px", "500px");
	    else
	        document.MM_Time[0][3].values[2] = new Array(500,500,500,500,500,500,500,500,500,500,500,500);
	    document.MM_Time[0][3].values[2].prop = "width";
	    if (!ns4)
	        document.MM_Time[0][3].values[2].prop2 = "style";
	    if (ns5)
	        document.MM_Time[0][3].values[3] = new Array("400px", "400px", "400px", "400px", "400px", "400px", "400px", "400px", "400px", "400px", "400px", "400px");
	    else
	        document.MM_Time[0][3].values[3] = new Array(400,400,400,400,400,400,400,400,400,400,400,400);
	    document.MM_Time[0][3].values[3].prop = "height";
	    if (!ns4)
	        document.MM_Time[0][3].values[3].prop2 = "style";
	    document.MM_Time[0][3].values[4] = new Array("1","1");
	    document.MM_Time[0][3].values[4].prop = "zIndex";
	    if (!ns4)
	        document.MM_Time[0][3].values[4].prop2 = "style";
	    document.MM_Time[0].lastFrame = 45;
	    for (i=0; i<document.MM_Time.length; i++) {
	        document.MM_Time[i].ID = null;
	        document.MM_Time[i].curFrame = 0;
	        document.MM_Time[i].delay = 1000/document.MM_Time[i].fps;
	    }
	}

	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	
	</script>
	</head>
	<!-- <META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=2,Transition=23)"> -->
	<body bgcolor="#FFFFFF" background="immagini/AironeInFiligranaNeg.png" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_timelinePlay('linefoto1');ciclocontinuo();MM_preloadImages('<?php echo $randomphoto1 ?>');MM_preloadImages('<?php echo $randomphoto2 ?>');MM_preloadImages('<?php echo $randomphoto3 ?>');">
	<div id="contfoto2" style="position:absolute; width:320px; height:240px; z-index:3; left: 450; top: 10;">
	<div id="foto2" style="position:absolute; width:300px; height:300px; z-index:1; left: 0; top: 1000px;"><img src="<?php echo $randomphoto1 ?>" width="320"></div>
	</div>
	<div id="contfotouno" style="position:absolute; width:320px; height:400px; z-index:4; left: 400; top: 250; overflow: hidden;">
	<div id="fotomove1" style="position:absolute; width:300px; height:400px; z-index:4; left: -300px; top: 0;"><img src="<?php echo $randomphoto2 ?>" width="320"></div>
	</div>
	<div id="fogrande" style="position:absolute; width:480px; height:360px; z-index:1">
	<div id="conffotgrande" style="position:absolute; width:500px; height:400px; z-index:1; left: 0; top: -500px;"><img src="<?php echo $randomphoto3 ?>" width="480"></div>
	</div>
	</body>
	</html>
