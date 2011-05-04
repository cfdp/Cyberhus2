<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Findhjælp.dk - tilmeld et rådgivningssted</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="dropdown.js"></script>
</head>
<body bgcolor="#FFFFFF" leftmargin="10" topmargin="10" rightmargin="0" bottommargin="0">
<?php
if ($_POST['send']) {
    $navn = $_POST['navn'];
	$navn = utf8_decode($_POST['navn']);
	$adresse = $_POST['adresse'];
	$kategori = $_POST['kategori'];
	$aabningstider = $_POST['aabningstider'];
	$aabningstider = utf8_decode($_POST['aabningstider']);
	$maalgruppe = $_POST['maalgruppe'];
	$maalgruppe = utf8_decode($_POST['maalgruppe']);
	$beskrivelse = $_POST['beskrivelse'];
	$beskrivelse = utf8_decode($_POST['beskrivelse']);
	$telefon = $_POST['telefon'];
	$website = $_POST['website'];
	$email = $_POST['email'];
	$email = utf8_decode($_POST['email']);
	$email_kontaktperson = $_POST['email_kontaktperson'];
	$email_kontaktperson = utf8_decode($_POST['email_kontaktperson']);
	$mailtil = "benjamin@cyberhus.dk";
    $mailfra = "$email";

	mail ($mailtil,"Forslag fra findhjaelp.dk","Navn: $navn\n Adresse; $adresse\n Kategori: $kategori\n Aabningstider: $aabningstider \n Maalgruppe: $maalgruppe \n Beskrivelse: $beskrivelse\n Telefon: $telefon \n Website: $website\n Email: $email \n Email kontaktperson: $email_kontaktperson","From: $mailfra");
	echo "<div id=\"container_frame\"><p>Dit forslag er sendt til webredaktøren, tak for dit bidrag til findhjælp.dk</p></div>";
            
}
?>
<input type="hidden" name="test" value="juhuu">
<?php tilfoej_marker.php ?>
<!--<META HTTP-EQUIV='Refresh' CONTENT='0;URL=http://ny.cyberhus.dk/site/21064.htm'>--> 
</body>
</html>

