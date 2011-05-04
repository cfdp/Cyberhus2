// JavaScript Document

function checkform ( form )
{
  // see http://www.thesitewizard.com/archive/validation.shtml
  // for an explanation of this script and how to use it on your
  // own website
  // ** START **
  if(document.pressed == 'Gem') {
	  if (form.navn.value == "") {
		alert( "Husk at udfylde navne-feltet." );
		form.navn.focus();
		return false ;
	  }
		if (form.adresse.value == "") {
		alert( "Husk at udfylde adresse-feltet." );
		form.adresse.focus();
		return false ;
	  }
		if (form.aabningstider.value == "") {
		alert( "Husk at udfylde \u00E5bningstids-feltet." );
		form.aabningstider.focus();
		return false ;
	  }
		if (form.maalgruppe.value == "") {
		alert( "Husk at udfylde m\u00E5lgruppe-feltet." );
		form.maalgruppe.focus();
		return false ;
	  }
		if (form.beskrivelse.value == "") {
		alert( "Husk at udfylde beskrivelses-feltet." );
		form.beskrivelse.focus();
		return false ;
	  }
		if (form.email_opdatering.value == "") {
		alert( "Husk at udfylde email-feltet." );
		form.email_opdatering.focus();
		return false ;
	  }
	  form.target = "_top";
	  form.action ="tilfoej_marker.php";
  }
  else
    if(document.pressed == 'Slet') {
		form.target = "_top";
		form.action ="tilfoej_marker.php?action_marker=slet";
		return window.confirm( "Vil du virkelig slette dette r\u00E5dgivningssted?" );
  }

  // ** END **
  return true ;
}

function checkform_manuelt ( form )
{
  // see http://www.thesitewizard.com/archive/validation.shtml
  // for an explanation of this script and how to use it on your
  // own website

  // ** START **

  if (form.lat.value == "") {
	alert( "Husk at udfylde breddegrader-feltet." );
	form.navn.focus();
	return false ;
  }
	if (form.lng.value == "") {
	alert( "Husk at udfylde l\u00E6ngdegrader-feltet." );
	form.adresse.focus();
	return false ;
  }
  // ** END **
  return true ;
}

function checkform_eksternt ( form )
{
  // see http://www.thesitewizard.com/archive/validation.shtml
  // for an explanation of this script and how to use it on your
  // own website

  // ** START **

  if (form.navn.value == "") {
	alert( "Husk at udfylde navne-feltet." );
	form.navn.focus();
	return false ;
  }
	if (form.adresse.value == "") {
	alert( "Husk at udfylde adresse-feltet." );
	form.adresse.focus();
	return false ;
  }
  	if (form.aabningstider.value == "") {
	alert( "Husk at udfylde \u00E5bningstids-feltet." );
	form.aabningstider.focus();
	return false ;
  }
  	if (form.maalgruppe.value == "") {
	alert( "Husk at udfylde m\u00E5gruppe-feltet." );
	form.maalgruppe.focus();
	return false ;
  }
  	if (form.beskrivelse.value == "") {
	alert( "Husk at udfylde beskrivelses-feltet." );
	form.beskrivelse.focus();
	return false ;
  }
  	if (form.email_opdatering.value == "") {
	alert( "Husk at udfylde kontaktpersonens email." );
	form.email_opdatering.focus();
	return false ;
  }
  // ** END **
  return true ;
}

function Changeaction(selBox)
  {
  //  var frm =   selBox.value;
    var sel  =   selBox.options[selBox.selectedIndex].value;
    if(sel == "" || sel ==   "NEW") {
       //  document.searchleads.action = ‘index.php’;
    } else {
           document.rediger_slet.action = 'rediger_raadgivningssteder.php';
      }
}
  
function encodeSpecChar(raadgivning)
  {
	raadgivning = encodeURIComponent(raadgivning);
	window.location='rediger_slet_raadgivningssted.php?raadgivning='+raadgivning;

} 

function getLength(l,m){
	window.status = l + " af " + m + " maksimalt antal tegn";
	return l < m;
}

function maxLength(t,m){
	var l = t.value.length;
	if (l > m){
		alert("Dit input som fylder " + l
		+ " tegn, overskrider maksimum som er " + m + ".\n"
		+ "Det vil blive forkortet.");
		t.value = t.value.substring(0,m);
	}
	getLength(t.value.length,m);
}