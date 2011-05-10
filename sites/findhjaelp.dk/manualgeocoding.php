<html>
<head>
<title>R&aring;dgivningssteder - tilf&oslash;j geokoordinater manuelt</title>
<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen">
<script src="findhjaelp.js" language="JavaScript" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<body>

<div id="container_frame">
<?php


/*function manualGeoCoding($navn, $adresse, $lat_old, $lng_old, $kategori, $beskrivelse) {
	echo "";
	
	
	}
	*/
	    $navn = $_POST['navn'];
		$navn = trim($navn);
		$navn = htmlspecialchars($navn);
        $adresse = $_POST['adresse'];
		$adresse = trim($adresse);
        $kategori = $_POST['kategori'];
		$aabningstider = $_POST['aabningstider'];
		$maalgruppe = $_POST['maalgruppe'];
		$beskrivelse = $_POST['beskrivelse'];
		$telefon = $_POST['telefon'];
		$website = $_POST['website'];
		$email_raadgivning = $_POST['email_raadgivning'];
		$email_raadgivning = trim($email_raadgivning);
		$email_opdatering= $_POST['email_opdatering'];
		$email_opdatering = trim($email_opdatering);
		?>

	<p><strong>Splitte min bramsejl! Der er sket en fejl i den automatiske geokodning af adressen.</strong></p>
	<p> Men fortvivl ej. Hvis du kan finde frem til de rette koordinater, kan du indtaste dem i felterne herunder.</p>
	<p><strong>Fremgangsm&aring;de for at finde frem til koordinater:</strong><br>
	  1. 
    Tjek r&aring;dgivningsstedets adresse via krak.dk. Hvis den pr&aelig;cise adresse ikke kan findes, s&aring; ring da evt. til stedet, og f&aring; dem til at forklare, hvor det ligger. Du kan f&oslash;lge med p&aring; <a href="http://findvej.dk" target="_blank">findvej.dk</a>. </p>
	<p>2. &Aring;bn <a href="http://findvej.dk" target="_blank">findvej.dk</a>. Tast adressen fra krak ind her - eller placer evt. en mark&oslash;r efter anvisninger pr telefon. </p>
	<p>3. . I det lille popupvindue, vil du nu kunne afl&aelig;se de aktuelle koordinater. </p>
	<p><img src="http://ny.cyberhus.dk/images/findhjaelp/findvej_dk.jpg" alt="findvej.dk" width="287" height="244"></p>
	<form method="POST" action="tilfoej_marker.php" onSubmit="return checkform_manuelt(this);">
<input type="hidden" name="automatic_geocoding" value="false">
<input type="hidden" name="action_marker" value="tilfoej_manuelt">
<table>          

  <tr>

    <td width="27%">R&aring;dgivningssted:</td>

    <td width="73%"><input type="text" name="navn" size="80" value="<? echo $navn; ?>"></td>
  </tr>

  <tr>

    <td width="27%">Adresse</td>

    <td width="73%"><input type="text" name="adresse" size="80" value="<? echo $adresse; ?>"></td>
  </tr>
  
    <tr>

    <td width="27%">Breddegrader (N)</td>

    <td width="73%"><input type="text" name="lat" size="20"></td>
  </tr>
  
    <tr>

    <td width="27%">L&aelig;ngdegrader (&Oslash;)</td>

    <td width="73%"><input type="text" name="lng" size="20"></td>
  </tr>

  <tr>

    <td width="27%">Kategori</td>

    <td width="73%"><input type="text" name="kategori" size="30" value="<? echo $kategori ?>"></td>
  </tr>

  <tr>
    <td>&Aring;bningstider</td>
    <td><textarea name="aabningstider" cols="30"><? echo $aabningstider ?></textarea></td>
  </tr>
  <tr>
    <td>M&aring;lgruppe</td>
    <td><textarea name="maalgruppe" cols="30"><? echo $maalgruppe ?></textarea></td>
  </tr>
  <tr>

    <td width="27%">Beskrivelse</td>

    <td width="73%"><textarea name="beskrivelse" rows="10" cols="30"><? echo $beskrivelse ?></textarea></td>
  </tr>

  <tr>
    <td>Telefon</td>
    <td><input name="telefon" type="text" value="<? echo $telefon ?>" size="40"></td>
  </tr>
  <tr>

    <td width="27%">Website</td>

    <td width="73%"><input name="website" type="text" value="<? echo $website ?>" size="40"></td>
  </tr>
  
  <tr>

    <td width="27%">Email r&aring;dgivning </td>

    <td width="73%"><input name="email_raadgivning" type="text" value="<? echo $email_raadgivning ?>" size="40"></td>
  </tr>
  <tr>
    <td>Email kontaktperson </td>
    <td><input name="email_opdatering" type="text" value="<? echo $email_opdatering ?>" size="40"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit" name="B1"></td>
  </tr>
</table>

  <p align="center">&nbsp;</p>

</form>
</div>
</body>

</html>