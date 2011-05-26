<?php
	$setting_filename = "http://chat.cybhus.dk/settings/chat_open_or_not.txt";
	$settings["chat_open"] = 0;
	$settings["chat_open"] = file_get_contents($setting_filename);
	
	if ($settings["chat_open"] == 0){
		//Chat is closed (red)
		$status = "Chatr&#229;dgivningen LUKKET";
		//$tab_link = "<a href='http://chat.cyberhus.dk/red.php' title='I chatr&#229;dgivningen kan du kl. 14-19, hver mandag-torsdag, finde en voksen der gerne vil lytte.'>Log p&#229;</a>";
		$tab_link = "http://chat.cyberhus.dk/red.php";
		$state = 'red';
		$data = array('status'=>$status,'link'=>$tab_link,'state'=>$state);
	}else{ 
		/*
		require_once("chatconf.inc");
		
		$sql=mysql_query("select * from sessions where status='ready' AND testSession=0");
		$ready=mysql_num_rows($sql);
		mysql_close();
		*/
		//
		$conn = new mysqli('localhost', 'airbender', 'pinkypuck', 'chat') or die('Could not connec to DB.');
		$query = "SELECT id FROM sessions WHERE status = 'ready' AND testSession = 0";
		if($statement = $conn->prepare($query)){
			$statement->execute();
			$statement->fetch();
			$rows_affected = $statement->affected_rows;
			$statement->close();
		}else{
			return false;
		}
		//
		if($rows_affected > 0){
			//Chat is open (green)
			$status = "Chatr&#229;dgivningen ÅBEN";
			//$tab_link = "<a href=\"http://chat.cyberhus.dk/client.php?new_session=1\" title=\"Cyberhus - Chatr&#229;dgivningen &#197;BEN\">Log p&#229;</a>";
			$tab_link = "http://chat.cyberhus.dk/client.php?new_session=1";
			$state = 'green';
			$data = array('status'=>$status,'link'=>$tab_link,'state'=>$state);
		}else{
			//Chat is busy (yellow)
			$status = "Chatr&#229;dgivningen OPTAGET";
			//$tab_link = "<a href=\"http://chat.cyberhus.dk/yellow.php\" title=\"I chatr&#229;dgivningen kan du kl. 14-19, hver mandag-torsdag, finde en voksen der gerne vil lytte.\">Log p&#229;</a>";
			$tab_link = "http://chat.cyberhus.dk/yellow.php";
			$state = 'yellow';
			$data = array('status'=>$status,'link'=>$tab_link,'state'=>$state);
		}
	}
	echo json_encode($data);
?>
