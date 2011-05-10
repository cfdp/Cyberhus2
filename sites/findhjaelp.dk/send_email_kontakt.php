<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Findhjælp.dk - send en email</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="dropdown.js"></script>
</head>
<body bgcolor="#ffffff" leftmargin="10" topmargin="10" rightmargin="0" bottommargin="0">
<a name='kontakt'>
<div id="container_frame">
<?php
if ($_POST['send']) {
	$navn = utf8_decode($_POST['navn']);
	$navn2 = utf8_decode($_POST['navn2']);
	$email = $_POST['email'];
	$email_indhold = utf8_decode($_POST['email_indhold']);
	$mailtil = "benjamin@cyberhus.dk";
    $mailfra = "$email";

	mail ($mailtil,"Kontakt-os-mail fra findhjaelp.dk","Navn: $navn\n Organisation: $navn2\n Email: $email\n Tekst: $email_indhold\n ","From: $mailfra");
	echo "<p>Tak for din email!</p><p><a href='http://www.findhjaelp.dk' target='_top'>Tilbage til forsiden.</a></p>";
            
}
?>
<!--<META HTTP-EQUIV='Refresh' CONTENT='0;URL=http://ny.cyberhus.dk/site/21064.htm'>-->
</div> 
</body>
</html>

