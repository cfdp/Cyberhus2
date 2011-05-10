<?php
/*i dette script er der funktioner til at parse xml-dokument med struktur som "marker.xml" - 
der er ogs� funktionen addMarker der kan tilf�je en ny marker til marker-arrayet og returnerer det udvidede array */

//xml-filen der skal parses - denne skal g� ind og lede efter navnet p� den sidste xmlfil i xmlfilename.txt
$myFile = "xmlfilnavn.txt";
$fh = fopen($myFile, 'r');
$xmlfileName = fread($fh, filesize($myFile));
fclose($fh);

$xml_file = "xml_files/" . $xmlfileName;

$xml_file = cleanxmlfile($xml_file);

$xml_navn_key = "*MARKERS*MARKER*NAVN";
$xml_adresse_key = "*MARKERS*MARKER*ADRESSE";
$xml_lat_key = "*MARKERS*MARKER*LAT";
$xml_lng_key = "*MARKERS*MARKER*LNG";
$xml_kategori_key = "*MARKERS*MARKER*KATEGORI";
$xml_aabningstider_key = "*MARKERS*MARKER*AABNINGSTIDER";
$xml_maalgruppe_key = "*MARKERS*MARKER*MAALGRUPPE";
$xml_beskrivelse_key = "*MARKERS*MARKER*BESKRIVELSE";
$xml_telefon_key = "*MARKERS*MARKER*TELEFON";
$xml_website_key = "*MARKERS*MARKER*WEBSITE";
$xml_emailraadgivning_key = "*MARKERS*MARKER*EMAILRAADGIVNING";
$xml_emailopdatering_key = "*MARKERS*MARKER*EMAILOPDATERING";
$xml_dato_key = "*MARKERS*MARKER*DATO";

$marker_array = array();
$counter = 0;

//hed f�r xml-story...
class xml_marker{
    var $navn;
	var $adresse;
	var $lat; 
	var $lng; 
	var $kategori;
	var $aabningstider;
	var $maalgruppe;
	var $beskrivelse;
	var $telefon;
	var $website;
	var $email_raadgivning;
	var $email_opdatering;
	var $dato;
}
//n�r parseren st�der p� et start tag, tilf�jes det til current-tag sammen med en *
function startTag($parser, $data){
    global $current_tag;
    $current_tag .= "*$data";
}
//her fjernes det aktuelle tag fra currenttag
function endTag($parser, $data){
    global $current_tag;
    $tag_key = strrpos($current_tag, '*');
    $current_tag = substr($current_tag, 0, $tag_key);
}

//her smides indholdet mellem tagsene ind i marker_array med en fortl�bende nummerering
function contents($parser, $data){
    global $current_tag;
	global $xml_navn_key;
	global $xml_adresse_key;
	global $xml_lat_key;
	global $xml_lng_key;
	global $xml_kategori_key;
	global $xml_aabningstider_key;
	global $xml_maalgruppe_key;
	global $xml_beskrivelse_key;
	global $xml_telefon_key;
	global $xml_website_key;
	global $xml_emailraadgivning_key;
	global $xml_emailopdatering_key;
	global $xml_dato_key;
	global $counter;
	global $marker_array;


    switch($current_tag){
        case $xml_navn_key:
         	$marker_array[$counter] = new xml_marker();
           	$marker_array[$counter]->navn = $data;
			break;
		case $xml_adresse_key:
           	$marker_array[$counter]->adresse = $data;
			break;
		case $xml_lat_key:
            $marker_array[$counter]->lat = $data;
		     break;
		case $xml_lng_key:
            $marker_array[$counter]->lng = $data;
            break;
		case $xml_kategori_key:
            $marker_array[$counter]->kategori = $data;
            break;
		case $xml_aabningstider_key:
            $marker_array[$counter]->aabningstider = $data;
            break;
		case $xml_maalgruppe_key:
            $marker_array[$counter]->maalgruppe = $data;
            break;
		case $xml_beskrivelse_key:
            $marker_array[$counter]->beskrivelse = $data;
            break;
		case $xml_telefon_key:
            $marker_array[$counter]->telefon = $data;
            break;
        case $xml_website_key:
           	$marker_array[$counter]->website = $data;
			 break;
		case $xml_emailraadgivning_key:
           	$marker_array[$counter]->email_raadgivning = $data;
			 break;
		case $xml_emailopdatering_key:
           	$marker_array[$counter]->email_opdatering= $data;
			 break;
		 case $xml_dato_key:
			$marker_array[$counter]->dato = $data;
            $counter++;
			break;
    }
}

$xml_parser = xml_parser_create();

xml_set_element_handler($xml_parser, "startTag", "endTag");

xml_set_character_data_handler($xml_parser, "contents");

$fp = fopen($xml_file, "r") or die("Kunne ikke �bne fil...");

$data = fread($fp, filesize($xml_file)) or die("Kunne ikke l�se fil...");

if(!(xml_parse($xml_parser, $data, feof($fp)))){
    die("Fejl p� linje " . xml_get_current_line_number($xml_parser));
}

xml_parser_free($xml_parser);

fclose($fp);

//denne funktion returnerer marker_arrayet
function MarkerArray() {
	global $marker_array;
	return $marker_array;
}

//tilf�jelse af et nyt element til marker_array
//returnerer $marker_array tilf�jet det nye element
function addMarker($data_raadgivning) {
	global $marker_array;
	$dato = date("j.n.Y"); 
	$pointer = sizeof($marker_array);
	//s�rg for at bevare new line elementer
	//$beskrivelse = nl2br($beskrivelse);
	$new_marker = new xml_marker();
	$marker_array[$pointer] = new xml_marker();
	$marker_array[$pointer]->navn = $data_raadgivning["navn"];
	$marker_array[$pointer]->adresse = $data_raadgivning["adresse"];
	$marker_array[$pointer]->lat = $data_raadgivning["lat"];
	$marker_array[$pointer]->lng = $data_raadgivning["lng"];
	$marker_array[$pointer]->kategori = $data_raadgivning["kategori"];
	$marker_array[$pointer]->aabningstider = $data_raadgivning["aabningstider"];
	$marker_array[$pointer]->maalgruppe = $data_raadgivning["maalgruppe"];
	$marker_array[$pointer]->beskrivelse = $data_raadgivning["beskrivelse"];
	$marker_array[$pointer]->telefon = $data_raadgivning["telefon"];
	$marker_array[$pointer]->website = $data_raadgivning["website"];
	$marker_array[$pointer]->email_raadgivning = $data_raadgivning["email_raadgivning"];
	$marker_array[$pointer]->email_opdatering = $data_raadgivning["email_opdatering"];
	$marker_array[$pointer]->dato = $dato;
	//echo "\t<p>Der er tilfoejet et nyt r&aring;dgivningssted.</p>\n";
	sort($marker_array);
	return $marker_array;
}


//redigering af et element i marker_array
//returnerer det opdaterede $marker_array 
function editMarker($data_raadgivning) {
	//echo "vi er inde i editmarker";
	global $marker_array;
	$dato = date("j.n.Y"); 
	$nb_elements = sizeof($marker_array);
	//$data_raadgivning["beskrivelse"] = nl2br($data_raadgivning["beskrivelse"]);
	for($i=0;$i<$nb_elements;$i++) {
		//f�rst skal det aktuelle element findes
		if ($marker_array[$i]->navn == $data_raadgivning["gammelt_navn"]) {
			//echo "vi er inde i editmarker og vi har fundet gammelt_navn";
			$marker_array[$i]->navn = $data_raadgivning["navn"];
			$marker_array[$i]->adresse = $data_raadgivning["adresse"];
			$marker_array[$i]->lat = $data_raadgivning["lat"];
			$marker_array[$i]->lng = $data_raadgivning["lng"];
			$marker_array[$i]->kategori = $data_raadgivning["kategori"];
			$marker_array[$i]->aabningstider = $data_raadgivning["aabningstider"];
			$marker_array[$i]->maalgruppe = $data_raadgivning["maalgruppe"];
			$marker_array[$i]->beskrivelse = $data_raadgivning["beskrivelse"];
			$marker_array[$i]->telefon = $data_raadgivning["telefon"];
			$marker_array[$i]->website = $data_raadgivning["website"];
			$marker_array[$i]->email_raadgivning = $data_raadgivning["email_raadgivning"];
			$marker_array[$i]->email_opdatering = $data_raadgivning["email_opdatering"];
			$marker_array[$i]->dato = $dato;
			//echo "\t<p>&AElig;ndringerne fors&oslash;ges tilf&oslash;jet r&aring;dgivningsstedet...</p>\n";
		}
	}
	//print_r($marker_array);
	sort($marker_array);
	return $marker_array;
}

//sletning af element fra marker_array
//returnerer opdateret $marker_array 
function deleteMarker($navn) {
	global $marker_array;
	$nb_elements = sizeof($marker_array);
	echo "\t<p>R&aring;dgivningsstedet ".$navn." fors&oslash;ges slettet...</p>\n";
	for($i=0;$i<$nb_elements;$i++) {
		if ($marker_array[$i]->navn == $navn) {
				unset($marker_array[$i]);
		}
	}
	$marker_array = array_values($marker_array);
	return $marker_array;
}

//finder alle email-adresser i arrayet og returnerer dem
//returnerer opdateret $marker_array 
function getEmails() {
	global $marker_array;
	$email_array = array();
	$nb_elements = sizeof($marker_array);
	echo "\t<p>Henter emails...</p>\n";
	for($i=0;$i<$nb_elements;$i++) {
		$email_array[$i] = $marker_array[$i]->email_opdatering; 
	}
	return $email_array;
}


// remove whitespace and linefeeds and returns the name of a temporary file
// takes the name of an existing file as a parameter
function cleanxmlfile($file, $tmpdir="tmp/", $prefix="xxx_") {
    $tmp = file_get_contents ($file);
    $tmp = preg_replace("/^\s+/m","",$tmp);
    $tmp = preg_replace("/\s+$/m","",$tmp);
    $tmp = preg_replace("/\r/","",$tmp);
    $tmp = preg_replace("/\n/","",$tmp);
    $tmpfname = tempnam($tmpdir, $prefix);
    $handle = fopen($tmpfname, "w");
    fwrite($handle, "$tmp");
    fclose($handle);
	//echo "\t<p>cleaning xml...</p>";
    return($tmpfname);
}


?>