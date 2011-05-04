<?
	//rettet af benjamin christensen d. 14/8/09 - stier til yellow.php og red.php gendannet for at fixe clicklog
	//rettet af benjamin christensen d. 6/2/09 - stier lavet om til formen www.cyberhus.dk/* i et forsøg på at fixe ie-problem (skiltet vises ikke)
	// Unders?ge om chatten er ?ben
	$setting_filename = "settings/chat_open_or_not.txt";
	$settings["chat_open"] = 0;
	$settings["chat_open"] = file_get_contents($setting_filename);
	
	if ($settings["chat_open"] == 0) {
		
		// Chatten er lukket
		$light="red.png";
		$link2chat .= "<a href='http://chat.cyberhus.dk/red.php' title='I chatrådgivningen kan du kl. 15-19, hver mandag-torsdag, finde en voksen der gerne vil lytte.'>";
		
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
			$link2chat .= "open_window('cyberhuschatwindow','http://chat.cyberhus.dk/client.php?new_session=1',500,510)>";
		} else {
			$light="yellow.png";
			$link2chat .= "<a title='I chatrådgivningen kan du kl. 15-19, hver mandag-torsdag, finde en voksen der gerne vil lytte.' href=";
			$link2chat .= "javascript:";
			$link2chat .= "open_window('yellow',";
			$link2chat .= "'http://chat.cyberhus.dk/yellow.php',";
			$link2chat .=  "250,75)>";
		}
		
	}

	$lyskryds_html = $link2chat."<img src='http://www.cyberhus.dk/sites/default/files/chatgrafik/$light' style='border:none;'></a>";
	$chatlogo_html = $link2chat."<img src='/img/chatlogo.gif' style='border:none;'></a>";

	$result = 'switchColorTo("'.$lyskryds_html.'");';
//	$result .= 'document.getElementById("lightContentLogo").innerHTML = "'.$chatlogo_html.'";';


	
	echo $result;

?>