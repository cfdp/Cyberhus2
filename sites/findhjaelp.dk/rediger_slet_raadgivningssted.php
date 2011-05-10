<html>
<head>
<title>Rediger eller slet r&aring;dgivningssted</title>

<script src="findhjaelp.js" language="JavaScript" type="text/javascript"></script>

<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<body>
<div id="container_frame">
<form name="rediger_slet" method="POST" action="rediger_raadgivningssteder.php" onSubmit="return checkform(this);">

<input type="hidden" name="rediger_marker" value="true">
<input type="hidden" name="tilfoej_marker" value="true">
<input type="hidden" name="automatic_geocoding" value="true">
<input type="hidden" name="xmlfileName" value="SAVE">

<table class="form_table" cellspacing="0">
  <tr>
    <td colspan="2" valign="top" class="form_table_header">Rediger eller slet r&aring;dgivningssted</td>
  </tr>
  <tr>
    <td>
        <select onChange="encodeSpecChar(this.value)" >
          <option value="">V&aelig;lg r&aring;dgivningssted</option>
          <?php
		$raadgivning_valgt = $_GET['raadgivning'];
		//noget tyder på at der sker en dekodning af f.eks. encodede '"'-tegn i GET-proceduren - derfor encodes de igen
		$raadgivning_valgt = htmlspecialchars($raadgivning_valgt);
		echo "R&aring;dgivningssted valgt: ". $raadgivning_valgt;
		include("xml_parser.php");
		//MarkerArray() returnerer rådgivningsdatadata fra xml-filen
		$markers = MarkerArray();
		for($i=0;$i<count($markers);$i++) {
 			echo "<option value=\"" . $markers[$i]->navn ."\">" .  $markers[$i]->navn . "</option>";
		}
		?>
          </select>
		  
		        </td>
    </tr>
</table>

  <div align="left">


</form>
<?php 
	if ($raadgivning_valgt != "") {
		$match_navn = false;
		echo "R&aring;dgivningssted valgt: ". $raadgivning_valgt;
		//arrayet af ådgivningssteder løbes igennem indtil det valgte sted er fundet - bør optimeres!
		for($i=0;$i<count($markers);$i++) {
 			if ($markers[$i]->navn == $raadgivning_valgt) {
				$match_navn = true;
				$raadgivning_data = $markers[$i];
				//echo "det valgte steds data: ";
				//	print_r($raadgivning_data);
				//print_r($raadgivning_data);
				echo "<form method=\"POST\" onSubmit=\"return checkform(this);\">";
				echo "<input type=\"hidden\" name=\"action_marker\" value=\"rediger\">";
				echo "<input type=\"hidden\" name=\"gammelt_navn\" value=\"" . $raadgivning_data->navn ."\">";
				echo "<input type=\"hidden\" name=\"lat\" value=\"" . $raadgivning_data->lat ."\">";
				echo "<input type=\"hidden\" name=\"lng\" value=\"" . $raadgivning_data->lng ."\">";
				echo "<input type=\"hidden\" name=\"automatic_geocoding\" value=\"true\">";
				echo "<input type=\"hidden\" name=\"xmlfileName\" value=\"SAVE\">";
				echo "<table class=\"form_table\" cellspacing=\"0\"><tr>";
				echo "<td width=\"22%\" valign=\"top\">R&aring;dgivningssted:</td>";
				echo "<td width=\"78%\" valign=\"top\"><input type=\"text\" name=\"navn\" size=\"80\" value=\"" .$raadgivning_data->navn . "\"></td>";
				echo "</tr><tr>";
				echo "<td width=\"22%\" valign=\"top\">Adresse</td>";
				echo "<td width=\"78%\" valign=\"top\">";
				echo "<input type=\"text\" name=\"adresse\" size=\"80\" value=\"" .$raadgivning_data->adresse . "\"><br>";
				echo "F.eks.: <i>Sj&aelig;llandsgade 4 8600 Silkeborg Danmark</i><br>";
				echo "Der skal ikke kommaer el. lign. med. R&aelig;kkef&oslash;lgen af input er vigtig. </td></tr>";
				echo "<tr><td width=\"22%\" valign=\"top\">Kategori</td>";
				echo "<td width=\"78%\" valign=\"top\">";
						echo "<select name=\"kategori\">";
						$al_select = "";
						$aa_select = "";
						$kr_select = "";
						$se_select = "";
						$as_select = "";
						$ds_select = "";
						$ir_select = "";
						$va_select = "";
						switch ($raadgivning_data->kategori) {
							case "alt_lukket":
								$al_select = " selected=\"selected\"" ;
								break;
							case "aaben_anonym":
								$aa_select = " selected=\"selected\"" ;
								break;
							case "krop":
								$kr_select = " selected=\"selected\"" ;
								break;
							case "sex":
								$se_select = " selected=\"selected\"" ;
								break;
							case "alkohol_stoffer":
								$as_select = " selected=\"selected\"" ;
								break;
							case "doed_syg":
								$ds_select = " selected=\"selected\"" ;
								break;
							case "ikke_rart":
								$ir_select = " selected=\"selected\"" ;
								break;
							case "vaeresteder":
								$va_select = " selected=\"selected\"" ;
								break;
						}
						  echo "<option value=\"alt_lukket\"" . $al_select . ">Alt lukket</option>";
						  echo "<option value=\"aaben_anonym\"" . $aa_select . ">&Aring;ben, anonym r&aring;dgivning</option>";
						  echo "<option value=\"krop\"" . $kr_select . ">Jeg har sp&oslash;rgsm&aring;l om min krop</option>";
						  echo "<option value=\"sex\"" . $se_select . ">Jeg har sp&oslash;rgsm&aring;l om sex</option>";
						  echo "<option value=\"alkohol_stoffer\"" . $as_select . ">For meget alkohol og stoffer</option>";
						  echo "<option value=\"doed_syg\"" . $ds_select . ">D&oslash;d, alvorlig sygdom</option>";
						  echo "<option value=\"ikke_rart\"" . $ir_select . ">Nogen har gjort noget...</option>";
						  echo "<option value=\"vaeresteder\"" . $va_select . ">Leder efter andre unge...</option>";
						  echo "</select>";
				echo "</p></td></tr>";
				
				echo "<tr><td width=\"22%\" valign=\"top\">&Aring;bningstider:</td>";
				echo "<td width=\"78%\" valign=\"top\"><textarea name=\"aabningstider\" rows=\"3\" cols=\"30\" value=\"aabningstider\">" .$raadgivning_data->aabningstider . "</textarea></td>";
				echo "</tr>";
				echo "<tr><td width=\"22%\" valign=\"top\">M&aring;lgruppe:</td>";
				echo "<td width=\"78%\" valign=\"top\"><textarea name=\"maalgruppe\" rows=\"3\" cols=\"30\" value=\"maalgruppe\">" .$raadgivning_data->maalgruppe . "</textarea></td>";
				echo "</tr><tr><td width=\"22%\" valign=\"top\">Beskrivelse</td>";
				echo "<td width=\"78%\" valign=\"top\"><textarea name=\"beskrivelse\" rows=\"10\" cols=\"30\" value=\"beskrivelse\">".$raadgivning_data->beskrivelse ."</textarea></td>";
				echo "</tr>";
				echo "<tr><td width=\"22%\" valign=\"top\">Telefon:</td>";
				echo "<td width=\"78%\" valign=\"top\"><input type=\"text\" name=\"telefon\" size=\"50\" value=\"" .$raadgivning_data->telefon . "\"></td>";
				echo "</tr><tr><td width=\"22%\" valign=\"top\">Website</td>";
				echo "<td width=\"78%\" valign=\"top\"><input type=\"text\" name=\"website\" size=\"50\" value=\"" .$raadgivning_data->website. "\"></td>";
				echo "</tr>";
				echo "<tr><td width=\"22%\" valign=\"top\">Evt. r&aring;dgivningsemail: </td>";
				echo "<td width=\"78%\" valign=\"top\"><input type=\"text\" name=\"email_raadgivning\" size=\"50\" value=\"" .$raadgivning_data->email_raadgivning. "\"></td>";
				echo "</tr>";
				echo "<tr><td width=\"22%\" valign=\"top\">Kontaktperson email: </td>";
				echo "<td width=\"78%\" valign=\"top\"><input type=\"text\" name=\"email_opdatering\" size=\"50\" value=\"" .$raadgivning_data->email_opdatering. "\"></td>";
				echo "</tr>";
				echo "<tr valign=\"top\">";
				echo "<td></td><td>  <div align=\"left\">";		
				echo "<input type=\"submit\" onClick=\"document.pressed='Gem'\" value=\"Gem &aelig;ndringer\" name=\"gem\"><input type=\"submit\" onClick=\"document.pressed='Slet'\" value=\"Slet r&aring;dgivningssted\" name=\"slet\">";
				echo "</div></td></tr></table></form>";
			} 
		}
		if ($match_navn == false) {
			//der er sket kritisk fejl - det valgte element kunne ikke findes
			echo "<p>Oev, systemfejl: Det valgte element kunne ikke findes i listen. Sikkert noget med mellemrum foer eller efter navnet eller specialtegn, der forvirrer systemet... </p>";
		}
	}
?>

</div>

</body>

</html>