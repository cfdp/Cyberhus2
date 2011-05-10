<?php 
include("header_findhjaelp.php");
?>
<!-- Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/ -->
<div id="overDiv" style="position:absolute; visibility:hide; z-index:1; text-align:left">
</div>
<script LANGUAGE="JavaScript" SRC="javascript/overlib.js"></script>

<form method="POST" action="tilfoej_marker.php" target="_top" onSubmit="return checkform_eksternt(this)";>

<input type="hidden" name="action_marker" value="tilfoej_ekstern">
<input type="hidden" name="automatic_geocoding" value="true">
<input type="hidden" name="xmlfileName" value="SAVE">
<input type="hidden" name="send" value="true">
<p>Vigtigt: Kun&nbsp;tilbud der er gratis for barnet/den unge, optages  p&aring; findhj&aelig;lp.dk <br>
Felter markeret med * <em>skal</em> udfyldes, tak. </p>
<table class="form_table" cellspacing="0">          
  <tr>
    <td colspan="2" valign="top" class="form_table_header">Tilmeld nyt r&aring;dgivningssted</td>
  </tr>

  <tr>

    <td width="22%" valign="top">R&aring;dgivningssted <a href="#" onMouseOver="drc('Skriv navnet p&#229; jeres r&#229;dgivningssted','R&#229;dgivningssted:'); return true;" onMouseOut="nd(); return true;">[?]</a>:</td>

    <td width="78%" valign="top">*
      <input type="text" name="navn" size="73" maxlength="100"></td>
  </tr>

  <tr>

    <td width="22%" valign="top">Adresse til jeres fysiske placering: <a href="#" onMouseOver="drc('Den fysiske placering hvor barnet eller den unge kan m&#248;de jer. Vigtig i forhold til s&#248;gning af tilbud. S&#248;gningen af jeres tilbud tager udgangspunkt i tilbudets geografiske placering. En korrekt angivet postadresse er derfor essentiel for optagelse p&#229; findhj&#230;lp.dk','Adresse:'); return true;" onMouseOut="nd(); return true;">[?]</a>:</td>

    <td width="78%" valign="top">
     
        *
        <input type="text" name="adresse" size="73" maxlength="100">
        <br>
        NB: Af hensyn til korrekt geokodning skal adressen skrives ud i &eacute;t <u>uden</u> kommaer og punktummer. F.eks.
        : <i>Sj&aelig;llandsgade 4 8600 Silkeborg </i>            </td>
  </tr>

  <tr>

    <td width="22%" valign="top">Kategori <a href="#" onMouseOver="drc('V&#230;lg den kategori, der passer bedst p&#229; jeres tilbud. <br><br> Alt er lukket og jeg har brug for hj&#230;lp her og nu: Akut, d&#248;gn&#229;ben hj&#230;lp og r&#229;dgivning. F.eks. krisecentre og psykiatriske skadestuer, mv. <br><br> &#197;ben anonym r&#229;dgivning: R&#229;dgivning hvor barnet/den unge kan v&#230;re helt anonym og komme direkte fra gaden i &#229;bningstiden.<br><br>Jeg har sp&#248;rgsm&#229;l om min krop: Hj&#230;lp og r&#229;dgivning til b&#248;rn og unge omkring spiseforstyrrelser, selvskadende adf&#230;rd og andre fysiske problemer.<br><br>Jeg har sp&#248;rgsm&#229;l om sex/seksualitet:  R&#229;dgivning om alt der har med seksualitet at g&#248;re (sygdomme, pr&#230;vention, homoseksualitet, mv.)<br><br>For meget alkohol og stoffer: R&#229;dgivning og/eller behandling af b&#248;rn/unge i forbindelse med enten alkoholmisbrug eller stofmisbrug, eller begge dele.<br><br>En jeg holder meget af er d&#248;d, eller er blevet alvorligt syg:  Hj&#230;lp og r&#229;dgivning til b&#248;rn og unge som har mistet et familiemedlem, eller som oplever alvorlig sygdom i den n&#230;rmeste familie.<br><br>Jeg har oplevet noget, der ikke var rart - nogen har gjort noget ved mig jeg ikke kunne lide:Hj&#230;lp og r&#229;dgivning til b&#248;rn og unge som f.eks. har v&#230;ret udsat for voldt&#230;gt, incest eller fysisk og psykisk vold.<br><br>Jeg vil gerne finde et sted, hvor der er andre unge at v&#230;re sammen med: F.eks: V&#230;resteder, ensomhedsgrupper, ungdomsklubber, fritidshjem, idr&#230;tsklubber, pigegrupper/drengegrupper, hobby-grupper, mv.','Kategori:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>:</td>

    <td width="78%" valign="top">
 
        *
        <select name="kategori">
          <option value="alt_lukket">Alt lukket</option>
          <option value="aaben_anonym">&Aring;ben, anonym r&aring;dgivning</option>
          <option value="krop">Jeg har sp&oslash;rgsm&aring;l om min krop</option>
          <option value="sex">Jeg har sp&oslash;rgsm&aring;l om sex</option>
          <option value="alkohol_stoffer">For meget alkohol og stoffer</option>
          <option value="doed_syg">D&oslash;d, alvorlig sygdom</option>
          <option value="ikke_rart">Nogen har gjort noget...</option>
		  <option value="vaeresteder">Leder efter andre unge...</option>
        </select></td>
  </tr>
  <tr>
    <td valign="top">&Aring;bningstider/<br>
      tr&aelig;ffetider <a href="#" onMouseOver="drc('Hvorn&#229;r kan barnet/den unge henvende sig til jeres tilbud','&#197;bingstider:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>: </td>
    <td valign="top">*      
      <textarea name="aabningstider" rows="3" cols="30" value="aabningstider" onKeyPress="return getLength(this.value.length,100)"
onkeyup="return getLength(this.value.length,100)"
onblur="maxLength(this,100)"></textarea></td>
  </tr>
  <tr>
    <td valign="top">M&aring;lgruppe <a href="#" onMouseOver="drc('Hvem kan henvende sig i jeres tilbud? Eksempelvis alder, k&#248;n, andre krav','M&#229;lgruppe:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>: </td>
    <td valign="top">*
      <textarea name="maalgruppe" rows="3" cols="30" value="maalgruppe" onKeyPress="return getLength(this.value.length,100)"
onkeyup="return getLength(this.value.length,100)"
onblur="maxLength(this,100)"></textarea></td>
  </tr>

  <tr>

    <td width="22%" valign="top">Beskrivelse <a href="#" onMouseOver="drc('Kort beskrivelse af jeres tilbud, samt evt. kommentar','Beskrivelse:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>:</td>

    <td width="78%" valign="top">*
      <textarea name="beskrivelse" rows="8" cols="30" value="beskrivelse" onKeyPress="return getLength(this.value.length,200)"
onkeyup="return getLength(this.value.length,200)"
onblur="maxLength(this,200)"></textarea></td>
  </tr>
  <tr>
    <td valign="top">Telefon <a href="#" onMouseOver="drc('Telefonnummer som barnet/den unge kan ringe p&#229;, og f&#229; direkte kontakt til voksenhj&#230;lp','Telefon:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>: </td>
    <td valign="top"><input type="text" name="telefon" size="30" maxlength="100"></td>
  </tr>

  <tr>

    <td width="22%" valign="top">www-adresse til evt. website <a href="#" onMouseOver="drc('Kun relevant hvis der findes et direkte link','www-adresse:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>:</td>

    <td width="78%" valign="top"><input type="text" name="website" size="30" maxlength="100"></td>
  </tr>
         <td width="22%" valign="top">Evt. r&aring;dgivnings-email <a href="#" onMouseOver="drc('Emailadresse som barnet/den unge kan henvende sig p&#229, og f&#229 direkte kontakt til voksenhj&#230;lp','R&#229dgivningsemail:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>:</td>
    <td width="78%" valign="top"><input type="text" name="email_raadgivning" size="30" maxlength="100"></td>
  </tr>       <tr>
           <td valign="top">Email p&aring; relevant kontaktperson <a href="#" onMouseOver="drc('Bruges i forb. med opdatering af oplysninger p&#229 findhj&#230;lp-siden hvert kvartal. Adressen er kun til internt brug og bliver ikke offentliggjort p&#229 portalen','Kontaktperson-email:'); return true;" onMouseOut="nd(); return 
true;">[?]</a>:</td>
           <td valign="top">*
             <input type="text" name="email_opdatering" size="30" maxlength="100"></td>
         </tr>
  <tr valign="top">
    <td>  <p align="center">&nbsp;</p></td>
    <td><input type="submit" value="Tilmeld r&aring;dgivningssted" onClick="document.pressed='Gem'"  name="Gem"></td>
  </tr>
</table>

<p><A HREF="data_mailpolitik.html" onClick="window.open('data_mailpolitik.html', 'data_mailpolitik','width=380,height=780'); return false" target="_blank">Data-og mailpolitik p&aring; findhj&aelig;lp.dk.</A>
</p>
</form>
</div>
</div>
</body>

</html>