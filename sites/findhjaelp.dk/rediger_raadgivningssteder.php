<html>
<head>
<title>Rediger r&aring;dgivningssteder </title>

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
<p><strong>Administr&eacute;r r&aring;dgivningssteder</strong></p>
<p>Du har nu tre muligheder: </p>
<p>1. tilf&oslash;j et nyt r&aring;dgivningssted  </p>

<form method="POST" action="tilfoej_raadgivningssted.html" onSubmit="return checkform(this);">

<input type="hidden" name="tilfoej_marker" value="true">


  <p align="left">

  <input type="submit" value="Tilf&oslash;j nyt r&aring;dgivningssted" name="B1">
  </p>

</form>

<p>2. Rediger eller slet et allerede eksisterende r&aring;dgivningssted </p>



<form method="POST" action="rediger_slet_raadgivningssted.php" onSubmit="return checkform(this);">

<input type="hidden" name="rediger_marker" value="true">
<p align="left">

  <input type="submit" value="Redig&eacute;r eller slet r&aring;dgivningssted" name="B1">
  </p>

</form>
<p>3. Send en email til alle r&aring;dgivningssteder </p>
<form method="POST" action="send_email_raadgivning.php" onSubmit="return checkform(this);">
  <p align="left">
    <input type="submit" value="Send email" name="B3">
  </p>
</form>
</div>
</body>

</html>