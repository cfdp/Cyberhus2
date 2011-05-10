<html>
<head>
<title>Tilf&oslash;j nyt r&aring;dgivningssted</title>

<script src="findhjaelp.js" language="JavaScript" type="text/javascript"></script>

<link href="http://ny.cyberhus.dk/files/styles/style_findhjaelp.css" rel="stylesheet" type="text/css" media="screen"><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style></head>
<body>
<div id="container_frame">
<? 
include("xml_parser.php");
//nedenstående funktion henter alle opdaterings-ansvalig-emails fra xml-filen
//$emails = getEmails();
$visibility ="visible";
$all_emails_string = "";
$emails = array("benjamin@cyberhus.dk", "bsc1976@gmail.com");
$antal_emails = count($emails);
for($i=0;$i<$antal_emails;$i++) {
	if ($emails[$i] != "") {
		$all_emails_string = $all_emails_string . $emails[$i] . ", ";
	}
}
//echo "\t<p>Emailstring:</p>\n" . $all_emails_string;
$navn = $_POST['navn'];
$navn_decodet = utf8_decode($_POST['navn']);
$emne = $_POST['emne'];
$emne_decodet = utf8_decode($_POST['emne']);
$mailfra = $navn;
//"bsc1976@gmail.com";
$email_indhold = $_POST['email_indhold'];
$email_indhold_decodet = utf8_decode($_POST['email_indhold']);

if ($_POST['send'] == "true") {
	if (mail ($all_emails_string,"$emne_decodet","Fra: $navn_decodet\n Tekst: $email_indhold_decodet\n ","From: $mailfra")) {
		$visibility ="hidden";
		echo "<p>Din mail er blevet afsendt.</p><p><a href='http://www.findhjaelp.dk'>Tilbage til forsiden.</a></p>";
	}
	else {
		echo "<p>Fejl i afsending af mail.</p>";
	}
}

?>
<div style="visibility: <? echo $visibility ?> ">
  <p><strong>Vil du sende nedenst&aring;ende email til <? echo $antal_emails ?> r&aring;dgivningssteder? </strong>(test - der sendes kun til os)</p><!--
Denne form skal kalde dette dokument en gang til! Da vil ovenstående mail-kode nemlig aktiveres -->
<form method="POST" action="send_email_raadgivning2.php" onSubmit="return checkform(this);">
  <input type="hidden" name="send" value="true">

    <table width="350" border="0" cellspacing="0" cellpadding="5">
	      <tr>
        <td colspan="2">Emne: <? echo $emne ?> </td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2">Afsender: <? echo $navn ?> </td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2">Tekst: <? echo $email_indhold ?> </td>
        <td></td>
      </tr>
      <tr>
        <td><a href="javascript: history.back(1);"><< Ret email </a> </td>
        <td><input type="submit" value="Send besked" name="B1"></td>
        <td></td>
      </tr>
    </table>

      <br>
    </p>
  </form>
</div>
</div>
</body>

</html>