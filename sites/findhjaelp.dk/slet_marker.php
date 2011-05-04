<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen">
<title>Tilf&oslash;j r&aring;dgivningssted</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>

<body>
<div id="container_frame">
<?php
	include("xml_parser.php");
    include("skrivxmlfilnavn.php");
	//include("manualgeocoding.php");
	  
	if(isset($_POST['tilfoej_marker'])){
        
		//xml-filnavnet skal være nyt for hver gang for at undgå cache-problemer 
        $xmlfileName = $_POST['xmlfileName'] . rand() . ".xml"; 
		//inputtet trimmes for uønskede tegn
        $navn = $_POST['navn'];
		$navn = trim($navn);
        $adresse = $_POST['adresse'];
		$adresse = trim($adresse);
        $kategori = $_POST['kategori'];
		$beskrivelse = $_POST['beskrivelse'];
		$website = $_POST['website'];
		$website = trim($website);
		$email = $_POST['email'];
		$email = trim($email);
		$gammelt_navn = $_POST['gammelt_navn'];
		$gammelt_navn = trim($gammelt_navn);
		
		if($_POST['automatic_geocoding'] == "true"){
			echo "Raadgivningssted forsoeges geokodet automatisk...</br></br>";
			$adresse_geokodet = geocode_adresse($adresse);
			$status_kode = $adresse_geokodet[0];
			echo "statuskoden er " . $status_kode . "</br></br>";
			//hvis statuskode = 200 lykkedes geokodningen -
			if($status_kode == 200) {
				$lat = $adresse_geokodet[2];
				$lng = $adresse_geokodet[3];
				echo "SUCCES!!! SEJR!!!  Adressen er geokodet automatisk.</br></br>";
				//skal der redigeres eller tilføjes ny marker?
				if($_POST['rediger_marker'] == "true"){
					//en marker skal redigeres
					$action = "rediger";
					writeToXml($action, $xmlfileName, $navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
				} else {
					//der skal tilføjes en ny marker
					$action = "tilfoej";
					writeToXml($action, $xmlfileName, $navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
				}
			} else {
				//hvis statuskode != 200 skal koordinaterne indkodes manuelt
				include("manualgeocoding.php");
			}
		}
		//vi skulle gerne ende hernede når vi har været i manualgeocoding.php - automatic_geocoding == false
		else {
			echo "Raadgivningssted tilfoejes manuelle geokoordinater...</br></br>";
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$action = "tilfoej";
			writeToXml($action, $xmlfileName, $navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
		}
	}
	/*writeToXml skriver data til xml-filen, kalder de rette funktioner i forhold om der skal redigeres, slettes eller tilfoejes*/
	function writeToXml($action, $xmlfileName, $navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email)	{
		/*addMarker i xml_parser.php parser xml og tilføjer de nye data til et array, som den sender med tilbage*/
		$raadg_array = array();
		global $gammelt_navn;
		switch ($action) {
			case "tilfoej":
				$raadg_array = addMarker($navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
				break;
			case "rediger":
				$raadg_array = editMarker($gammelt_navn, $navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
				//echo "gammelt navn er..." . $gammelt_navn;
				//echo "<br>nyt navn er.." . $navn;
				break;
			case "slet":
				$raadg_array = deleteMarker($navn, $adresse, $lat, $lng, $kategori, $beskrivelse, $website, $email);
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
			$xml_doc .=  "<beskrivelse><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->beskrivelse;
			$xml_doc .=  "]]></beskrivelse>";
			$xml_doc .=  "<website><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->website;
			$xml_doc .=  "]]></website>";
			$xml_doc .=  "<email><![CDATA[";
			$xml_doc .=  $raadg_array[$x]->email;
			$xml_doc .=  "]]></email>";
			$xml_doc .=  "</marker>";
		}
		$xml_doc .=  $rootElementEnd;
		//$xml_doc = xmlIndent($xml_doc); breaksene og whitespace efter mellemrum giver fejl i tolkningen i categories.html, derfor droppes formatteringen lige for en kort? bemærkning
		$default_dir = "xml_files/";

		$default_dir .= $xmlfileName;
		//echo  $default_dir;
		//echo 'Hi!  adresse geocodet er'.$adresse_geocodet;
		//de nye data skrives til en ny xml-fil med tilfældig endelse
		$fp = fopen($default_dir,'w');
		$write = fwrite($fp,$xml_doc);
		//så kaldes writeNewName, således tekstdokumentet xmlfilnavn opdateres med det nye filnavn
		writeNewName($xmlfileName);
		//tilsidst sendes vi videre til forsiden igen...
		echo "<p>Gå til <a href='http://ny.cyberhus.dk/19371.htm'>forsiden</a> for at se det opdaterede resultat.</p>";

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
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$data = curl_exec($ch);
		curl_close($ch);
		
		echo "Data: ". $data." ";
		if (strstr($data,"200"))
		{
			$data = explode(",",$data);
			$status_kode = $data[0];
			$precision = $data[1];
			$latitude = $data[2];
			$longitude = $data[3];
		
			echo "Latutide: ".$latitude." ";
		
			echo "Longitude: ".$longitude." ";
		
			} else {
				//adressen kunne ikke geokodes - 				

			}
			return $data;
		}
	

  ?>
  </div>
</body>
</html>
