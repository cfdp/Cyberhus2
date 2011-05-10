<?php
	include("header_findhjaelp.php");
	include("xml_parser.php");
    include("skrivxmlfilnavn.php");

    //echo "tilfoej_marker.php kaldt<br>";  
	//xml-filnavnet skal være nyt for hver gang for at undgå cache-problemer 
	$xmlfileName = $_POST['xmlfileName'] . rand() . ".xml"; 
	$data_object = array();
	//inputtet trimmes for uønskede tegn
	$navn = $_POST['navn'];
	$navn = trim($navn);
	//navn encodes for at f.eks. anførselstegn ikke skal forvirre htmlen senere...
	$navn = htmlspecialchars($navn);
	$gammelt_navn ="";
	$gammelt_navn = $_POST['gammelt_navn'];
	$gammelt_navn = trim($gammelt_navn);
	$gammelt_navn = htmlspecialchars($gammelt_navn);
	$adresse = $_POST['adresse'];
	$adresse = trim($adresse);
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$kategori = $_POST['kategori'];
	$aabningstider = $_POST['aabningstider'];	
	//$aabningstider = trim($aabningstider);
	$aabningstider = nl2br($aabningstider);
	$maalgruppe = $_POST['maalgruppe'];	
	//$maalgruppe = trim($maalgruppe);
	$maalgruppe = nl2br($maalgruppe);
	$beskrivelse = $_POST['beskrivelse'];
	$beskrivelse = nl2br($beskrivelse);
	$telefon= $_POST['telefon'];	
	$website = $_POST['website'];	
	$website = trim($website);
	//website tjekkes for det rette format - der skal tilføjes http hvis det mangler
	if ((substr($website,0,7) != "http://") && ($website != "")) {
		$website = "http://".$website;
	}
	$email_raadgivning = $_POST['email_raadgivning'];
	$email_raadgivning = trim($email_raadgivning);
	$email_opdatering = $_POST['email_opdatering'];
	$email_opdatering = trim($email_opdatering);
	$action_marker = $_POST['action_marker'];
	//samlende dataobjekt
	
	$data_raadgivning = array("xmlfilename"=>$xmlfileName,"navn"=>$navn,"adresse"=>$adresse,"lat"=>$lat,"lng"=>$lng,"kategori"=>$kategori,"aabningstider"=>$aabningstider,"maalgruppe"=>$maalgruppe,"beskrivelse"=>$beskrivelse,"telefon"=>$telefon,"website"=>$website,"email_raadgivning"=>$email_raadgivning,"email_opdatering"=>$email_opdatering,"gammelt_navn"=>$gammelt_navn,"action_marker"=>$action_marker);
	//echo "foelgende data er samlet op i tilfoej marker";
	//print_r($data_raadgivning);
	//Her afgøres hvad der skal gøres ud fra variablen action_marker
	if($_GET['action_marker'] == "slet"){
		//en marker skal slettes
		$action_marker = "slet";
	}
	//handlingen afgøres af action marker variablen. Hvis der redigeres: der skal kun geokodes automatisk hvis der er ændret i adressen
	if (($action_marker != "slet") && ($action_marker != "rediger")) {
		if ($_POST['automatic_geocoding'] == "true") {
			//echo "<p>R&aring;dgivningssted fors&oslash;ges geokodet automatisk...</p>";
			$adresse_geokodet = geocode_adresse($data_raadgivning["adresse"]);
			$status_kode = $adresse_geokodet[0];
			//echo "statuskoden er " . $status_kode . "</br></br>";
			//hvis statuskode = 200 lykkedes geokodningen -
			if($status_kode == 200) {
				$lat = $adresse_geokodet[2];
				$lng = $adresse_geokodet[3];
				$data_raadgivning["lat"] = $lat;
				$data_raadgivning["lng"] = $lng;
				
				//der udsendes mail til admins
				$modtagere = "benjamin@cyberhus.dk,nc@cyberhus.dk";
				$emne = "Raadgivningssted tilfoejet";
				
				$navn = utf8_decode($navn);
				$adresse = utf8_decode($adresse);
				$kategori= utf8_decode($kategori);
				$aabningstider = utf8_decode($aabningstider);
				$maalgruppe = utf8_decode($maalgruppe);
				$beskrivelse = utf8_decode($beskrivelse);
				$telefon = utf8_decode($telefon);
				$website = utf8_decode($website);
				$email_raadgivning = utf8_decode($email_raadgivning);
				$email_opdatering  = utf8_decode($email_opdatering);
				
				$afsender = "From: $email_opdatering";
				$mail_indhold = "Navn: $navn\n Adresse; $adresse\n Kategori: $kategori\n Aabningstider: $aabningstider \n Maalgruppe: $maalgruppe \n Beskrivelse: $beskrivelse\n Telefon: $telefon \n Website: $website\n Email raadgivning: $email_raadgivning\n Email opdatering: $email_opdatering \n ";
				$web_besked_succes = "";
				$web_besked_fejl = "";
				sendMail($modtagere,$emne, $afsender,$mail_indhold,$web_besked_succes, $web_besked_fejl);
				//echo "<p>Adressen er geokodet automatisk.</p>";
				//skal der redigeres eller tilføjes ny marker?
			} else {
				//hvis statuskode != 200 skal koordinaterne indkodes manuelt
				//hvis det er udefrakommende der tilføjer, skal de ikke selv rode med det, så må redaktører gøre det...
				if ($action_marker != "tilfoej_ekstern") {
					$action_marker = "Venter p&aring; manuelt input";
					include("manualgeocoding.php");
				} else {
					echo "<p>Adressen kunne ikke geokodes automatisk. Der er sendt en mail med de indtastede data til webredakt&oslash;ren, som vil tage sig af sagen. <p>";
					$action_marker = "Venter paa manuelt input, ekstern";
					//der skal sendes en mail, hvis det er en ekstern der tilføjer et rådgivningssted, og det ikke kan geokodes.
					$modtagere = "benjamin@cyberhus.dk,nc@cyberhus.dk";
					$emne = "Forslag fra findhjaelp.dk til geokodning";

					
					$navn = utf8_decode($navn);
					$adresse = utf8_decode($adresse);
					$kategori= utf8_decode($kategori);
					$aabningstider = utf8_decode($aabningstider);
					$maalgruppe = utf8_decode($maalgruppe);
					$beskrivelse = utf8_decode($beskrivelse);
					$telefon = utf8_decode($telefon);
					$website = utf8_decode($website);
					$email_raadgivning = utf8_decode($email_raadgivning);
					$email_opdatering  = utf8_decode($email_opdatering);
					
					$afsender = "From: $email_opdatering";
					$mail_indhold = "Navn: $navn\n Adresse; $adresse\n Kategori: $kategori\n Aabningstider: $aabningstider \n Maalgruppe: $maalgruppe \n Beskrivelse: $beskrivelse\n Telefon: $telefon \n Website: $website\n Email raadgivning: $email_raadgivning\n Email opdatering: $email_opdatering \n ";
					$web_besked_succes = "<p>Mailafsendelse udf&oslash;rt tilfredsstillende, tak for din medvirken.</p>";
					$web_besked_fejl = "Der er sket en fejl - mail ikke afsendt. Vi beklager meget. Kontakt os evt. p&aring; telefon 86370400";
					sendMail($modtagere,$emne, $afsender,$mail_indhold,$web_besked_succes, $web_besked_fejl);
				}
				
			}
		}
	}
	
	
	if (($action_marker == "rediger") && (navnledigt($navn))) {
		$action = "rediger";
		//echo "vi redigerer...<br>";
		writeToXml($action, $data_raadgivning);
	}
	else if (($action_marker == "tilfoej") && (navnledigt($navn))) {
		$action = "tilfoej";
		//echo "vi tilfoejer...<br>";
		writeToXml($action, $data_raadgivning);
	}
	else if (($action_marker == "tilfoej_ekstern") && (navnledigt($navn))) {
		$action = "tilfoej_ekstern";
		writeToXml($action, $data_raadgivning);
	}
	//tilfoej_manuelt er kun sat når der er input fra formen i manualgeocoding
	else if (($action_marker == "tilfoej_manuelt") && (navnledigt($navn))) {
			echo "<p>R&aring;dgivningssted tilf&slash;jes geokoordinater manuelt.</p>";
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$data_raadgivning["lat"] = $lat;
			$data_raadgivning["lng"] = $lng;
			$action = "tilfoej";
			writeToXml($action, $data_raadgivning);
	}
	else if ($action_marker == "slet") {		
			$action = "slet";
			writeToXml($action, $data_raadgivning);
	}

	/*writeToXml skriver data til xml-filen, kalder de rette funktioner i forhold om der skal redigeres, slettes eller tilfoejes*/
	function writeToXml($action, $data_raadgivning)	{
		/*addMarker i xml_parser.php parser xml og tilføjer de nye data til et array, som den sender med tilbage*/
		$raadg_array = array();
		global $gammelt_navn;
		switch ($action) {
			case "tilfoej":
				$raadg_array = addMarker($data_raadgivning);
				break;
			case "tilfoej_ekstern":
				$raadg_array = addMarker($data_raadgivning);
				break;
			case "rediger":
				$raadg_array = editMarker($data_raadgivning);
				break;
			case "slet":
				$raadg_array = deleteMarker($data_raadgivning["navn"]);
				break;
		}
		$xml_dec = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
		$rootELementStart = "<markers>";
		$rootElementEnd = "</markers>";
		$xml_doc =  $xml_dec;
		$xml_doc .=  $rootELementStart;
		
		/*raadg_array gennemløbes og alle data skrives tilbage i xml-dokumentet (min gamle datalogiunderviser ville flå håret ud af hovedet hvis han så dette...)*/
		for($x=0;$x<count($raadg_array);$x++){
			$xml_doc .=  "<marker>";
			$xml_doc .=  "<navn><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->navn;
			$xml_doc .=  "]]></navn>";
			$xml_doc .=  "<adresse><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->adresse;
			$xml_doc .=  "]]></adresse>";
			$xml_doc .=  "<lat>";
			$xml_doc .=  $raadg_array[$x]->lat;
			$xml_doc .=  "</lat>";
			$xml_doc .=  "<lng>";
			$xml_doc .=  $raadg_array[$x]->lng;
			$xml_doc .=  "</lng>";
			$xml_doc .=  "<kategori>";
			$xml_doc .=  $raadg_array[$x]->kategori;
			$xml_doc .=  "</kategori>";
			$xml_doc .=  "<aabningstider><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->aabningstider;
			$xml_doc .=  "]]></aabningstider>";
			$xml_doc .=  "<maalgruppe><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->maalgruppe;
			$xml_doc .=  "]]></maalgruppe>";
			$xml_doc .=  "<beskrivelse><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->beskrivelse;
			$xml_doc .=  "]]></beskrivelse>";
			$xml_doc .=  "<telefon>";
			$xml_doc .=  $raadg_array[$x]->telefon;
			$xml_doc .=  "</telefon>";
			$xml_doc .=  "<website><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->website;
			$xml_doc .=  "]]></website>";
			$xml_doc .=  "<emailraadgivning><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->email_raadgivning;
			$xml_doc .=  "]]></emailraadgivning>";
			$xml_doc .=  "<emailopdatering><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->email_opdatering;
			$xml_doc .=  "]]></emailopdatering>";
			$xml_doc .=  "<dato><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->dato;
			$xml_doc .=  "]]></dato>";
			$xml_doc .=  "</marker>";
		}
		$xml_doc .=  $rootElementEnd;
		//$xml_doc = xmlIndent($xml_doc); breaksene og whitespace efter mellemrum giver fejl i tolkningen i categories.html, derfor droppes formatteringen lige for en kort? bemærkning
		$default_dir = "xml_files/";

		$default_dir .= $data_raadgivning["xmlfilename"];
		//echo  $default_dir;
		//echo 'Hi!  adresse geocodet er'.$adresse_geocodet;
		//de nye data skrives til en ny xml-fil med tilfældig endelse
		$fp = fopen($default_dir,'w');
		$write = fwrite($fp,$xml_doc);
		//så kaldes writeNewName, således tekstdokumentet xmlfilnavn opdateres med det nye filnavn
		writeNewName($data_raadgivning["xmlfilename"]);
		//tilsidst præsenteres links alt efter hvilken type bruger man er...

		echo "<p>Tak for dit bidrag. <a href='http://www.findhjaelp.dk' target='_top'>Tilbage til forsiden.</a></p>";
		if ($action != "tilfoej_ekstern") {
			echo "<p><a href='http://www.findhjaelp.dk/site/20427.htm' target='_top'>Tilf&oslash;j/rediger et nyt r&aring;dgivningssted. </a></p>";
		}

	}
	  
	function xmlIndent($str){
		$ret = "";
		$indent = 0;
		$indentInc = 3;
		$noIndent = false;
		while(($l = strpos($str,"<",$i))!==false){
			if($l!=$r && $indent>0){ $ret .= "\n" . str_repeat(" ",$indent) . substr($str,$r,($l-$r)); }
			$i = $l+1;
			$r = strpos($str,">",$i)+1;
			$t = substr($str,$l,($r-$l));
			if(strpos($t,"/")==1){
				$indent -= $indentInc;
				$noIndent = true;
			}
			else if(($r-$l-strpos($t,"/"))==2 || substr($t,0,2)=="<?"){ $noIndent = true; }
			if($indent<0){ $indent = 0; }
			if($ret){ $ret .= "\n"; }
			$ret .= str_repeat(" ",$indent);
			$ret .= $t;
			if(!$noIndent){ $indent += $indentInc; }
			$noIndent = false;
			}
		$ret .= "\n";
		return($ret);
	}
		
	function geocode_adresse($adresse) {
		//Set up our variables
		$longitude = "";
		$latitude = "";
		$precision = "";

		//Three parts to the querystring: q is address, output is the format (
		$key = "ABQIAAAAbma0EtBcKlwKZK-W54o2ixRDo8J9-qNMHSYdk0qFyHPGqQcYjBT8IAILDK3y3nDs6h0C2nNN-XkezQ";
		//$adresse = urlencode("sønder allé 33 århus denmark");
		$adresse = urlencode($adresse);
		$url = "http://maps.google.com/maps/geo?q=".$adresse."&output=csv&key=".$key;
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER[‘HTTP_USER_AGENT’]);
		/*nedenstående setting giver problemer med open_basedir restriction - sat forsøgsvis til 0...*/
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		//echo "Data: ". $data." ";
		if (strstr($data,"200"))
		{
			$data = explode(",",$data);
			$status_kode = $data[0];
			$precision = $data[1];
			$latitude = $data[2];
			$longitude = $data[3];
		
			//echo "Latutide: ".$latitude." ";
		
			//echo "Longitude: ".$longitude." ";
		
			} else {
				//adressen kunne ikke geokodes - 				

			}
			return $data;
	}

	
	// check om det valgte navn allerede eksisterer i xmlfilen -
	function navnledigt($navn) {
		global $marker_array;
		global $gammelt_navn;
		$ledigt = true;
		$nb_elements = sizeof($marker_array);
		for($i=0;$i<$nb_elements;$i++) {
			//hvis det handler om en ændring af et eksisterende sted, som beholder sit navn er det self. ok...
			if (($marker_array[$i]->navn == $navn) && ($navn != $gammelt_navn)) {
				echo "<p>Navnet er desv&aelig;rre allerede benyttet. <a href='javascript: history.back(1);'>V&aelig;lg venligst et andet navn til r&aring;dgivningsstedet.</a></p>";
					//navnet findes allerede
					$ledigt = false;
			}
		}
		if ($ledigt == true) {
			//echo "<p>Navnet p&aring; r&aring;dgivningsstedet var ledigt.</p>";
		}
		return($ledigt);
	}
	
	function sendMail($modtagere, $emne, $afsender, $mail_indhold, $web_besked_succes, $web_besked_fejl) {
		if (mail ($modtagere, $emne, $mail_indhold, $afsender)) {
			echo $web_besked_succes;
		}
		else {
			echo $web_besked_fejl;
		}	
	
	}

  ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5830307-1");
pageTracker._trackPageview();
</script>

</div>
</body>
</html>