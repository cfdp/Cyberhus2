<?php 
include("header_findhjaelp.php");
?>

  <form method="POST" action="send_email_kontakt.php" onSubmit="return checkform(this);">
	  <input type="hidden" name="send" value="true">
<p>Herfra kan du enten skrive en besked til os, eller tilmelde et nyt r&aring;dgivningssted </p>
    <table class="form_table_smal" cellspacing="0">
      <tr>
        <td class ="form_table_header"colspan="2">Kontakt os</td>
      </tr>

      <tr>
        <td>Navn:</td>
        <td><input name="navn" type="text" value="" size="30" maxlength="60"></td>
      </tr>
      <tr>
        <td>Evt. organisation:</td>
        <td><input name="navn2" type="text" value="" size="30" maxlength="60"></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><input name="email" type="text" value="" size="30" maxlength="60"></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Besked</div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <textarea rows="6" name="email_indhold" cols="50" onKeyPress="return getLength(this.value.length,200)"
onkeyup="return getLength(this.value.length,200)" onBlur="maxLength(this,200)" ></textarea>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">
          <input type="submit" value="Send besked" name="B12">
        </div></td>
      </tr>
    </table>

  </form>
  <p>&nbsp;</p>
  <form method="POST" action="foreslaa_raadgivning_inc_head.php">
    <p>
      <input type="hidden" name="rediger_marker" value="true">
    </p>
    <table class="form_table_smal" cellspacing="0">
      <tr>
        <td class="form_table_header">Foresl&aring; et r&aring;dgivningssted, som b&oslash;r v&aelig;re p&aring; findhj&aelig;lp.dk </td>
      </tr>
      <tr>
        <td><div align="center">
          <input type="submit" value="Foresl&aring; r&aring;dgivningssted" name="B1">
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p align="left">&nbsp;</p>
  </form>
</div>
</div>
</body>

</html>