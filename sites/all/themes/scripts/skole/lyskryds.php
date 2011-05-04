<?
require("chatconf.inc");
	// Unders?ge om chatten er ?ben
	$setting_filename = "settings/chat_open_or_not.txt";
	$settings["chat_open"] = 0;
	$settings["chat_open"] = file_get_contents($setting_filename);
	
	if ($settings["chat_open"] == 0) {
		
		// Chatten er lukket
		$light="red.png";
		$link2chat .= "<a href='http://www.cyberhus.dk/node/2648' title='Chat om netsikkerhed mandag til fredag mellem kl. 10 og 12.'>";
		
	} else {
		
		// Chatten er ?ben
		require_once("chatconf.inc");
		$sql=mysql_query("select * from sessions where status='ready' AND testSession=0");
		$ready=mysql_num_rows($sql);
	
		mysql_close();
	
		if($ready > 0) {
			$light="green.png";
			$link2chat .= "<a title='Chatten er åben!' href=";
			$link2chat .= "javascript:";
			//$link2chat .= "popitup('/client.php?new_session=1')>";
			$link2chat .= "open_window('cyberhuschatwindow','http://onlinecyberskole.cyberhus.dk/client.php?new_session=1',720,510)> ";
		} else {
			$light="yellow.png";
			$link2chat .= "<a title='Chat om netsikkerhed mandag til fredag mellem kl. 10 og 12.' href=";
			$link2chat .= "javascript:";
			$link2chat .= "open_window('yellow',";
			$link2chat .= "'/yellow.php',";
			$link2chat .=  "250,75)>";
		}
		
	}

	$lyskryds_html = $link2chat."<img src='http://www.cyberhus.dk/sites/default/files/chatgrafik/skole/$light' style='border:none;'></a>";
	$chatlogo_html = $link2chat."<img src='/img/chatlogo.gif' style='border:none;'></a>";

	$result = 'skoleSwitchColorTo("'.$lyskryds_html.'");';
//	$result .= 'document.getElementById("lightContentLogo").innerHTML = "'.$chatlogo_html.'";';


	
	echo $result;

?>