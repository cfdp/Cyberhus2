<?
/* Ændret d. 14.05.09 af benjamin@cyberhus.dk - webcambillede fjernet fra introside inden login...*/

require("client_conf.inc");
$setting_filename = "settings/chat_open_or_not.txt";

$action = ($_POST['action'] == '' ? $_GET['action'] : $_POST['action']);

if($new_session==1){
	genClientLog("New session");
	session_unset();
	session_destroy();
	unset($_SESSION['clientCode']);
	unset($_SESSION['linkCode']);
	unset($_SESSION['session_id']);
	unset($_SESSION['name']); //FUCK!
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Rådgivningschat</title>
<link href="client.css" type="text/css" rel="stylesheet">
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
</head>
<body>


<div id="chatborder">
	<div id="chat">
		
		<div id="logo">&nbsp;</div>
		
		<div id="chatwindowborder">
    		<div id="chatwindow">
    			
  			 <div id="ScriptContainer"></div>
                <div id="ChatContent">
    			<?
    			$died = false;
                if($action=="logout"){
                  mysql_query("update sessions set status='closed' where id='".$_SESSION['session_id']."'") or die("<br><br>error 7...<br><br>");
                  genClientLog("Logout");
                  session_unset();
                  session_destroy();
                  echo ("
                  <br><br>
                  Tak for besøget - Du er velkommen til at vende tilbage til os igen :)
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type=\"button\" onClick=\"self.close()\" value=\"Luk vinduet\">
                  ");
                  $died = true;
                  genClientLog("Logout sessions destroyed");
                  
                  $sqlCheck = "SELECT id FROM sessions WHERE status != 'closed'";
                  $qCheck = mysql_query($sqlCheck);
                  $amount = mysql_num_rows($qCheck);
                  if ($amount === 0) {
                    file_put_contents ($setting_filename , 0 );
                  } else {
                    file_put_contents ($setting_filename , 1 );
                  }
                  
                }
    			?>
    			
    			<?
                if($action=="openchat"){
                  genClientLog("LogIn");
                  $query = "SELECT * FROM sessions WHERE clientCode='' AND status='ready' LIMIT 1";
                  $sql = mysql_query($query) or die("<br><br>error 3, kontakt en administrator eller prøv igen...<br><br>");
                  $count = mysql_num_rows($sql);
                  
                  if($count == 0){
                  	echo ("
                  	<br><br>Chatten er afsluttet. Der kan være opstået en fejl. Hvis du vil skrive med en rådgiver igen skal du logge af og åbne en ny chat. <br><br>God dag<br><br>
                  	<input type=\"button\" onClick=\"self.close()\" value=\"Luk vinduet\">
                  	");
                  	$died = true;
                  }
                  $show=mysql_fetch_array($sql);
                  $_SESSION['clientCode']=genCode(80);
                  $_SESSION['linkCode']=$show['linkCode'];
                  $_SESSION['session_id']=$show['id'];
                  $_SESSION['name']=$_POST['guest_navn'];
                  $query="update sessions set clientCode='".$_SESSION['clientCode']."', status='open', clientIP='".encode($_SERVER['REMOTE_ADDR'])."' where linkCode='".$show['linkCode']."' and id='".$show['id']."'";
                  mysql_query($query) or die("<br><br>error 4, kontakt en administrator eller prøv igen...");
                  
                  $msg = "er logget ind...";
                  $query="insert into log set session_id='".$_SESSION['session_id']."',msg='".encode("<b>".$_SESSION['name']." </b> ".$msg)."', who='guest', udate='".time()."'";
                  mysql_query($query) or die("<br><br>error 6, kontakt en administrator eller prøv igen...<br><br>");
                  
                  mysql_query("update sessions set clientTB='".time()."' where clientCode='".$_SESSION[clientCode]."' and linkCode='".$_SESSION[linkCode]."'") or die(mysql_error());
                  genClientLog("LogIn plus sessions");
                }
    			?>
    			
    			<?
    			if (!$died) {
                if($_SESSION['linkCode']!="" && $_SESSION['clientCode']!=""){
                  genClientLog("Start chat");
                  
                  ?>
                  
                  &nbsp;&nbsp;&nbsp;
                  <script>
                  var iCurrentScriptID = 0;
                  var oCurrentScript;
                  
                  //onclose event
                  window.onbeforeunload = function () {
                  	return "BEMÆRK: Du er ved at for forlade chatten. For at afslutte korrekt skal du trykke annuller og derefter Log af i chatvinduet.";
                  }
                  
                  function removeCloseEvent() {
                  	window.onbeforeunload = null;
                  }
                  
                  function UpdateChat()
                  {
                  	// Append new script elm
                  	oNewScript = document.createElement("script");
                  	oNewScript.src = 'client_check_new.php?date=' + new Date();
                  	oNewScript.id = "chatscript_" + iCurrentScriptID++;
                  	oCurrentScript = oNewScript;
                  	document.getElementById("ScriptContainer").appendChild( oNewScript );
                  	//updateImage();
                  	/*var c = document.getElementById("agentContainer");
                  	if (c.style.display != "block") {
                  		c.style.display = "block";
                  	}*/
                  }
                  
                  function doIt(){
                  	t = document.getElementById('ChatContent');
                  	t.scrollTop = t.scrollHeight;
                  }
                  
                  function updateImage()
                  {
                  	var d = new Date();
                  	var t = d.getTime();
                  	var ai = document.getElementById('agentImage');
                  	ai.src = 'agentimage.php?date=' + t;
                  }
                  
               	  function logOut()
               	  {
               	  	window.location = 'client.php?action=logout';
               	  }
               	  
                  setInterval( updateImage, 5000 );
                  setInterval( UpdateChat, 2000 );
                  setInterval( doIt, 1000 );
                  </script>
                  
                
                <?
                }else{
                  genClientLog("Init chat");
                  unset($_SESSION['clientCode']);
                  unset($_SESSION['linkCode']);
                  unset($_SESSION['session_id']);
                  unset($_SESSION['name']);
                  genClientLog("Init chat New session");
                
                ?>
                
                
                  <form name="newchat" action="<?=$PHP_SELF ?>" method="post">
                  <div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; overflow:auto; position:relative; float:none; top:5px; left:15px; padding:5px 15px 5px 15px;">
                  <b>Velkommen:)</b>
                  <br>
                  <br>
                  Online Cyberskole-chatten i Cyberhus er sikker chat.
                  <br>
                  Så snart du er logget ind bliver chatten spærret, og der kan ikke komme andre ind. Du kan anonymt og i fortrolighed chatte med os.
                  <br>
                  <br>
                  Vi har tavshedspligt - Du behøver ikke at opgive navn og adresse.
                  <br>
                  <br>
                  Log på og hils på os...
                  <br>
                  <br>
                  
                  <b>Navn/alias:</b><br>
                  &nbsp;&nbsp;&nbsp;
                  <input type="text" value="Anonym" name="guest_navn"> 
                  <input type="submit" value="Log på" name="startchat">
                  <input type="hidden" name="action" value="openchat">
                  </div>
                  </form>
                
                <?
                }
    			}
                ?>
    			
    			
    			<!-- 
    			
    			This is the main window where we are gonna show the messages from the user and agent.
    			We will also show informations in here
    			
    			 -->
                 
                  </div>
    		</div>
    	</div>
    	
		<div id="schoolagentborder">
			<div id="agentContainer">
				<img src="http://www.cyberhus.dk/sites/default/files/cyberhusdk/billeder/rum_diverse/om_cyberhus/tastatur.jpg" alt="Et tastatur og to hænder" id="agentImage" />
				<?php
				/* Rådgiverne vil ikke kigges på inden brugeren logger på for alvor...*/
				/* <img src="agentimage.php" alt="" id="agentImage" />*/

				?>
				<!-- <script language="javascript">
            	if (AC_FL_RunContent == 0) {
            		alert("This page requires AC_RunActiveContent.js.");
            	} else {
            		AC_FL_RunContent(
            			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
            			'width', '160',
            			'height', '120',
            			'src', 'driver',
            			'quality', 'high',
            			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
            			'align', 'middle',
            			'play', 'true',
            			'loop', 'true',
            			'scale', 'showall',
            			'wmode', 'window',
            			'devicefont', 'false',
            			'id', 'driver',
            			'bgcolor', '#ffffff',
            			'name', 'driver',
            			'menu', 'true',
            			'allowFullScreen', 'false',
            			'allowScriptAccess','sameDomain',
            			'movie', 'driver',
            			'salign', ''
            			); //end AC code
            	}
            </script>
            <noscript>
            	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="160" height="120" id="driver" align="middle">
            	<param name="allowScriptAccess" value="sameDomain" />
            	<param name="allowFullScreen" value="false" />
            	<param name="movie" value="driver.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="driver.swf" quality="high" bgcolor="#ffffff" width="160" height="120" name="driver" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            	</object>
            </noscript> -->
            
			</div>
		</div>
		
		<div id="textfieldborder">
    		<div id="textfield">
    		<?
    		if (!$died && ($_SESSION['linkCode']!="" && $_SESSION['clientCode']!="") )  {
    		?>
    			<iframe frameborder="0" src="client_submit.php" id="textIframe" name="chat_submit" allowtransparency="yes"></iframe>
    		<?
    		}
    		?>
    		</div>
		</div>
		
    	<div id="clockborder">
    		<div id="clockContainer">
    			<div id="clock">&nbsp;</div>
    		</div>
    	</div>
	</div>
</div>

<script>
function getTime() {
  var clockTarget = document.getElementById('clock');
  var now = new Date();
  var h = now.getHours();
  var i = (now.getMinutes()<10) ? "0" + now.getMinutes() : now.getMinutes() ;
  var s = (now.getSeconds()<10) ? "0" + now.getSeconds() : now.getSeconds() ;
  
  if (clockTarget) clockTarget.innerHTML = h + ":" + i + ":" + s;
}

setInterval( getTime,100);
</script>

</body>
</html>
