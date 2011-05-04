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

<!--OBS: send skal være false her, da der først skal laves en godkendelse af input... -->
<form method="POST" action="send_email_raadgivning2.php" onSubmit="return checkform(this);">
  <input type="hidden" name="send" value="false">

    <table class="form_table_smal"  cellspacing="0">
	      <tr>
            <th class="form_table_header" colspan="2">Send en email til  alle r&aring;dgivningssteder</td>
		  </tr>
      <tr>
        <td>Emne:</td>
        <td><input type="text" name="emne" size="25" value=""></td>
      </tr>
      <tr>
        <td>Afsender (f.eks. Lars Hansen, findhj&aelig;lp.dk) :</td>
        <td><input type="text" name="navn" size="25" value=""></td>
      </tr>
      <tr>
        <td colspan="2">Tekst:<br>
          <textarea rows="15" name="email_indhold" cols="55"  ></textarea>
          <br>
          <br>
          <input type="submit" onClick="document.pressed='Gem'" value="Send besked" name="B1"></td>
      </tr>
    </table>
    <p align="left">
	

	</p>
  </form>

</div>
</body>

</html>